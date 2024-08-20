# Followers aggregator

![tests](https://github.com/asahnoln/ds-test/workflows/Tests/badge.svg)

## Configure

### ENV

- Set `GH_TOKEN` in `.env` to your personal access token from [GitHub](https://github.com/settings/personal-access-tokens/new)
- Set `GH_MIN_CONTRIBUTIONS` for minimum contributions count to define core contributors of a given repo. By default it is set to 10.

## Run

Run command in console:

```fish
php artisan gh:followers:unique user/repo-name
```

which should response with something like this:

```fish
# user/repo-name core maintainers unique followers count: 264
```

## Things to consider

### Unhappy path

The app developed with happy path only. Possible errors are not handled. Usually they just lead to exception being shown without affecting proper app behavior.

#### Unhappy path

What is missing in error handling

- [ ] Wrong path to repo
- [ ] Inability to connect to github

### Maintainer filtering

Current contributions filter DOES NOT GUARANTEE that user is a core maintainer, or a core maintainer is present. Further analysis is needed.

As conditions for filtering maintainers are not specified and might change in the future, consider changing user data in `GitHubClientStub` for [FollowersTest](./tests/Feature/FollowersTest.php) and then fixing `maintainerFilter` in [FollowerService](./app/Services/FollowerService.php).
