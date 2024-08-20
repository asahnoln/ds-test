<?php

namespace Tests\Stubs;

use App\Contracts\FollowerServiceInterface;

class FollowerServiceFailingStub implements FollowerServiceInterface
{
    public function __construct(private \Throwable $throwable)
    {

    }

    public function uniqueFollowersCount(string $fullRepoName): int
    {
        throw $this->throwable;
    }
}
