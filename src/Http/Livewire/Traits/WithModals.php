<?php

namespace Square1\Genesis\Http\Livewire\Traits;

trait WithModals
{
    public $showDialogModal = false;
    public $dialogModalItemId;
    public $dialogModalAction;
    public $dialogModalBodyComponent;
    public $dialogModalTitle;
    public $dialogModalBodyText;
    public $dialogModalButtonText;

    public $showConfirmationModal = false;
    public $confirmationModalItemId;
    public $confirmationModalAction;
    public $confirmationModalBodyComponent;
    public $confirmationModalTitle;
    public $confirmationModalBodyText;
    public $confirmationModalButtonText;

    public function clearDialogModalData()
    {
        $this->showDialogModal = false;
        $this->dialogModalItemId = null;
        $this->dialogModalAction = null;
        $this->dialogModalBodyComponent = null;
        $this->dialogModalTitle = null;
        $this->dialogModalBodyText = null;
        $this->dialogModalButtonText = null;
    }

    public function clearConfirmationModalData()
    {
        $this->showConfirmationModal = false;
        $this->confirmationModalItemId = null;
        $this->confirmationModalAction = null;
        $this->confirmationModalBodyComponent = null;
        $this->confirmationModalTitle = null;
        $this->confirmationModalBodyText = null;
        $this->confirmationModalButtonText = null;
    }
}
