<?php

namespace SezzleSdk\Services;

use SezzleSdk\Clients\Client;

class MerchantDetector{
    protected $apiUser;
    protected $apiSecret;
    protected $region;

    public function __construct($apiUser, $apiSecret, $region){

        $this->apiUser = $apiUser;
        $this->apiSecret = $apiSecret;
        $this->region = $region;
    }
    public function getMerchantUuid(){

            try {
                $apiClient = new Client($this->apiUser, $this->apiSecret, $this->region, true);
                $tokenResponse = $apiClient->authorize();
                return $tokenResponse->getMerchantUuid();
            }catch(\Exception $e){
                //doesn't matter
            }
            return '';
    }
}