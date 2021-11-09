<?php

namespace SezzleSdk\Services;

use SezzleSdk\Clients\Client;

class RegionDetector{
    protected $apiUser;
    protected $apiSecret;

    public function __construct($apiUser, $apiSecret){

        $this->apiUser = $apiUser;
        $this->apiSecret = $apiSecret;
    }
    public function getRegion(){
        foreach(Client::REGIONS as $region){
            try {
                $apiClient = new Client($this->apiUser, $this->apiSecret, $region, true);
                $tokenResponse = $apiClient->authorize();
                return $region;
            }catch(\Exception $e){
                //doesn't matter
            }
        }
    }
}