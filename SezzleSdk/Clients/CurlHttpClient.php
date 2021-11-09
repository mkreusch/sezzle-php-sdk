<?php

namespace SezzleSdk\Clients;

use Exception;
use SezzleSdk\Interfaces\HttpClientInterface;

class CurlHttpClient implements HttpClientInterface
{

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $action
     * @param array $data
     * @param null|string $token
     * @return array
     * @throws Exception
     */
    public function call($action, $data = [], $token = null)
    {
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->url . $action,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_HEADER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_HTTPHEADER => array_merge([
                        "Content-Type: application/json",
                        "cache-control: no-cache",
                    ]
                    ,
                    ($token !== null ? [
                        'Authorization: Bearer ' . $token,
                    ] : [])
                ),
            ]
            +
            (!empty($data) ? [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($data),
            ] : [])
        );
        $rawResponse = curl_exec($ch);
        $response = json_decode($rawResponse, true);
        if (empty($response) || !is_array($response)) {
            throw new Exception('Unexpected response: ' . $rawResponse);
        }
        if ($error = curl_error($ch)) {
            throw new Exception('Curl error: ' . $error);
        }
        curl_close($ch);

        return $response;

    }
}
