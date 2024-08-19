<?php

namespace App\Services;

abstract class BaseFollowerService
{
    /**
     * TODO: Implement filter function
     * when you find criteria to filter CORE MAINTAINERS
     *
     * @param array<int,mixed> $item Contributor object
     *
     * @return bool
     */
    abstract protected function maintainerFilter(array $item): bool;
}
