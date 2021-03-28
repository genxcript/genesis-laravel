<a href="{{ $href }}"
    class="{{ $active ? 'border-l-4 border-orange-400 bg-gray-100 ' : ''}}group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">

    @if ($icon)
    @svg('zondicon-' . $icon, 'mr-3 h-6 w-6 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition
    ease-in-out duration-150')
    @endif

    {{ $slot }}
</a>
