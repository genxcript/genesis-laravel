<?php

namespace LaravelGenesis\Genesis\Http\Livewire\Traits;

trait WithSearch
{
    public $showSearchBox = true;

    /**
     * Search property.
     */
    public $search = '';

    /**
     * Initialize the with search trait.
     *
     * @return void
     */
    public function initializeWithSearch()
    {
        $this->queryString = array_merge([
            'search' => ['except' => ''],
        ], $this->queryString);
    }

    /**
     * Reset page on search update.
     */
    public function updatingSearch()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /**
     * Clear the search query.
     */
    public function clearSearch()
    {
        $this->search = '';
    }
}
