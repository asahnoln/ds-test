# Followers aggregator

![tests](https://github.com/asahnoln/ds-test/workflows/Tests/badge.svg)

## Configure

### ENV

Set `GH_TOKEN` in `.env` to your personal access token from [GitHub](https://github.com/settings/personal-access-tokens/new)

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

#### What missed in error handling

- [ ] Wrong path to repo (both in syntax and )
- [ ] Inability to connect to github
- [ ] Wrong token

### Maintainer filtering

Current contributions filter DOES NOT GUARANTEE that user is a core maintainer, or a core maintainer is present. Further analysis is needed.

As conditions for filtering maintainers are not specified and might change in the future, consider changing user data in `FollowerServiceStub` for `FollowersTest` and then fixing `maintainerFilter` in [FollowerService](./app/Services/FollowerService.php).
