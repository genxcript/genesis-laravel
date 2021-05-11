<?php

namespace LaravelGenesis\Genesis;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use LaravelGenesis\Genesis\Http\Controllers\MainController;
use LaravelGenesis\Genesis\Livewire\Form;
use LaravelGenesis\Genesis\Livewire\GenesisResource;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class Genesis
{
    public function mountForm(string $component, $params = [])
    {
        if (! new $component instanceof Form) {
            throw new \Exception('You need to pass an instance of LaravelGenesis\Genesis\Livewire\Form');
        }

        return  Livewire::mount($component, $params)->effects['html'];
    }

    public function styles($options = [])
    {
        $debug = config('app.debug');

        $styles = $this->cssAssets();

        // HTML Label.
        $html = $debug ? ['<!-- Genesis Styles -->'] : [];

        // CSS assets.
        $html[] = $debug ? $styles : $this->minify($styles);

        return implode("\n", $html);
    }

    public function scripts($options = [])
    {
        $debug = config('app.debug');

        $scripts = $this->javaScriptAssets($options);

        // HTML Label.
        $html = $debug ? ['<!-- Genesis Scripts -->'] : [];

        // JavaScript assets.
        $html[] = $debug ? $scripts : $this->minify($scripts);

        return implode("\n", $html);
    }

    protected function cssAssets()
    {
        $pikaday = config('genesis.load_pikaday') ? '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">' : '';
        $trix = config('genesis.load_trix') ? '<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">' : '';

        return <<<HTML
                $pikaday
                $trix
                <style>
                    /** Genesis custom style */
                </style>
            HTML;
    }

    protected function javaScriptAssets($options)
    {
        $moment = config('genesis.load_momentjs') ? '<script src="https://unpkg.com/moment"></script>' : '';
        $pikaday = config('genesis.load_pikaday') ? '<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>' : '';
        $trix = config('genesis.load_trix') ? '<script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>' : '';

        $notifications = file_get_contents(__DIR__ . '/../resources/views/components/notification.blade.php');

        return <<<HTML
                $notifications
                $moment
                $pikaday
                $trix
                <!-- <script data-turbolinks-eval="false">
                    document.addEventListener("DOMContentLoaded", function () {

                    });
                </script> -->
            HTML;
    }

    protected function minify($subject)
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }

    public function registerResourcesRoutes(string $directory)
    {
        if (! is_dir($directory)) {
            return;
        }

        $namespace = app()->getNamespace();

        foreach ((new Finder)->in($directory)->files() as $resource) {
            $resource = $namespace . str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
            );

            if (new $resource instanceof GenesisResource) {
                $this->registerResourceRoute($resource);
            }
        }
    }

    public function registerResourceRoute($resource)
    {
        $resourceClass = get_class(new $resource);

        Route::get($resource::uriKey(), $resourceClass)->name('genesis::' . $resource::uriKey() . '.index');
        // Route::get($resource::uriKey(), [MainController::class, 'resourceIndex'])->name('genesis::' . $resource::uriKey() . '.index');
        Route::get($resource::uriKey() . '/{resourceId}', [MainController::class, 'resourceView'])->name('genesis::' . $resource::uriKey() . '.view');
        Route::get($resource::uriKey() . '/{resourceId}/edit', [MainController::class, 'resourceEdit'])->name('genesis::' . $resource::uriKey() . '.edit');
    }
}
