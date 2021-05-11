<x-gen-columns grid="{{is_null($gridSize) ? count($fields) : $gridSize}}">
    @foreach($fields as $field)
    <x-gen-column size="{{$field->rowSize}}">
        {!! $field->render() !!}
    </x-gen-column>
    @endforeach
</x-gen-columns>
