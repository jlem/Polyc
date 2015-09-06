<?php

namespace Jlem\Polyc;

class Policy
{
    private $key;
    private $error;
    private $result;

    protected function error($error)
    {
        $this->error = $error;
        return $this->result = false;
    }

    protected function success()
    {
        return $this->result = true;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function hasResult()
    {
        return is_bool($this->getResult());
    }

    public function getResult()
    {
        return $this->result;
    }

    public function hasError()
    {
        return !is_null($this->getError());
    }

    public function getError()
    {
        return $this->error;
    }
}