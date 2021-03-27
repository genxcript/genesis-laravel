<?php

namespace Square1\Genesis\Http\Livewire\Traits;

trait WithExtraView
{
    abstract public function extraView() : string;

    public function initializeWithExtraView()
    {
        $this->usingExtraView = true;
    }
}
