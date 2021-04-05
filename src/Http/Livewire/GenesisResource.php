<?php

namespace LaravelGenesis\Genesis\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaravelGenesis\Genesis\Http\Livewire\Traits\WithBulkActions;
use LaravelGenesis\Genesis\Http\Livewire\Traits\WithCrudActions;
use LaravelGenesis\Genesis\Http\Livewire\Traits\WithModals;
use LaravelGenesis\Genesis\Http\Livewire\Traits\WithPerPagePagination;
use LaravelGenesis\Genesis\Http\Livewire\Traits\WithSearch;
use Livewire\Component;

abstract class GenesisResource extends Component
{
    use WithPerPagePagination;
    use WithSearch;
    use WithModals;
    use WithCrudActions;
    use WithBulkActions;

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

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    {
        $resource = Str::replaceLast('Resource', '', class_basename(get_called_class()));

        return Str::plural(Str::kebab($resource));
    }
}
