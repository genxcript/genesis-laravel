<div>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $editTitle ?? __('genesis::general.edit_item')}}
        </div>

        <div class="mt-4">
            @if($viewPath)
            @include($viewPath)
            @endif
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-right">
        <x-gen-button.secondary wire:click="clearDialogEditModalData">{{__('genesis::general.cancel_button')}}</x-gen-button.secondary>

        <x-gen-button.primary wire:click="save">{{__('genesis::general.edit_item')}}</x-gen-button.primary>

    </div>
</div>
