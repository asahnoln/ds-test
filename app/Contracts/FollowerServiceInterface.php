<?php

namespace App\Contracts;

interface FollowerServiceInterface
{
    public function uniqueFollowersCount(string $fullRepoName): int;
}
