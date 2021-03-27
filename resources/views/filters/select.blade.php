<x-gen-input.group inline for="filter-{{$attribute}}" label="{{$name}}">
    <x-gen-input.select wire:change.defer="setFilter('{{$attribute}}', event.target.value)" id="filter-{{$attribute}}">
        <option value="" disabled>{{$name}}...</option>

        @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </x-gen-input.select>
</x-gen-input.group>
