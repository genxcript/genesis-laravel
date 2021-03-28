<?php

namespace LaravelGenesis\Genesis\Http\Livewire\Traits;

trait WithBulkActions
{
    public $selectPage = false;
    public $selectAll = false;
    public $selected = [];

    public function renderingWithBulkActions()
    {
        if ($this->selectAll) {
            $this->selectPageRows();
        }
    }

    public function updatedSelected()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            return $this->selectPageRows();
        }

        $this->selectAll = false;
        $this->selected = [];
    }

    public function selectPageRows()
    {
        $this->selected = $this->items->pluck('id')->map(function ($id) {return (string) $id;});
    }

    public function selectAll()
    {
        $this->selectAll = true;
    }

    public function getSelectedItemsQueryProperty()
    {
        return (clone $this->query())
            ->unless($this->selectAll, function ($query) {
                return $query->whereKey($this->selected);
            });
    }

    public function selectedItems()
    {
        return $this->selectedItemsQuery->get();
    }

    public function actions()
    {
        return [];
    }

    public function handeleBulkAction($label, $action, $component = null)
    {
        $this->confirmationModalAction = $action;
        if ($component) {
            $this->confirmationModalBodyComponent = $component;
        }
        $this->confirmationModalTitle = __('genesis::general.execute_action').' '.$label;
        $this->confirmationModalBodyText = __('genesis::general.execute_action_confirm');
        $this->confirmationModalButtonText = __('genesis::general.execute_button');
        $this->showConfirmationModal = true;
    }
}
