<?php
namespace SezzleSdk\Structs\Types;

use SezzleSdk\Structs\AbstractStruct;

class Url extends AbstractStruct{
    /**
     * @var string
     */
    protected $href;

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return Url
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Url
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }


}