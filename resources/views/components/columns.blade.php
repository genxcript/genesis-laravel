@props(['grid', 'gap' => "4"])
<div {{ $attributes->merge([
    'class' => 'sm:grid grid-cols-1 sm:grid-cols-'.$grid.' gap-'.$gap ]) }}>
    {{$slot}}
</div>
