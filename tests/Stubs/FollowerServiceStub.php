<?php

namespace Tests\Stubs;

use App\Contracts\FollowerServiceInterface;

class FollowerServiceStub implements FollowerServiceInterface
{
    public function uniqueFollowersCount(string $fullRepoName): int
    {
        return 3;
    }
}
