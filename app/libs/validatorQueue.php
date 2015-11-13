<?php
trait validatorQueue
{
    public function validateUserId($data)
    {
        if (!isset($data['id']))
            return false;
        if (!is_int((int)$data['id']))
            return false;

        return $data['id'];
    }
}