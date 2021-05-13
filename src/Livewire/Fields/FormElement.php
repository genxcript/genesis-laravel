<?php

namespace LaravelGenesis\Genesis\Livewire\Fields;

use Illuminate\View\View;

abstract class FormElement
{
    /**
     * The displayable labe of the row.
     *
     * @var string
     */
    public $label;

    /**
     * The attribute name of the model.
     *
     * @var string
     */
    public $attribute;

    abstract public function render() : View;

    /**
     * Create a new form element.
     *
     * @param  string  $name
     * @param  string|null  $value
     * @return void
     */
    public function __construct($label, $attribute = null)
    {
        $this->label = $label;

        $this->attribute = $attribute ?? str_replace(' ', '_', strtolower($label));
    }

    /**
     * Create a new filter.
     */
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }
}
