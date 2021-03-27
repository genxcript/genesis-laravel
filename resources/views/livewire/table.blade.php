<div>
    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="w-2/4 flex space-x-4">
                @if($showSearchBox)
                <x-gen-input.text wire:model="search" placeholder="{{ __('genesis::general.search') }}" />
                @endif

                @if($usingFilters)
                <x-gen-button.link wire:click="toggleFilters">
                    @if ($showFilters)
                    <x-gen-icon.close />
                    @else
                    <x-gen-icon.filter />
                    @endif
                </x-gen-button.link>
                @endif
            </div>
            <div class="space-x-2 flex items-center">
                <span>
                    @if($showPerPageDropdown)
                    <x-gen-input.group borderless paddingless for="perPage" label="{{ __('genesis::general.per_page') }}">
                        <x-gen-input.select wire:model="perPage" id="perPage">
                            @foreach($perPageOptions as $option)
                            <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </x-gen-input.select>
                    </x-gen-input.group>
                    @endif
                </span>
                <span>
                    @if(count($this->actions()))
                    <x-gen-dropdown label="{{__('genesis::general.actions')}}">
                        @foreach($this->actions() as $label => $action)

                        <x-gen-dropdown.item type="button" wire:click="handeleBulkAction('{{$label}}', '{{$action}}')" class="flex items-center space-x-2">
                            <span class="text-cool-gray-400">{{$label}}</span>
                        </x-gen-dropdown.item>
                        @endforeach
                    </x-gen-dropdown>
                    @endif
                </span>
                <span>
                    @if($this->usingCreateView)
                    <div wire:click="handeleCreate" class="bg-gray-200 text-white h-8 w-8 rounded-full cursor-pointer flex items-center justify-center shadow-sm">
                        <x-gen-icon.plus />
                    </div>
                    @endif
                </span>
            </div>
        </div>

        <!-- Advanced Search -->
        <div>
            @if ($usingFilters && $showFilters)

            <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                @foreach($this->filters as $filter)
                <div class="w-full md:{{$filter->width}} pr-2 space-y-4">
                    {!! $filter->render() !!}
                </div>
                @endforeach
            </div>
            @if (count($this->filter))
            <div class="flex justify-end">
                <x-gen-button.link wire:click="resetFilters" class="p-4">
                    {{__('genesis::general.reset_filters')}}
                </x-gen-button.link>
            </div>
            @endif
            @endif
        </div>

        <!-- Transactions Table -->
        <div class="flex-col space-y-4">
            <x-gen-table>
                <x-slot name="head">
                    <x-gen-table.heading class="pr-0 w-8">
                        <x-gen-input.checkbox wire:model="selectPage" />
                    </x-gen-table.heading>
                    @foreach($fields as $field)
                    <x-gen-table.heading class="{{$field->isActions ? 'flex justify-center' : ''}}" sortable multi-column wire:click="sortBy('{{$field->attribute}}')" :direction="$sorts['{{$field->attribute}}'] ?? null">{{$field->name}}</x-gen-table.heading>
                    @endforeach
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-gen-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-gen-table.cell colspan="{{count($fields)+1}}">
                            @unless ($selectAll)
                            <div>
                                <span>You have selected <strong>{{ $items->count() }}</strong> transactions, do you want to select all <strong>{{ $items->total() }}</strong>?</span>
                                <x-gen-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All</x-gen-button.link>
                            </div>
                            @else
                            <span>You are currently selecting all <strong>{{ $items->total() }}</strong> transactions.</span>
                            @endif
                        </x-gen-table.cell>
                    </x-gen-table.row>
                    @endif

                    @forelse ($items as $item)
                    <x-gen-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $item->id }}">
                        <x-gen-table.cell class="pr-0">
                            <x-gen-input.checkbox wire:model="selected" value="{{ $item->id }}" />
                        </x-gen-table.cell>

                        {{-- <x-gen-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-gen-icon.cash class="text-cool-gray-400" />

                                <p class="text-cool-gray-600 truncate">
                                    {{ $item->title }}
                        </p>
                        </span>
                        </x-gen-table.cell> --}}

                        @foreach($fields as $field)

                        <x-gen-table.cell>
                            @if($field->isActions)
                            @include('genesis::table_actions', ['item' => $item, 'field' => $field])
                            @else
                            <span {!!$field->attributes!!} class="{{$field->class}}">{!! $field->render($item) !!} </span>
                            @endif
                        </x-gen-table.cell>
                        @endforeach

                        {{-- <x-gen-table.cell>
                            <x-gen-button.link wire:click="edit({{ $item->id }})">Edit</x-gen-button.link>
                        </x-gen-table.cell> --}}
                    </x-gen-table.row>
                    @empty
                    <x-gen-table.row>
                        <x-gen-table.cell colspan="{{count($fields)+1}}">
                            <div class="flex justify-center items-center space-x-2">
                                <x-gen-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('genesis::general.no_items_found') }}</span>
                            </div>
                        </x-gen-table.cell>
                    </x-gen-table.row>
                    @endforelse
                </x-slot>
            </x-gen-table>

            <div>
                {{ $items->links('genesis::pagination') }}
            </div>
        </div>
    </div>

    @if($usingExtraView)
    @include($this->extraView())
    @endif

    <x-gen-modal.confirmation wire:model.defer="showConfirmationModal">
        <x-slot name="title">{{$confirmationModalTitle}}</x-slot>

        <x-slot name="content">
            @if($confirmationModalBodyComponent)
            @livewire($confirmationModalBodyComponent, ['itemId' => $confirmationModalItemId])
            @else
            <div class="py-8 text-cool-gray-700">{{$confirmationModalBodyText}}</div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-gen-button.secondary wire:click="$set('showConfirmationModal', false);clearConfirmationModalData">{{__('genesis::general.cancel_button')}}</x-gen-button.secondary>

            <x-gen-button.primary wire:click="executeConfirmationModalAction">{{$confirmationModalButtonText}}</x-gen-button.primary>
        </x-slot>
    </x-gen-modal.confirmation>

    <x-gen-modal.dialog wire:model.defer="showDialogModal">
        <x-slot name="title">{{$dialogModalTitle}}</x-slot>

        <x-slot name="content">
            @if($dialogModalBodyComponent)
            @livewire($dialogModalBodyComponent, ['itemId' => $dialogModalItemId])
            @else
            <div class="py-8 text-cool-gray-700">{{$dialogModalBodyText}}</div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-gen-button.secondary wire:click="$set('showDialogModal', false);clearDialogModalData">{{__('genesis::general.cancel_button')}}</x-gen-button.secondary>

            <x-gen-button.primary wire:click="executeDialogModalAction">{{$dialogModalButtonText}}</x-gen-button.primary>
        </x-slot>
    </x-gen-modal.dialog>
    <x-gen-modal wire:model.defer="showDialogEditModal">

        @if($dialogEditModalBodyComponent)
        {!! \Genesis::mountForm($this->dialogEditModalBodyComponent, ['itemId' => $dialogEditModalItemId, 'props' => $this->formProps(), 'purpose' => 'edit']) !!}
        @endif

    </x-gen-modal>
    @if ($usingCreateView)
    <x-gen-modal wire:model.defer="showDialogCreateModal">

        @if($usingCreateView)
        {!! \Genesis::mountForm($this->dialogCreateModalBodyComponent, ['props' => $this->formProps(), 'purpose' => 'create']) !!}
        @endif

    </x-gen-modal>
    @endif
</div>
