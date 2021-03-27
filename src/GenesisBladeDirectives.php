<?php

namespace LaravelGenesis\Genesis;

class GenesisBladeDirectives
{
    public static function genesisStyles($expression)
    {
        return '{!! \LaravelGenesis\Genesis\GenesisFacade::styles('.$expression.') !!}';
    }

    public static function genesisScripts($expression)
    {
        return '{!! \LaravelGenesis\Genesis\GenesisFacade::scripts('.$expression.') !!}';
    }
}
