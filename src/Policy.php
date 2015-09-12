<?php

namespace Jlem\Polyc;

use LogicException;

class Policy
{
    private $key;
    private $error;
    protected $policyResponder;

    protected function error($error)
    {
        $this->error = $error;

        if ($this->hasPolicyResponder()) {
            $response = $this->policyResponder->checkError($this);
            $this->clearPolicyResponder();
            return $response;
        }

        return false;
    }

    protected function success()
    {
        if ($this->hasPolicyResponder()) {
            $this->clearPolicyResponder();
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

    public function withResponder(PolicyResponse $policyResponder)
    {
        $this->policyResponder = $policyResponder;
        return $this;
    }

    private function hasPolicyResponder()
    {
        return !is_null($this->policyResponder);
    }

    private function clearPolicyResponder()
    {
        $this->policyResponder = null;
    }

}