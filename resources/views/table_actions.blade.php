<div class="flex justify-center">
    @if($field->showEdit)
    @if($field->editAction)
    <x-gen-icon.edit class="mx-1 cursor-pointer" @click="window.location.href = '{{ call_user_func($field->editAction, $item->{$field->attribute})}}'" />
    @else
    <x-gen-icon.edit class="mx-1 cursor-pointer" wire:click="handeleEdit('{{$item->id}}', '{{json_encode($field->editComponent)}}')" />
    @endif
    @endif
    @if($field->showDelete)
    <x-gen-icon.trash class="mx-1 cursor-pointer" wire:click="handeleDelete('{{$item->id}}', '{{$field->deleteAction}}', '{{$field->deleteComponent}}')" />
    @endif
</div>
