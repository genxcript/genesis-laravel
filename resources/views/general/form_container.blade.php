<div>
    <h1 class="text-2xl font-semibold text-gray-900">Some title</h1>

    <form wire:submit.prevent="save">
        @foreach($this->fieldsList as $field)
            {!! $field->render() !!}
        @endforeach

        <button type="submit">Create</button>
    </form>
</div>
