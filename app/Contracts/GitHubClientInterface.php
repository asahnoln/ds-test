<?php

namespace App\Contracts;

interface GitHubClientInterface
{
    public function maintainers(string $user, string $repo, callable $predicate): array;
    public function followers(string $user): array;
}
