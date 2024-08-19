<?php

use App\Services\Traits\MaintainerFilterByContributions;

it('filters out small contributions', function () {
    $c = new class () {
        use MaintainerFilterByContributions;

        public function test(array $item): bool
        {
            return $this->maintainerFilter($item);
        }
    };

    $res = $c->test([
        'contributions' => 9
    ]);

    expect($res)->toBeFalse();
});
