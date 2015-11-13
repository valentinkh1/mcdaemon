<?php
class queueHandler
{
    private $queue;
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function  __construct()
    {
        $this->queue = array();
    }

    public function addToQueue($id)
    {
        $this->queue[] = array('status' => 'wait', 'id' => $id);
    }

    public function lockInQueue($key, $id)
    {
        $this->queue[$key]['status'] = 'lock';
        $this->queue[$key]['couple'] = $id;
    }

    public function processQueue()
    {
        $playerOne = false;
        $playerTwo = false;
        foreach ($this->queue as $key => $value) {
            if ($value['status'] != 'wait')
                continue;
            if (!$playerOne) {
                $playerOne = array($key, $value['id']);
                continue;
            }
            if (!$playerTwo) {
                $playerTwo = array($key, $value['id']);
            }
            if ($playerOne && $playerTwo) {
                $this->lockInQueue($playerOne[0], $playerTwo[1]);
                $this->lockInQueue($playerTwo[0], $playerOne[1]);
                return array(
                    'queue'      => $this->queue,
                    'player_one' => $playerOne[1],
                    'player_two' => $playerTwo[1]
                );
            }
        }
        return $this->queue;
    }
}