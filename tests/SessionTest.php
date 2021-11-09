<?php

use PHPUnit\Framework\TestCase;
use SezzleSdk\Clients\Client;
use SezzleSdk\Structs\Types\Amount;
use SezzleSdk\Structs\Types\Customer;
use SezzleSdk\Structs\Types\Order;

require_once __DIR__ . '/TestTrait.php';

class SessionTest extends TestCase
{

    use TestTrait;

    public function testCreateAndGetSession()
    {
        $client = new Client(
            $this->configuration['public_key'],
            $this->configuration['private_key'],
            $this->configuration['region'],
            true
        );

        $orderReferenceId = uniqid();
        $amount = (new Amount())
            ->setAmountInCents(1000)
            ->setCurrency('EUR');
        $order = (new Order())
            ->setOrderAmount($amount)
            ->setIntent(Order::INTENT_AUTH)
            ->setDescription(uniqid())
            ->setReferenceId($orderReferenceId);
        $customer = (new Customer())
            ->setEmail('info@onlineshop.consulting');

        $sessionRequest = (new \SezzleSdk\Structs\Requests\SessionRequest())
            ->setCancelUrl('https://onlineshop.consulting')
            ->setCompleteUrl('https://onlineshop.consulting')
            ->setOrder($order)
            ->setCustomer($customer);

        $session = $client->createSession($sessionRequest);

        $this->assertNotEmpty($session->getUuid());
        $this->assertNotEmpty($session->getOrder());
        $this->assertNotEmpty($session->getOrder()->getCheckoutUrl());
        $this->assertGreaterThan(10, strlen($session->getUuid()));

        $this->testOrderFromSession($session, $orderReferenceId);

        $sessionFromGet = $client->getSession($session->getUuid());

        $this->assertNotEmpty($sessionFromGet->getUuid());
        $this->assertEquals($sessionFromGet->getUuid(), $session->getUuid());

        try {
            $client->completeCapture($sessionFromGet->getOrder()->getUuid());
        }catch (Exception $e){
            $this->assertStringContainsString('Cannot capture unauthorized order', $e->getMessage());
        }

        try {
            $client->completeRefund($sessionFromGet->getOrder()->getUuid());
        }catch (Exception $e){
            $this->assertStringContainsString('Cannot refund unauthorized order', $e->getMessage());
        }

        try {
            $client->completeRelease($sessionFromGet->getOrder()->getUuid());
        }catch (Exception $e){
            $this->assertStringContainsString('Cannot release unauthorized order', $e->getMessage());
        }

    }

    private function testOrderFromSession(\SezzleSdk\Structs\Responses\SessionResponse $sessionResponse, $orderReferenceId){
        $client = new Client(
            $this->configuration['public_key'],
            $this->configuration['private_key'],
            $this->configuration['region'],
            true
        );

        $orderResponse = $client->getOrder($sessionResponse->getOrder()->getUuid());
        $this->assertNotEmpty($orderResponse->getUuid());
        $this->assertEquals($orderResponse->getReferenceId(), $orderReferenceId);
    }

}

