<?php

namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Amount extends AbstractStruct
{
    /**
     * @var int
     */
    protected $amountInCents;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @return int
     */
    public function getAmountInCents()
    {
        return $this->amountInCents;
    }

    /**
     * @param int $amountInCents
     * @return Amount
     */
    public function setAmountInCents($amountInCents)
    {
        $this->amountInCents = $amountInCents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Amount
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }


}