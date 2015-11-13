<?php
class Controller
{
    protected static $instance;
    public $query;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function sendError($error)
    {
        $answer = array(
            'status' => 'error',
            'message' => $error
        );
        return json_encode($answer);
    }
    public function sendMessage($msg){
        $answer = array(
            'status' => 'true',
            'message' => $msg
        );
        return json_encode($answer);
    }

}