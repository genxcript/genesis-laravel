<?php

namespace LaravelGenesis\Genesis\Livewire;

use Illuminate\Database\Eloquent\Model;

class TableRow
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
     * The render function of the row.
     *
     * @var callable
     */
    private $displayUsing;

    /**
     * Default classes of the row.
     */
    public $class = 'text-cool-gray-900 font-medium';

    /**
     * Html attributes of the row.
     */
    public $attributes;

    /**
     * Is special actions field.
     *
     * @var bool
     */
    public $isActions = false;
    public $showDelete = false;
    public $deleteComponent;

    public $showEdit = false;
    public $editAction;
    public $editComponent;

    /**
     * Create a new row.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @return void
     */
    public function __construct($name, $attribute = null)
    {
        $this->name = $name;

        $this->attribute = $attribute ?? str_replace(' ', '_', strtolower($name));
    }

    /**
     * Create a new row.
     */
    public static function make(...$arguments) : self
    {
        return new static(...$arguments);
    }

    /**
     * Create a new row.
     */
    public static function makeActions($name = null, $modelKey = 'id') : self
    {
        $instance = new static($name ?? __('genesis::general.actions'), $modelKey);
        $instance->isActions = true;

        return $instance;
    }

    /**
     * Display row using the callable function.
     */
    public function displayUsing(callable $callBack) : self
    {
        $this->displayUsing = $callBack;

        return $this;
    }

    /**
     * Show the attribute as a boolean icon in the table.
     *
     */
    public function asBoolean()
    {
        // $this->displayUsing(function ($id, $model) {
        $this->displayUsing(function ($model) {
            return view('genesis::components.boolean', ['value' => $model->{$this->attribute}]);
        });

        return $this;
    }

    /**
     * Display row using the given view.
     */
    public function displayUsingView($name, $data = [], $mergeData = []) : self
    {
        return $this->displayUsing(function ($attribute, $item) use ($name, $data, $mergeData) {
            return view(
                $name,
                array_merge($data, [$attribute, $item]),
                $mergeData
            );
        });
    }

    /**
     * Render the row.
     */
    public function render(Model $item)
    {
        if (is_null($this->displayUsing)) {
            return $item->{$this->attribute};
        }

        return call_user_func($this->displayUsing, $item->{$this->attribute}, $item);
    }

    /**
     * CSS class of the row.
     */
    public function withClass(...$class) : self
    {
        $this->class = implode(' ', $class);

        return $this;
    }

    /**
     * Html attributes of the row.
     */
    public function withAttributes(...$attributes) : self
    {
        $this->attributes = implode(' ', $attributes);

        return $this;
    }

    public function delete(string $action, string $component = null) : self
    {
        $this->deleteComponent = $component;
        // $this->deleteAction = $action;
        $this->showDelete = true;

        return $this;
    }

    public function edit($action) : self
    {
        if (is_callable($action)) {
            $this->editAction = $action;
        } else {
            $this->editComponent = $action;
        }
        $this->showEdit = true;

        return $this;
    }
}
