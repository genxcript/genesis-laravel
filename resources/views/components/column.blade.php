@props(['size' => 'auto'])
<div {{ $attributes->merge([
    'class' => 'col-span-'.$size.' mb-4 sm:mb-0'
]) }}>
    {{$slot}}
</div>
