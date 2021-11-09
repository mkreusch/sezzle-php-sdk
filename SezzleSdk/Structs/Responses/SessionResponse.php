<?php
namespace SezzleSdk\Structs\Responses;

use SezzleSdk\Structs\AbstractStruct;
use SezzleSdk\Structs\Types\Customer;
use SezzleSdk\Structs\Types\Order;
use SezzleSdk\Structs\Types\Url;

class SessionResponse extends AbstractStruct
{
    protected $types = [
        'order'=>Order::class
    ];

    protected $uuid;
    protected $links = [];
    protected $order;

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     * @return SessionResponse
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param array $links
     * @return SessionResponse
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return SessionResponse
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }


}

//TODO order types

/*

array(3) {
    ["uuid"]=>
  string(36) "cc4b5f24-d922-48a2-9682-ccc2309faded"
    ["links"]=>
  array(1) {
        [0]=>
    array(3) {
            ["href"]=>
      string(85) "https://sandbox.gateway.eu.sezzle.com/v2/session/cc4b5f24-d922-48a2-9682-ccc2309faded"
            ["rel"]=>
      string(4) "self"
            ["method"]=>
      string(3) "GET"
    }
  }
  ["order"]=>
  array(4) {
        ["uuid"]=>
    string(36) "cd1b0448-c54f-4e89-8c61-1e6cdbfde25a"
        ["intent"]=>
    string(4) "AUTH"
        ["checkout_url"]=>
    string(78) "https://sandbox.checkout.eu.sezzle.com?id=08af2366-3324-4ccc-840a-b3a98763461b"
        ["links"]=>
    array(6) {
            [0]=>
      array(3) {
                ["href"]=>
        string(83) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a"
                ["rel"]=>
        string(4) "self"
                ["method"]=>
        string(3) "GET"
      }
      [1]=>
      array(3) {
                ["href"]=>
        string(83) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a"
                ["rel"]=>
        string(4) "self"
                ["method"]=>
        string(5) "PATCH"
      }
      [2]=>
      array(3) {
                ["href"]=>
        string(91) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a/release"
                ["rel"]=>
        string(7) "release"
                ["method"]=>
        string(4) "POST"
      }
      [3]=>
      array(3) {
                ["href"]=>
        string(91) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a/capture"
                ["rel"]=>
        string(7) "capture"
                ["method"]=>
        string(4) "POST"
      }
      [4]=>
      array(3) {
                ["href"]=>
        string(90) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a/refund"
                ["rel"]=>
        string(6) "refund"
                ["method"]=>
        string(4) "POST"
      }
      [5]=>
      array(3) {
                ["href"]=>
        string(92) "https://sandbox.gateway.eu.sezzle.com/v2/order/cd1b0448-c54f-4e89-8c61-1e6cdbfde25a/checkout"
                ["rel"]=>
        string(8) "checkout"
                ["method"]=>
        string(6) "DELETE"
      }
    }
  }
}
*/