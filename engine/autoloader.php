<?php


class Autoloader
{

    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }


    public function load($paths){
        foreach (glob("engine/classes/*.php") as $filename) {
            include $filename;
        }
       foreach($paths as $path) {
           foreach (glob($path . "/*.php") as $filename) {
               include $filename;
           }
       }

    }


}