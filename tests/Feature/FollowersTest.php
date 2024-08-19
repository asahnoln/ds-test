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
                ['login' => 'userIvan', 'contributions' => 20],
                ['login' => 'greatestCoder', 'contributions' => 50],
                ['login' => 'filterOut', 'contributions' => 1]
            ],
            default => [],
        };

        return collect($res)->filter($predicate)->toArray();
    }

    public function followers(string $user): array
    {
        return match ($user) {
            'userIvan' => [
                ['login' => 1, 'extra' => 'val'],
                ['login' => 2, 'extra' => 'val2'],
                ['login' => 3, 'extra' => 'val3'],
                ['login' => 4, 'extra' => 'val4']
            ],
            'greatestCoder' => [
                ['login' => 1, 'just' => 'forFun'],
                ['login' => 2, 'just' => 'forFun2'],
                ['login' => 6, 'just' => 'forFun3'],
                ['login' => 7, 'just' => 'forFun4'],
                ['login' => 8, 'just' => 'forFun5']
            ],
            default => [],
        };
    }
}
