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

todo('pass wrong repo path');
