<?php

namespace LaravelGenesis\Genesis\Http\Livewire;

class Column
{
    public $gridSize = null;

    public $fields;

    /**
     * Create a new column
     *
     * @param  string  $name
     * @param  string|null  $value
     * @return void
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Create a new column.
     */
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }

    public function rows(int $amount) : self
    {
        $this->gridSize = $amount;

        return $this;
    }

    public function render()
    {
        return view('genesis::general.column_container')
        ->with([
            'gridSize' => $this->gridSize,
            'fields' => $this->fields,
        ]);
    }
}
