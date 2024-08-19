<?php

namespace App\Clients;

use App\Contracts\GitHubClientInterface;
use GrahamCampbell\GitHub\GitHubManager;

class GitHubClient implements GitHubClientInterface
{
    public function __construct(private GitHubManager $manager)
    {

    }

    public function maintainers(string $user, string $repo, callable $predicate): array
    {
        $all = $this->manager->repo()->contributors($user, $repo);
        return collect($all)->filter($predicate)->toArray();
    }

    public function followers(string $user): array
    {
        return $this->manager->user()->followers($user);
    }
}
