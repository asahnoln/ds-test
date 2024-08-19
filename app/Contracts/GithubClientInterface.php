<?php

namespace App\Contracts;

interface GithubClientInterface
{
    public function maintainers(string $repoName): array;
    public function followers(string $user): array;
}
