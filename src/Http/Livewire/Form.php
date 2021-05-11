<?php

namespace LaravelGenesis\Genesis\Http\Livewire;

use Livewire\Component;

abstract class Form extends Component
{
    public $purpose;
    public $viewPath;
    public $editTitle;
    public array $props;

    protected $listeners = [
        'genesisEditActionCalled' => 'save',
        'genesisCreateActionCalled' => 'save',
    ];

    /**
     * Receive the item id in order to initialize your component.
     */
    abstract protected function mount($itemId = null);

    abstract protected function save();

    public function clearDialogCreateModalData()
    {
        $this->emit('clearDialogCreateModalData');
    }

    public function clearDialogEditModalData()
    {
        $this->emit('clearDialogEditModalData');
    }

    public function render()
    {
        if ($this->purpose == 'edit') {
            return view('genesis::general.edit_item');
        }
        if ($this->purpose == 'create') {
            return view('genesis::general.create_item');
        }
    }
}
