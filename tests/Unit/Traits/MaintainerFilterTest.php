<?php

use App\Services\Traits\MaintainerFilterByName;

it('filters out asahnoln', function () {
    $c = new class () {
        use MaintainerFilterByName;

        public function test(array $item): bool
        {
            return $this->maintainerFilter($item);
        }
    };

    $res = $c->test(['login' => 'asahnoln']);

    expect($res)->toBeFalse();
});
