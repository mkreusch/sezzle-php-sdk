<?php

namespace SezzleSdk\Clients;

use Exception;
use SezzleSdk\Interfaces\HttpClientInterface;
use SezzleSdk\Structs\Requests\CaptureRequest;
use SezzleSdk\Structs\Requests\SessionRequest;
use SezzleSdk\Structs\Responses\SessionResponse;
use SezzleSdk\Structs\Responses\TokenResponse;
use SezzleSdk\Structs\Types\Amount;
use SezzleSdk\Structs\Types\Order;

class Client
{
    const VERSION = '1.0.0';
    const API_VERSION = 'v2';
    const REGIONS = [
        'REGION_US' => 'US',
        'REGION_EU' => 'EU',
    ];

    /**
     * @var string
     */
    private $apiUser;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $gatewayUrl;

    /**
     * @var
     */
    private $token;

    /**
     * @var bool
     */
    private $isSandbox;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @param string $apiUser
     * @param string $apiSecret
     * @param string $region
     * @param bool $isSandbox
     */
    public function __construct($apiUser, $apiSecret, $region, $isSandbox)
    {

        $this->apiUser = $apiUser;
        $this->apiSecret = $apiSecret;
        $this->region = $region;
        $this->isSandbox = $isSandbox;
        $this->gatewayUrl = 'https://' .
            ($isSandbox ? 'sandbox.' : '') .
            'gateway.' .
            ($region !== self::REGIONS['REGION_US'] ? strtolower($region) . '.' : '') .
            'sezzle.com/' .
            self::API_VERSION .
            '/';
        $this->httpClient = new CurlHttpClient($this->gatewayUrl);
    }

    /**
     * @param SessionRequest $sessionRequest
     * @return SessionResponse
     * @throws Exception
     */
    public function createSession(SessionRequest $sessionRequest)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('session', $sessionRequest->toArray(), $token);
        $this->checkForErrors($response);
        return new SessionResponse($response);
    }

    /**
     * @param string $sessionId
     * @return SessionResponse
     * @throws Exception
     */
    public function getSession($sessionId)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('session/' . $sessionId, [], $token);
        $this->checkForErrors($response);
        return new SessionResponse($response);
    }

    /**
     * @param $orderId
     * @return Order
     * @throws Exception
     */
    public function getOrder($orderId)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('order/' . $orderId, null, $token);
        $this->checkForErrors($response);
        return new Order($response);
    }

    /**
     * @param string $orderId
     * @param Amount $releaseAmount
     * @return array
     * @throws Exception
     */
    public function release($orderId, Amount $releaseAmount)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('order/' . $orderId . '/release', $releaseAmount->toArray(), $token);
        $this->checkForErrors($response);
        return $response;
    }

    /**
     * @param string $orderId
     * @return array|null
     * @throws Exception
     */
    public function completeRelease($orderId)
    {
        $order = $this->getOrder($orderId);

        if (!$order->getAuthorization() || !$order->getAuthorization()->isApproved()) {
            throw new Exception('Cannot release unauthorized order');
        }

        $amount = $this->getAuthorizedUncapturedAmount($order);

        if ($amount->getAmountInCents() <= 0) {
            return null;
        }
        return $this->release($orderId, $amount);
    }

    /**
     * @param Order $order
     * @return Amount
     */
    private function getAuthorizedUncapturedAmount(Order $order)
    {
        $amount = $order->getAuthorization()->getAuthorizationAmount()->getAmountInCents();
        $currency = $order->getAuthorization()->getAuthorizationAmount()->getCurrency();
        if (!empty($order->getAuthorization()->getCaptures())) {
            foreach ($order->getAuthorization()->getCaptures() as $captureArray) {
                $amount -= $captureArray['amount']['amount_in_cents'];
            }
        }
        return new Amount(['amount_in_cents' => $amount, 'currency' => $currency]);
    }


    /**
     * @param $orderId
     * @param CaptureRequest $captureRequest
     * @return array
     * @throws Exception
     */
    public function capture($orderId, CaptureRequest $captureRequest)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('order/' . $orderId . '/capture', $captureRequest->toArray(), $token);
        $this->checkForErrors($response);
        return $response;
    }


    /**
     * @param $orderId
     * @return array|null
     * @throws Exception
     */
    public function completeCapture($orderId)
    {
        $order = $this->getOrder($orderId);

        if (!$order->getAuthorization() || !$order->getAuthorization()->isApproved()) {
            throw new Exception('Cannot capture unauthorized order');
        }

        $amount = $this->getAuthorizedUncapturedAmount($order);

        if ($amount->getAmountInCents() <= 0) {
            return null;
        }

        $captureRequest = (new CaptureRequest())
            ->setPartialCapture(false)
            ->setCaptureAmount($amount);

        return $this->capture($orderId, $captureRequest);
    }

    /**
     * @param string $orderId
     * @param Amount $refundAmount
     * @return array
     * @throws Exception
     */
    public function refund($orderId, Amount $refundAmount)
    {
        $token = $this->getCachedToken();
        $response = $this->httpClient->call('order/' . $orderId . '/refund', $refundAmount->toArray(), $token);
        $this->checkForErrors($response);
        return $response;
    }

    /**
     * @param string $orderId
     * @return array|null
     * @throws Exception
     */
    public function completeRefund($orderId)
    {
        $order = $this->getOrder($orderId);

        if (!$order->getAuthorization() || !$order->getAuthorization()->getAuthorizationAmount()) {
            throw new Exception('Cannot refund unauthorized order');
        }

        $amount = 0;
        $currency = $order->getAuthorization()->getAuthorizationAmount()->getCurrency();
        if (!empty($order->getAuthorization()->getCaptures())) {
            foreach ($order->getAuthorization()->getCaptures() as $captureArray) {
                $amount += $captureArray['amount']['amount_in_cents'];
            }
        }

        if ($amount <= 0) {
            return null;
        }

        $amount = new Amount(['amount_in_cents' => $amount, 'currency' => $currency]);

        return $this->refund($orderId, $amount);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCachedToken()
    {
        if (empty($this->token)) {
            $this->token = $this->authorize()->getToken();
        }
        return $this->token;
    }

    /**
     * @return TokenResponse
     * @throws Exception
     */
    public function authorize()
    {
        $rawResponse = $this->httpClient->call('authentication', [
            'public_key' => $this->apiUser,
            'private_key' => $this->apiSecret,
        ]);
        $this->checkForErrors($rawResponse);
        return new TokenResponse($rawResponse);
    }

    /**
     * @param array $response
     * @throws Exception
     */
    public function checkForErrors(array $response)
    {
        if (!empty($response[0]['code'])) {
            throw new Exception($response[0]['message']);
        }
    }


}
