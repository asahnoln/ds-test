<?php

use App\Clients\GitHubClient;
use App\Contracts\FollowerServiceInterface;
use App\Contracts\GitHubClientInterface;
use App\Services\FollowerService;

test('GitHubClient is default implementation for the interface', function () {
    $c = app(GitHubClientInterface::class);
    expect($c)->toBeInstanceOf(GitHubClient::class);
});

test('FollowerService is default implementation for the interface', function () {
    $s = app(FollowerServiceInterface::class);
    expect($s)->toBeInstanceOf(FollowerService::class);
});
