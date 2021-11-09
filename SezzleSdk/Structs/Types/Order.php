<?php

namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Order extends AbstractStruct
{
    const INTENT_AUTH = 'AUTH';
    const INTENT_CAPTURE = 'CAPTURE';

    protected $types = [
        'shippingAmount' => Amount::class,
        'taxAmount' => Amount::class,
        'orderAmount' => Amount::class,
        'authorization' => Authorization::class,
    ];

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $intent;

    /**
     * @var string
     */
    protected $referenceId;

    /**
     * @var string
     */
    protected $description;


    /**
     * @var Item[]
     */
    protected $items = [];

    /**
     * @var Discount[]
     */
    protected $discounts = [];


    /**
     * @var array
     */
    protected $metadata = [];
    /**
     * @var Amount
     */
    protected $shippingAmount;

    /**
     * @var Amount
     */
    protected $taxAmount;

    /**
     * @var Amount
     */
    protected $orderAmount;

    /**
     * @var bool
     */
    protected $requiresShippingInfo;
    /**
     * @var string
     */
    protected $checkoutExpiration;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @var string
     */
    protected $checkoutUrl;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Order
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        return $this->checkoutUrl;
    }

    /**
     * @param string $checkoutUrl
     * @return Order
     */
    public function setCheckoutUrl($checkoutUrl)
    {
        $this->checkoutUrl = $checkoutUrl;
        return $this;
    }




    /**
     * @return string
     */
    public function getIntent()
    {
        return $this->intent;
    }

    /**
     * @param string $intent
     * @return Order
     */
    public function setIntent($intent)
    {
        $this->intent = $intent;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @param string $referenceId
     * @return Order
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Order
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item[] $items
     * @return Order
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * @param Discount[] $discounts
     * @return Order
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     * @return Order
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * @param string $key
     * @param scalar $value
     * @return Order
     */
    public function addMetadata($key, $value)
    {
        $this->metadata[$key] = $value;
        return $this;
    }



    /**
     * @return Amount
     */
    public function getShippingAmount()
    {
        return $this->shippingAmount;
    }

    /**
     * @param Amount $shippingAmount
     * @return Order
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->shippingAmount = $shippingAmount;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param Amount $taxAmount
     * @return Order
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * @param Amount $orderAmount
     * @return Order
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequiresShippingInfo()
    {
        return $this->requiresShippingInfo;
    }

    /**
     * @param bool $requiresShippingInfo
     * @return Order
     */
    public function setRequiresShippingInfo($requiresShippingInfo)
    {
        $this->requiresShippingInfo = $requiresShippingInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckoutExpiration()
    {
        return $this->checkoutExpiration;
    }

    /**
     * @param string $checkoutExpiration
     * @return Order
     */
    public function setCheckoutExpiration($checkoutExpiration)
    {
        $this->checkoutExpiration = $checkoutExpiration;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return Order
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param Authorization $authorization
     * @return Order
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
        return $this;
    }



}
