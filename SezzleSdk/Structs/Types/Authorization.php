<?php

namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Authorization extends AbstractStruct
{
    protected $types = [
        'authorizationAmount' => Amount::class,
    ];

    /**
     * @var string
     */
    protected $uuid;
    /**
     * @var string
     */
    protected $createdAt;
    /**
     * @var Amount
     */
    protected $authorizationAmount;
    /**
     * @var bool
     */
    protected $approved;
    /**
     * @var string
     */
    protected $expiration;
    /**
     * @var array
     */
    protected $captures;
    /**
     * @var array
     */
    protected $refunds;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Authorization
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Authorization
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getAuthorizationAmount()
    {
        return $this->authorizationAmount;
    }

    /**
     * @param Amount $authorizationAmount
     * @return Authorization
     */
    public function setAuthorizationAmount($authorizationAmount)
    {
        $this->authorizationAmount = $authorizationAmount;
        return $this;
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     * @return Authorization
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param string $expiration
     * @return Authorization
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * @return array
     */
    public function getCaptures()
    {
        return $this->captures;
    }

    /**
     * @param array $captures
     * @return Authorization
     */
    public function setCaptures($captures)
    {
        $this->captures = $captures;
        return $this;
    }

    /**
     * @return array
     */
    public function getRefunds()
    {
        return $this->refunds;
    }

    /**
     * @param array $refunds
     * @return Authorization
     */
    public function setRefunds($refunds)
    {
        $this->refunds = $refunds;
        return $this;
    }



}