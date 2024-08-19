<?php

use App\Contracts\FollowerServiceInterface;
use App\Contracts\GitHubClientInterface;
use App\Services\FollowerService;

it('gets unique followers', function () {
    $c = new GitHubClientStub();
    $s = new FollowerService($c);

    $count = $s->uniqueFollowersCount('testUser/testRepo');

    expect($count)->toBe(7);
});

todo('pass wrong repo path');

class GitHubClientStub implements GitHubClientInterface
{
    public function maintainers(string $user, string $repo, callable $predicate): array
    {
        $res = match ($user) {
            'testUser' => [
                ['login' => 'userIvan'],
                ['login' => 'greatestCoder'],
            ],
            default => [],
        };

        return collect($res)->filter($predicate)->toArray();
    }

    public function followers(string $user): array
    {
        return match ($user) {
            'userIvan' => [
                ['login' => 1],
                ['login' => 2],
                ['login' => 3],
                ['login' => 4]
            ],
            'greatestCoder' => [
                ['login' => 1],
                ['login' => 2],
                ['login' => 6],
                ['login' => 7],
                ['login' => 8]
            ],
            default => [],
        };
    }
}
