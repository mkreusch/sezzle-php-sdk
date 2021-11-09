<?php

namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Item extends AbstractStruct
{
    protected $types = [
        'price'=>Amount::class
    ];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var Amount
     */
    protected $price;

    /**
     * @return string[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     * @return Item
     */
    public function setTypes($types)
    {
        $this->types = $types;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Item
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Amount $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }



}