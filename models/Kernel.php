<?php

abstract class Kernel
{
    private static $connection;

    public function __construct($array)
    {
        foreach($array as $index => $value)
        {
            $item_name = ucfirst($index);
            $method = 'set'.$item_name;

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public static function setConnection(PDO $connection)
    {
        self::$connection = $connection;
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}