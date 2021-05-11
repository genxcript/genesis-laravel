<x-gen-input.group for="{{spl_object_id($field)}}" label="{{$field->label}}" inline :error="$errors->first($field->attribute)">
    <x-gen-input.text id="{{spl_object_id($field)}}" wire:model.defer="{{$field->attribute}}" />
</x-gen-input.group>
