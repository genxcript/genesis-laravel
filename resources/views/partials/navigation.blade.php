<x-gen-menu-item :href="route('genesis::users.index')" icon="currency-dollar" :active="request()->routeIs('genesis::users.index')">
   {{ __('Users') }}
</x-gen-menu-item>
