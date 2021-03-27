<?php

namespace Square1\Genesis\Http\Livewire\Traits;

trait WithCreateView
{
    public $createView;

    public $showDialogCreateModal = false;
    public $dialogCreateModalAction;
    public $dialogCreateModalBodyComponent;
    public $dialogCreateModalTitle;
    public $dialogCreateModalBodyText;
    public $dialogCreateModalButtonText;

    public function clearDialogCreateModalData()
    {
        $this->showDialogCreateModal = false;
        $this->dialogCreateModalAction = null;
        $this->dialogCreateModalTitle = null;
        $this->dialogCreateModalBodyText = null;
        $this->dialogCreateModalButtonText = null;
    }

    public function handeleCreate()
    {
        $this->dialogCreateModalTitle = __('genesis::general.create_item');
        $this->dialogCreateModalButtonText = __('genesis::general.create_button');
        $this->showDialogCreateModal = true;
    }

    abstract public function createView() : string;

    public function initializeWithCreateView()
    {
        $this->dialogCreateModalBodyComponent = $this->createView();
        $this->usingCreateView = true;
    }
}
