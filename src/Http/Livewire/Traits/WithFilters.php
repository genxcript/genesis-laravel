<?php

namespace Square1\Genesis\Http\Livewire\Traits;

trait WithFilters
{
    public $showFilters = false;
    public $filter = [];

    abstract public function getFiltersProperty() : array;

    public function initializeWithFilters()
    {
        $this->usingFilters = true;
    }

    public function toggleFilters()
    {
        $this->showFilters = ! $this->showFilters;
    }

    public function getFilterValueFor($filter)
    {
        if (! array_key_exists($filter, $this->filter)) {
            return null;
        }

        return $this->filter[$filter];
    }

    public function setFilter($filter, $value)
    {
        $this->filter[$filter] = $value;
    }

    public function unsetFilter($filter)
    {
        $this->filter = array_splice($this->filter, $filter);
    }

    public function resetFilters()
    {
        $this->reset('filter');
    }
}
