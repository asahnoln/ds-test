<?php

use App\Clients\GitHubClient;
use App\Contracts\GitHubClientInterface;
use GrahamCampbell\GitHub\GitHubManager;

it('gets maintainers by condition', function () {
    $m = Mockery::mock(GitHubManager::class);
    $m->shouldReceive('repo')->with()->andReturnSelf();
    $m->shouldReceive('contributors')->with('fooUser', 'barRepo')->andReturn(['I', 'you', 'longNameToFilterOut']);
    $c = new GitHubClient($m);

    expect($c)->toBeInstanceOf(GitHubClientInterface::class);

    $ms = $c->maintainers('fooUser', 'barRepo', function (string $item) {
        return strlen($item) < 4;
    });
    expect($ms)->toHaveCount(2);
});

it('gets followers', function () {
    $m = Mockery::mock(GitHubManager::class);
    $m->shouldReceive('user')->with()->andReturnSelf();
    $m->shouldReceive('followers')->with('greatGuy')->andReturn(['a', 'b', 'c', 'd', 'e']);
    $c = new GitHubClient($m);

    $ms = $c->followers('greatGuy');
    expect($ms)->toHaveCount(5);
});
