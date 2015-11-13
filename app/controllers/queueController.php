<?php
class queueController extends Controller
{
    use validatorQueue;

    public function addAction()
    {
        $query = $this->getQuery();
        $id = $this->validateUserId($query);
        if(!$id)
            return $this->sendError('No id');
        $queue = queueHandler::getInstance();
        $queue->addToQueue($id);

        $answer = $queue->processQueue();

        return $this->sendMessage($answer);

    }
}