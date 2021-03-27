<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Envoy') }}</title>
    <link rel="icon" href="/favicon.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    @genesisStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body class="antialiased font-sans bg-gray-200">
    <div>
        <div style="min-height: 640px;" class="bg-gray-100">

            <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
                <!-- Off-canvas menu for mobile -->
                <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
                    <div class="fixed inset-0 flex z-40">
                        <div @click="sidebarOpen = false" x-show="sidebarOpen" x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state." x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0" style="display: none;">
                            <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                        </div>
                        <div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state." x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white" style="display: none;">
                            <div class="absolute top-0 right-0 -mr-14 p-1">
                                <button x-show="sidebarOpen" @click="sidebarOpen = false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar" style="display: none;">
                                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex-shrink-0 flex items-center px-4">
                                <a href="/">
                                    <x-jet-application-mark class="block h-8 w-auto" />
                                </a>
                            </div>
                            <div class="mt-5 flex-1 h-0 overflow-y-auto">
                                <nav class="px-2 space-y-1">

                                    @include('genesis::navigation')

                                </nav>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-14">
                            <!-- Dummy element to force sidebar to shrink to fit close icon -->
                        </div>
                    </div>
                </div>

                <!-- Static sidebar for desktop -->
                <div class="hidden md:flex md:flex-shrink-0">
                    <div class="flex flex-col w-64">
                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                            <div class="flex items-center flex-shrink-0 px-4">
                                <a href="/">
                                    <x-jet-application-mark class="block h-8 w-auto" />
                                </a>
                            </div>
                            <div class="mt-5 flex-grow flex flex-col">
                                <nav class="flex-1 px-2 bg-white space-y-1">

                                    @include('genesis::navigation')

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                        <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden" aria-label="Open sidebar">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </button>
                        <div class="flex-1 px-4 flex justify-between">
                            <div class="flex-1 flex">
                                <form class="w-full flex md:ml-0" action="#" method="GET">
                                    <label for="search_field" class="sr-only">Search</label>
                                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input id="search_field" class="block w-full h-full pl-8 pr-3 py-2 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 sm:text-sm" placeholder="Search" type="search">
                                    </div>
                                </form>
                            </div>
                            <div class="ml-4 flex items-center md:ml-6">
                                <button class="p-1 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:shadow-outline focus:text-gray-500" aria-label="Notifications">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </button>

                                <!-- Settings Dropdown -->
                                <div class="sm:flex sm:items-center sm:ml-6">
                                    @if(auth()->check())
                                    <x-jet-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-jet-dropdown-link href="/user/profile">
                                                {{ __('Profile') }}
                                            </x-jet-dropdown-link>

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Management -->
                                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-jet-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                                {{ __('Team Settings') }}
                                            </x-jet-dropdown-link>

                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-jet-dropdown-link href="/teams/create">
                                                {{ __('Create New Team') }}
                                            </x-jet-dropdown-link>
                                            @endcan

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                            <x-jet-switchable-team :team="$team" />
                                            @endforeach

                                            <div class="border-t border-gray-100"></div>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Logout') }}
                                                </x-jet-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-jet-dropdown>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>

                    <main class="flex-1 relative overflow-y-auto focus:outline-none" tabindex="0" x-data="" x-init="$el.focus()">
                        <div class="pt-2 pb-6 md:py-6">
                            <div class="max-w-7xl mx-auto px-4 sm:px-2">
                                {{ $header }}
                            </div>
                            <div class="max-w-7xl mx-auto px-4 sm:px-2">
                                {{ $slot }}
                            </div>
                        </div>
                    </main>
                </div>
            </div>

        </div>
    </div>
    <div style="clear: both; display: block; height: 0px;"></div>

    @stack('modals')

    @livewireScripts
    @genesisScripts
</body>

</html>
