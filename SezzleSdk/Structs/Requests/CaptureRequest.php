<?php
namespace SezzleSdk\Structs\Requests;

use SezzleSdk\Structs\AbstractStruct;
use SezzleSdk\Structs\Types\Amount;

class CaptureRequest extends AbstractStruct {
    protected $types = [
        'captureAmount'=>Amount::class
    ];

    /**
     * @var Amount
     */
    protected $captureAmount;

    /**
     * @var bool
     */
    protected $partialCapture;

    /**
     * @return Amount
     */
    public function getCaptureAmount()
    {
        return $this->captureAmount;
    }

    /**
     * @param Amount $captureAmount
     * @return CaptureRequest
     */
    public function setCaptureAmount($captureAmount)
    {
        $this->captureAmount = $captureAmount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPartialCapture()
    {
        return $this->partialCapture;
    }

    /**
     * @param bool $partialCapture
     * @return CaptureRequest
     */
    public function setPartialCapture($partialCapture)
    {
        $this->partialCapture = $partialCapture;
        return $this;
    }


}