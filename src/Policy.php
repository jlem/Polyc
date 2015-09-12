<?php

namespace Jlem\Polyc;

use LogicException;

class Policy
{
    private $key;
    private $error;
    protected $policyResponse;

    protected function error($error)
    {
        $this->error = $error;

        if ($this->policyResponse) {
            return $this->policyResponse->checkError($this);
        }

        return false;
    }

    protected function success()
    {
        if ($this->policyResponse) {
            return null;
        }

        return true;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function hasError()
    {
        return !is_null($this->getError());
    }

    public function getError()
    {
        return $this->error;
    }

    public function withResponder(PolicyResponse $policyResponse)
    {
        $this->policyResponse = $policyResponse;
        return $this;
    }
}