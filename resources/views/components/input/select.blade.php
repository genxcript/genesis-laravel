@props([
'placeholder' => null,
'trailingAddOn' => null,
'disabled' => false
])

<div class="flex">
    <select {{$disabled ? 'disabled' : ''}} {{ $attributes->merge(['class' => 'form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}>
        <option value="">{{ $placeholder ?? __('genesis::general.select_option') }}</option>

        {{ $slot }}
    </select>

    @if ($trailingAddOn)
    {{ $trailingAddOn }}
    @endif
</div>
