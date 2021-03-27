<?php

namespace Square1\Genesis\Http\Livewire;

use Livewire\Component;
use Square1\Genesis\TableRow;
use Illuminate\Database\Eloquent\Builder;
use Square1\Genesis\Http\Livewire\Traits\WithModals;
use Square1\Genesis\Http\Livewire\Traits\WithSearch;
use Square1\Genesis\Http\Livewire\Traits\WithBulkActions;
use Square1\Genesis\Http\Livewire\Traits\WithCrudActions;
use Square1\Genesis\Http\Livewire\Traits\WithPerPagePagination;

abstract class ResourceTable extends Component
{
    use WithPerPagePagination, WithSearch, WithModals, WithCrudActions, WithBulkActions;

    public $usingCreateView = false;
    public $usingExtraView = false;
    public $usingFilters = false;

    protected $listeners = ['clearDialogEditModalData', 'clearDialogCreateModalData'];

    /**
     * Get items for the table.
     */
    public function getItemsProperty()
    {
        $query = $this->query();

        if ($this->usingFilters) {
            // Maybe apply query filters here?
        }

        return $this->applyPagination($query);
    }

    /**
     * Query the items for the table.
     */
    abstract protected function query() : Builder;

    /**
     * Get the columns for the table.
     */
    abstract public function getRowsProperty() : array;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('genesis::livewire.table', [
            'items' => $this->items,
            'fields' => collect($this->rows)
                ->map(function ($item) {
                    return is_object($item) ? $item : TableRow::make($item);
                }),
        ]);
    }

    public function formProps() : array
    {
        return [];
    }
}
