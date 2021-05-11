<?php

namespace LaravelGenesis\Genesis\Livewire\Traits;

trait WithExtraView
{
    abstract public function extraView() : string;

    public function initializeWithExtraView()
    {
        $this->usingExtraView = true;
    }
}
