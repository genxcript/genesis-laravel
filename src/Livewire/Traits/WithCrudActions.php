<?php

namespace LaravelGenesis\Genesis\Livewire\Traits;

trait WithCrudActions
{
    public $showDialogEditModal = false;
    public $dialogEditModalItemId;
    public $dialogEditModalAction;
    public $dialogEditModalBodyComponent;
    public $dialogEditModalTitle;
    public $dialogEditModalBodyText;
    public $dialogEditModalButtonText;

    public function clearDialogEditModalData()
    {
        $this->showDialogEditModal = false;
        $this->dialogEditModalItemId = null;
        $this->dialogEditModalAction = null;
        $this->dialogEditModalBodyComponent = null;
        $this->dialogEditModalTitle = null;
        $this->dialogEditModalBodyText = null;
        $this->dialogEditModalButtonText = null;
    }

    public function handeleEdit($itemId, $component)
    {
        $component = str_replace('"', '', $component);

        $this->dialogEditModalItemId = $itemId;
        $this->dialogEditModalBodyComponent = $component;
        $this->dialogEditModalTitle = __('genesis::general.edit_item');
        $this->dialogEditModalButtonText = __('genesis::general.edit_button');
        $this->showDialogEditModal = true;
    }

    public function executeDialogEditModalAction()
    {
        $this->emit('genesisEditActionCalled');
    }

    public function handeleDelete($itemId, $action, $component = null)
    {
        $this->confirmationModalItemId = $itemId;
        $this->confirmationModalAction = $action;
        if ($component) {
            $this->confirmationModalBodyComponent = $component;
        }
        $this->confirmationModalTitle = __('genesis::general.delete_item');
        $this->confirmationModalBodyText = __('genesis::general.delete_item_confirmation', ['itemId' => $itemId]);
        $this->confirmationModalButtonText = __('genesis::general.delete_button');
        $this->showConfirmationModal = true;
    }

    public function executeConfirmationModalAction()
    {
        $this->{$this->confirmationModalAction}($this->confirmationModalItemId);
    }
}
