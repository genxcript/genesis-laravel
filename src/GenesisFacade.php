<?php

namespace LaravelGenesis\Genesis;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelGenesis\Genesis\Genesis
 */
class GenesisFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'genesis';
    }
}
