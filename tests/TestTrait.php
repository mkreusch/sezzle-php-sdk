<?php
include __DIR__.'/../vendor/autoload.php';

foreach(glob(__DIR__.'/../SezzleSdk/*/*.php') as $file){
    require_once $file;
}

foreach(glob(__DIR__.'/../SezzleSdk/*/*/*.php') as $file){
    require_once $file;
}

trait TestTrait
{
    private $configuration = [
        'merchant_id' => '394e5c45-3c1e-4946-a0ce-b3ce4f53bced',
        'private_key' => 'sz_pr_4t8HKUfYabETWX47l6AH4theAdvGeVZd',
        'public_key' => 'sz_pub_KhgSIsdncrHPbeysQE9M0FeIbeVMt1Ic',
        'region' => 'EU'
    ];
}