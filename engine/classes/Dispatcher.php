<?php
class Dispatcher{
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function run($query,$path){
        $path = explode('/', ltrim(rtrim($path, '/'), '/'));

        if (isset($path[0]) && isset($path[1]) && $path[0] == 'queue') {
            $strController = $path[0] . 'Controller';
            $strMethod = $path[1] . 'Action';

            $controller = $strController::getInstance();
            $controller->query = $query;
            return $controller->$strMethod($query);
        }
    }

}