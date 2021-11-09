<?php
namespace SezzleSdk\Structs\Responses;

use SezzleSdk\Structs\AbstractStruct;
use SezzleSdk\Structs\Types\Customer;
use SezzleSdk\Structs\Types\Order;
use SezzleSdk\Structs\Types\Url;

class TokenResponse extends AbstractStruct
{
    /**
     * @var string
     */
    protected $token;
    /**
     * @var string
     */
    protected $expirationDate;
    /**
     * @var string
     */
    protected $merchantUuid;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return TokenResponse
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return TokenResponse
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantUuid()
    {
        return $this->merchantUuid;
    }

    /**
     * @param string $merchantUuid
     * @return TokenResponse
     */
    public function setMerchantUuid($merchantUuid)
    {
        $this->merchantUuid = $merchantUuid;
        return $this;
    }


}
