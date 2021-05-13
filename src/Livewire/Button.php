<?php

namespace LaravelGenesis\Genesis\Livewire;

use LaravelGenesis\Genesis\Livewire\Traits\FormElement;

class Button
{
    use FormElement;

    public $component = 'button.primary';
    public $action;
    public $label;
    public $align = 'rigth';
    public $class;

    /**
    * Create a new button
    *
    * @param  string  $name
    * @param  string|null  $value
    * @return void
    */
    public function __construct(string $label, string $action = 'save')
    {
        $this->label = $label;

        $this->action = $action;
    }

    /**
     * Create a new button.
     */
    public static function make(...$arguments): self
    {
        return new static(...$arguments);
    }

    public function type(string $type)
    {
        switch ($type) {
            case 'link':
                $this->component = 'button.link';

                break;

            case 'secondary':
                $this->component = 'button.secondary';

                break;

            default:
                $this->component = 'button.primary';

                break;
        }

        return $this;
    }

    public function align(string $align)
    {
        switch ($align) {
            case 'center':
                $this->class = $this->class.'m-auto block';

                break;

            case 'left':
                $this->class = $this->class.'';

                break;

            default:
                $this->class = '';

                break;
        }

        return $this;
    }

    public function size()
    {
        return $this;
    }

    public function render()
    {
        return view('genesis::general.form_button')
        ->with([
            'component' => $this->component,
            'action' => $this->action,
            'label' => $this->label,
            'class' => 'w-full ' .$this->class,
        ]);
    }
}
