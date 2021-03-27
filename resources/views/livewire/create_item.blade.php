<div>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $createTitle ?? __('genesis::general.create_item')}}
        </div>

        <div class="mt-4">
            @if($viewPath)
            @include($viewPath)
            @endif
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        <x-gen-button.secondary wire:click="clearDialogCreateModalData">{{__('genesis::general.cancel_button')}}</x-gen-button.secondary>

        <x-gen-button.primary wire:click="save">{{__('genesis::general.create_item')}}</x-gen-button.primary>

    </div>
</div>
