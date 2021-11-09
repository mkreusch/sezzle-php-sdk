<?php

namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Discount extends AbstractStruct
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Discount
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param Amount $amount
     * @return Discount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }


}
