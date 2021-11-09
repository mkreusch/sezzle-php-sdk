<?php

use PHPUnit\Framework\TestCase;
use SezzleSdk\Clients\Client;
use SezzleSdk\Structs\Types\Amount;
use SezzleSdk\Structs\Types\Customer;
use SezzleSdk\Structs\Types\Order;

require_once __DIR__ . '/TestTrait.php';

class AuthenticationTest extends TestCase
{

    use TestTrait;


    public function testAuthentication()
    {
        $client = new Client(
            $this->configuration['public_key'],
            $this->configuration['private_key'],
            $this->configuration['region'],
            true
        );

        $tokenObject = $client->authorize();
        $this->assertNotEmpty($tokenObject->getToken());
        $this->assertGreaterThan(5, strlen($tokenObject->getToken()));

    }

}

