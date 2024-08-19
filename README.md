# Followers aggregator

## Maintainer filtering

As conditions for filtering maintainers are not specified and might change in the future, trais approach is provided to quickly substitute one filtering condition with another.

Example at [./app/Services/Traits/MaintainerFilterByName.php]

```php
trait MaintainerFilterByName
{
    protected function maintainerFilter(array $item): bool
    {
        return true;
    }
}
```

then use it in [./app/Services/FollowerService.php]

```php
class FollowerService extends BaseFollowerService
{
    use MaintainerFilterByName;
```

## TODO

- GH Client
  - Auth data (token)

- [ ] getFollowersCount('repoName') -> int
