<?php

namespace LaravelGenesis\Genesis\Livewire\Fields;

use Illuminate\View\View;
use LaravelGenesis\Genesis\Livewire\Traits\FormElement as FromElementTrait;

class Input extends FormElement
{
    use FromElementTrait;

    public function render()  : View
    {
        return view('genesis::fields.input', [
            'field' => $this,
        ]);
    }
}
