<?php

namespace App\Services\Traits;

trait MaintainerFilterByName
{
    protected function maintainerFilter(array $item): bool
    {
        return true;
    }
}
