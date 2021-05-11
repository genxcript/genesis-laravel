<?php

namespace LaravelGenesis\Genesis\Http\Livewire;

use Livewire\Component;

abstract class GenesisForm extends Component
{
    abstract protected function fields();

    abstract protected function save();

    public function getFieldsListProperty()
    {
        return $this->fields();
    }

    public function render()
    {
        return view('genesis::general.form_container');
    }
}
