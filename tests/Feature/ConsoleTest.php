<?php


use App\Contracts\FollowerServiceInterface;

use App\Contracts\GitHubClientInterface;
use Tests\Stubs\FollowerServiceFailingStub;
use Tests\Stubs\GitHubClientStub;

use function Pest\Laravel\artisan;

beforeEach(function () {
    config(['github.connections.main.token' => 'my-token']);
});

it('calls for unique followers command', function () {
    app()->bind(FollowerServiceInterface::class, FollowerServiceStub::class);

    artisan('gh:followers:unique testUser/testRepo')
        ->expectsOutput('testUser/testRepo core maintainers unique followers count: 3')
        ->assertSuccessful();
});

it('fails when token is not set', function () {
    config(['github.connections.main.token' => null]);

    app()->bind(GitHubClientInterface::class, GitHubClientStub::class);

    artisan('gh:followers:unique testUser/testRepo')
        ->expectsOutputToContain('GitHub token is not set')
        ->assertFailed();
});

it('returns all errors', function (\Throwable $throwable) {
    $f = new FollowerServiceFailingStub($throwable);
    app()->bind(FollowerServiceInterface::class, fn () => $f);

    artisan('gh:followers:unique testUser/testRepo')
        ->expectsOutputToContain($throwable->getMessage())
        ->assertFailed();
})->with([
    new \Exception('This is an exception'),
    new \Error('This is an error'),
]);

class FollowerServiceStub implements FollowerServiceInterface
{
    public function uniqueFollowersCount(string $fullRepoName): int
    {
        return 3;
    }
}
