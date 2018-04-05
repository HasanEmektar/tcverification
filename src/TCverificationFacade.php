<?php

namespace HasanEmektar\tc;

use Illuminate\Support\Facades\Facade;

class TCverificationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tcverification';
    }
}