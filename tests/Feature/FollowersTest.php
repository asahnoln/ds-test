<?php

use App\Contracts\GithubClientInterface;
use App\Services\FollowerService;

it('gets unique followers', function () {
    $c = new GithubClientStub();
    $s = new FollowerService($c);

    $count = $s->uniqueFollowersCount('testRepo');

    expect($count)->toBe(7);
});

class GithubClientStub implements GithubClientInterface
{
    public function maintainers(string $repoName): array
    {
        return ['userIvan', 'greatestCoder'];
    }

    public function followers(string $user): array
    {
        return match ($user) {
            'userIvan' => [1, 2, 3, 4],
            'greatestCoder' => [1, 2, 6, 7, 8],
            default => [],
        };
    }
}
