<?php

namespace App\Services\Wink;

use Illuminate\Support\Facades\Facade;

class WinkFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Wink';
    }
}
