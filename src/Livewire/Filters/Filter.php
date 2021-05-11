<?php

namespace LaravelGenesis\Genesis\Livewire\Filters;

use Illuminate\View\View;

abstract class Filter
{
    /**
     * The displayable name of the row.
     *
     * @var string
     */
    public $name;

    /**
     * The attribute name of the model.
     *
     * @var string
     */
    public $attribute;

    /**
     * The tailwind width class
     *
     * @var string
     */
    public $width = 'w-1/3';

    abstract public function render() : View;

    /**
     * Create a new filter.
     *
     * @param  string  $name
     * @param  string|null  $value
     * @return void
     */
    public function __construct($name, $attribute = null)
    {
        $this->name = $name;

        $this->attribute = $attribute ?? str_replace(' ', '_', strtolower($name));
    }

    /**
     * Create a new filter.
     */
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }

    public function withClass($class)
    {
        $this->width = $class;

        return $this;
    }
}
