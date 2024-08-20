<?php

use App\Services\FollowerService;
use Tests\Stubs\GitHubClientStub;

it('gets unique followers', function () {
    config(['app.gh.min_contributions' => 20]);

    $c = new GitHubClientStub();
    $s = new FollowerService($c);

    $count = $s->uniqueFollowersCount('testUser/testRepo');

    expect($count)->toBe(7);
});

it('pass wrong repo path', function () {
    $c = new GitHubClientStub();
    $s = new FollowerService($c);

    $s->uniqueFollowersCount('superwrong');
})->throws("'superwrong' is not a valid repo path. Try 'owner/repo' format.");

it('pass long repo path', function () {
    $c = new GitHubClientStub();
    $s = new FollowerService($c);

    $s->uniqueFollowersCount('super/long/something');
})->throws("'super/long/something' is not a valid repo path. Try 'owner/repo' format.");
