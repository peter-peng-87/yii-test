<?php
namespace components;

class Api
{
    /**
     * @return get_called_class()
     */
    public static function install()
    {    
        $obj = '\\' . get_called_class();
        return (new \ReflectionClass(get_called_class()))->in;
    }
}
