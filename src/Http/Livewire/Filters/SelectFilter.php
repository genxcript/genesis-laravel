<?php

namespace LaravelGenesis\Genesis\Http\Livewire\Filters;

use Illuminate\View\View;

class SelectFilter extends Filter
{
    public $options = [];

    public function render() : View
    {
        return view('genesis::filters.select', [
            'name' => $this->name,
            'attribute' => $this->attribute,
            'options' => $this->options,
        ]);
    }

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }
}
