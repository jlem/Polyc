<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\PolicyResponse;

class DeletePostPolicyResponse implements PolicyResponse
{
    public function checkError($policy)
    {
        /** @var DeletePostPolicy $policy */
        switch($policy->getError()) {
            case $policy::INVALID_POST:
                return false;
        }
    }
}