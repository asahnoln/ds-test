<?php


use App\Contracts\FollowerServiceInterface;

use function Pest\Laravel\artisan;

it('calls for unique followers command', function () {
    app()->bind(FollowerServiceInterface::class, FollowerServiceStub::class);

    artisan('gh:followers:unique testUser/testRepo')
        ->expectsOutput('testUser/testRepo core maintainers unique followers count: 3')
        ->assertSuccessful();
});

class FollowerServiceStub implements FollowerServiceInterface
{
    public function uniqueFollowersCount(string $fullRepoName): int
    {
        return 3;
    }
}
