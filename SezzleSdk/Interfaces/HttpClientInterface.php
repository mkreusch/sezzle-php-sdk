<?php
namespace SezzleSdk\Interfaces;


interface HttpClientInterface
{
    /**
     * @param string $action
     * @param array $data
     * @return mixed
     */
    public function call($action, $data = []);
}