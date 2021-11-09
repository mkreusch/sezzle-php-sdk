<?php

namespace SezzleSdk\Structs;


abstract class AbstractStruct
{
    protected $types = [];

    public function __construct($dataArray = null)
    {
        if (is_array($dataArray)) {
            $this->setFromArray($dataArray);
        }
        return $this;
    }

    public function setFromArray($dataArray)
    {
        foreach ($dataArray as $fieldName => $fieldValue) {



            $fieldName = $this->snakeToCamel($fieldName);

            if(isset($this->types[$fieldName])){
                $fieldValue = new $this->types[$fieldName]($fieldValue);
            }
            $methodName = 'set' . ucfirst($fieldName);
            if (method_exists($this, $methodName)) {
                $this->{$methodName}($fieldValue);
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];
        foreach (array_keys(get_object_vars($this)) as $property) {
            if($property === 'types'){
                continue;
            }
            if (isset($this->{$property}) && $this->{$property} !== []) {
                if (is_object($this->{$property}) && method_exists($this->{$property}, 'toArray')) {
                    $value = $this->{$property}->toArray();
                } elseif (is_array($this->{$property})) {
                    $value = [];
                    foreach ($this->{$property} as $propertyElementKey => $propertyElementValue) {
                        $value[$this->camelToSnake($propertyElementKey)] = (is_object($propertyElementValue) && method_exists($propertyElementValue, 'toArray')) ? $propertyElementValue->toArray() : $propertyElementValue;
                    }
                } else {
                    $value = $this->{$property};
                }
                $return[$this->camelToSnake($property)] = $value;
            }
        }
        return $return;
    }

    protected function snakeToCamel($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));
        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }
        return $str;
    }

    function camelToSnake($string)
    {
        return strtolower(preg_replace('/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', '_', $string));
    }
}