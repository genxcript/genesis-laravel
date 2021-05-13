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
];
