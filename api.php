<?php

$container->make('post.delete'); // singleton?
$container->

/*
1. Design policy classes however I want
2. Create a policy configuration container that resolves a policy by key name
3. Policy container should resolve singleton instances of policies
4. Policy container should resolve cached policy evaluations and errors
*/

class DeletePostPolicy extends Policy
{
    const NO_PERMISSION = 0;
    const NO_JURISDICTION = 1;
    const INVALID_POST = 2;

    public function check(User $user, Post $post)
    {
        if ($this->hasResult()) {
            return $this->getResult();
        }

        if (!$user->hasPermission($this->getKey())) {
            return $this->error(self::NO_PERMISSION);
        }

        if (!$user->isGlobalStaff() || $user->isPostAuthor($post)) {
            return $this->error(self::NO_JURISDICTION);
        }

        if ($post->isInvisible()) {
            return $this->error(self::INVALID_POST);
        }

        return $this->success();
    }
}
