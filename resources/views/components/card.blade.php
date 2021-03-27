@props(['shadow' => 'md'])
<div {{ $attributes->merge([
    'class' => 'bg-white overflow-hidden sm:rounded-lg p-4 shadow-' . $shadow, ]) }}>
    {{$slot}}
</div>
