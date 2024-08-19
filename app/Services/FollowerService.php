<?php

namespace App\Services;

use App\Contracts\GithubClientInterface;

class FollowerService
{
    public function __construct(private GithubClientInterface $client)
    {

    }

    public function uniqueFollowersCount(string $repoName): int
    {
        $maintainers = $this->client->maintainers($repoName);
        $followers = [];
        foreach ($maintainers as $maintainer) {
            $followers = array_merge($followers, $this->client->followers($maintainer));
        }

        return collect($followers)->unique()->count();
    }
}
