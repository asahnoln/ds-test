<?php

namespace App\Services;

use App\Contracts\GitHubClientInterface;
use App\Services\Traits\MaintainerFilterByName;

class FollowerService extends BaseFollowerService
{
    use MaintainerFilterByName;

    public function __construct(private GitHubClientInterface $client)
    {

    }

    /**
     * Get unique followers count from core maintainers of a given repo.
     *
     * @param string $fullRepoName Full repo name
     *
     * @return int unique followers count
     */
    public function uniqueFollowersCount(string $fullRepoName): int
    {
        list($user, $repo) = explode('/', $fullRepoName);
        $maintainers = $this->client->maintainers($user, $repo, fn (array $item) => $this->maintainerFilter($item));

        $followers = [];
        foreach ($maintainers as $maintainer) {
            $followers = array_merge($followers, $this->client->followers($maintainer['login']));
        }

        return collect($followers)->unique('login')->count();
    }
}
