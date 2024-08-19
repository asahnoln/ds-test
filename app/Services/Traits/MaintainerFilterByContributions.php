<?php

namespace App\Services\Traits;

trait MaintainerFilterByContributions
{
    protected function maintainerFilter(array $item): bool
    {
        return $item['contributions'] >= 10;
    }
}
