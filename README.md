# Followers aggregator

![tests](https://github.com/asahnoln/ds-test/workflows/Tests/badge.svg)

## Configure

### ENV

- Set `GH_TOKEN` in `.env` to your personal access token from [GitHub](https://github.com/settings/personal-access-tokens/new)
- Set `GH_MIN_CONTRIBUTIONS` for minimum contributions count to define core contributors of a given repo.
By default it is set to 10.

## Run

Run command in console:

```fish
php artisan gh:followers:unique user/repo-name
```

which should response with something like this:

```fish
# user/repo-name core maintainers unique followers count: 264
```

## Tests

```fish
php artisan test
```

## Maintainer filtering

Current contributions filter DOES NOT GUARANTEE that user is a core maintainer,
or a core maintainer is present. Further analysis is needed.

As conditions for filtering maintainers are not specified
and might change in the future,
consider changing test user data in [GitHubClientStub](./tests/Stubs/GitHubClientStub.php)
for [FollowersTest](./tests/Feature/FollowersTest.php)
and then fixing `maintainerFilter` in [FollowerService](./app/Services/FollowerService.php).

## Files to investigate

Considering the task, you might be interested in specific files:

- Everything in tests: [Feature](./tests/Feature/) and [Unit](./tests/Unit/)  
- [Console command](./app/Console/Commands/GetGitHubUniqueFollowers.php)
- [FollowerService](./app/Services/FollowerService.php)
- [GitHubClient](./app/Clients/GitHubClient.php)
