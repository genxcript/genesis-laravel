<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Genesis') }}</title>
    <link rel="icon" href="/favicon.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    @livewireStyles

    @genesisStyles


</head>

<body class="antialiased font-sans bg-gray-200">
    <div class="" style="">
        <div style="min-height: 640px;" class="bg-gray-100">

            <div x-data="{ open: false }" @keydown.window.escape="open = false"
                class="h-screen flex overflow-hidden bg-gray-100">

                <div x-show="open" class="fixed inset-0 flex z-40 md:hidden"
                    x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
                    aria-modal="true" style="display: none;">

                    <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                        class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false" aria-hidden="true"
                        style="display: none;"></div>


                    <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in-out duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                        class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white" style="display: none;">

                        <div x-show="open" x-transition:enter="ease-in-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            x-description="Close button, show/hide based on off-canvas menu state."
                            class="absolute top-0 right-0 -mr-12 pt-2" style="display: none;">
                            <button
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                @click="open = false">
                                <span class="sr-only">Close sidebar</span>
                                <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/x"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex-shrink-0 flex items-center px-4">
                            @include('genesis::partials.logo')
                        </div>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <nav class="px-2 space-y-1">
                                @include('genesis::partials.navigation')
                            </nav>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-14" aria-hidden="true">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>


                <!-- Static sidebar for desktop -->
                <div class="hidden md:flex md:flex-shrink-0">
                    <div class="flex flex-col w-64">
                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div
                            class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                            <div class="flex items-center flex-shrink-0 px-4">
                                @include('genesis::partials.logo')
                            </div>
                            <div class="mt-5 flex-grow flex flex-col">
                                <nav class="flex-1 px-2 bg-white space-y-1">

                                    @include('genesis::partials.navigation')

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-0 flex-1 overflow-hidden">
                    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                        <button
                            class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
                            @click="open = true">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-6 w-6" x-description="Heroicon name: outline/menu-alt-2"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </button>
                        <div class="flex-1 px-4 flex justify-between">
                            <div class="flex-1 flex">
                                <form class="w-full flex md:ml-0" action="#" method="GET">
                                    <label for="search_field" class="sr-only">Search</label>
                                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5" x-description="Heroicon name: solid/search"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input id="search_field"
                                            class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                            placeholder="Search" type="search" name="search">
                                    </div>
                                </form>
                            </div>
                            <div class="ml-4 flex items-center md:ml-6">
                                <button
                                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" x-description="Heroicon name: outline/bell"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </button>

                                <!-- Profile dropdown -->
                                <div x-data="Components.menu({ open: false })" x-init="init()"
                                    @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)"
                                    class="ml-3 relative">
                                    <div>
                                        <button type="button"
                                            class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            id="user-menu-button" x-ref="button" @click="onButtonClick()"
                                            @keyup.space.prevent="onButtonEnter()"
                                            @keydown.enter.prevent="onButtonEnter()" aria-expanded="false"
                                            aria-haspopup="true" x-bind:aria-expanded="open.toString()"
                                            @keydown.arrow-up.prevent="onArrowUp()"
                                            @keydown.arrow-down.prevent="onArrowDown()">
                                            <span class="sr-only">Open user menu</span>
                                            <img class="h-8 w-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixqx=sG8b2h2SZS&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                alt="">
                                        </button>
                                    </div>

                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state."
                                        x-bind:aria-activedescendant="activeDescendant" role="menu"
                                        aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                        @keydown.arrow-up.prevent="onArrowUp()"
                                        @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false"
                                        @keydown.enter.prevent="open = false; focusButton()"
                                        @keyup.space.prevent="open = false; focusButton()" style="display: none;">

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" x-state:on="Active"
                                            x-state:off="Not Active" :class="{ 'bg-gray-100': activeIndex === 0 }"
                                            role="menuitem" tabindex="-1" id="user-menu-item-0"
                                            @mouseenter="activeIndex = 0" @mouseleave="activeIndex = -1"
                                            @click="open = false; focusButton()">Your Profile</a>

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                            :class="{ 'bg-gray-100': activeIndex === 1 }" role="menuitem" tabindex="-1"
                                            id="user-menu-item-1" @mouseenter="activeIndex = 1"
                                            @mouseleave="activeIndex = -1"
                                            @click="open = false; focusButton()">Settings</a>

                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                            :class="{ 'bg-gray-100': activeIndex === 2 }" role="menuitem" tabindex="-1"
                                            id="user-menu-item-2" @mouseenter="activeIndex = 2"
                                            @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Sign
                                            out</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <main class="flex-1 relative overflow-y-auto focus:outline-none">
                        <div class="py-6">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                {{ $header }}
                            </div>
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                {{ $slot }}
                            </div>
                        </div>
                    </main>
                </div>
            </div>

        </div>
    </div>

    @stack('modals')

    @livewireScripts
    @genesisScripts

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
