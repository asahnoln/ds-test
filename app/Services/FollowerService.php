<?php

namespace App\Services;

use App\Contracts\FollowerServiceInterface;
use App\Contracts\GitHubClientInterface;

class FollowerService implements FollowerServiceInterface
{
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

        $maintainers = $this->client->maintainers(
            $user,
            $repo,
            fn (array $item) => $this->maintainerFilter($item)
        );

        $followers = [];
        foreach ($maintainers as $maintainer) {
            $followers = array_merge(
                $followers,
                $this->client->followers($maintainer['login'])
            );
        }

        return collect($followers)->unique('login')->count();
    }

    protected function maintainerFilter(array $item): bool
    {
        return $item['contributions'] >= config('app.gh.min_contributions');
    }
}
