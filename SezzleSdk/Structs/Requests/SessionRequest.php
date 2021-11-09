<?php
namespace SezzleSdk\Structs\Requests;

use SezzleSdk\Structs\AbstractStruct;
use SezzleSdk\Structs\Types\Customer;
use SezzleSdk\Structs\Types\Order;
use SezzleSdk\Structs\Types\Url;

class SessionRequest extends AbstractStruct {
    protected $types = [
        'cancelUrl'=>Url::class,
        'completeUrl'=>Url::class,
        'customer'=>Customer::class,
        'order'=>Order::class
    ];

    /**
     * @var Url
     */
    protected $cancelUrl;

    /**
     * @var Url
     */
    protected $completeUrl;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     * @return SessionRequest
     */
    public function setTypes($types)
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl?$this->cancelUrl->getHref():null;
    }

    /**
     * @param string $cancelUrl
     * @return SessionRequest
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = new Url(['href' => $cancelUrl]);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompleteUrl()
    {
        return $this->completeUrl?$this->completeUrl->getHref():null;
    }

    /**
     * @param string $completeUrl
     * @return SessionRequest
     */
    public function setCompleteUrl($completeUrl)
    {
        $this->completeUrl = new Url(['href' => $completeUrl]);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return SessionRequest
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return SessionRequest
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }



}