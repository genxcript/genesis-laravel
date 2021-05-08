<x-gen-menu-item :href="route('genesis::users.index')" icon="user" :active="request()->routeIs('genesis::users.index')">
   {{ __('Users') }}
</x-gen-menu-item>
