<x-dynamic-component :component="'gen-'.$component" :class="$class" wire:click="{{$action}}">
{{$label}}
</x-dynamic-component>
