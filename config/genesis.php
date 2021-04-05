<?php

return [
    'resources_folder' => 'Http/Livewire/Genesis',
    /**
     * Path of the main dashboard.
     */
    'path' => '/admin',

    /**
     * Load script and styles to be included in @genesisStyles and @genesisScripts
     * You can turn some script off in case of conflicts.
     */
    'load_momentjs' => true,
    'load_pikaday' => true,
    'load_trix' => true,

    /**
     * Define dates format.
     */
    'javascript_date_format' => 'DD MMM YYYY',
    'php_date_format' => 'm-d-Y',

    /**
     * Customize logo, styles and colors.
     */
    'branding' => [
        'button_primary' => 'text-white text-bold bg-orange-400 hover:bg-orange-500 active:bg-orange-600 border-orange-400',
        'button_secondary' => '"border-gray-300 text-gray-700 active:bg-gray-50 active:text-gray-800 hover:text-gray-500',
    ],
];
