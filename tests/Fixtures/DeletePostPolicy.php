<?php

namespace Jlem\Polyc\Tests\Fixtures;

use Jlem\Polyc\Policy;

class DeletePostPolicy extends Policy
{
    const INVALID_POST = 1;

    public function check($post)
    {
        if (is_null($post)) {
            return $this->error(self::INVALID_POST);
        }

        return $this->success();
    }
}