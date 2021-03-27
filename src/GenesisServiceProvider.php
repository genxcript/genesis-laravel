<?php

namespace LaravelGenesis\Genesis;

use ReflectionClass;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use LaravelGenesis\Genesis\Components\AppLayout;
use LaravelGenesis\Genesis\Commands\GenesisCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GenesisServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package) : void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('genesis')
            ->hasConfigFile()
            ->hasRoute('web')
            ->hasViews()

            ->hasMigration('create_genesis_table')
            // ->hasCommand(GenesisCommand::class)
;
    }

    public function packageBooted()
    {
        $this->loadViewComponentsAs('genesis', [AppLayout::class]);
        Blade::directive('genesisStyles', [GenesisBladeDirectives::class, 'genesisStyles']);
        Blade::directive('genesisScripts', [GenesisBladeDirectives::class, 'genesisScripts']);

        // $this->registerResources();
        $this->configureComponents();
        if (class_exists(Livewire::class)) {
            \Livewire\Component::macro('notify', function ($message) {
                $this->dispatchBrowserEvent('notify', $message);
            });
        }
    }

    public function packageRegistered()
    {
        $this->app->singleton('genesis', Genesis::class);
    }

    public function registerResources()
    {
        $directory = app_path('Http/Livewire/Genesis');
        $namespace = app()->getNamespace();

        // $resources = [];

        foreach ((new Finder)->in($directory)->files() as $resource) {
            $resource = $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($resource->getPathname(), app_path().DIRECTORY_SEPARATOR)
            );

            if (is_subclass_of($resource, ResourceTable::class) &&
                ! (new ReflectionClass($resource))->isAbstract()) {
                // $resources[] = $resource;
                $this->registerResourceRoute($resource);
            }
        }
    }

    public function registerResourceRoute($resource)
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware([])->get($resource::$config['viewAll'], $resource);
    }

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('notification');
            $this->registerComponent('card');
            $this->registerComponent('columns');
            $this->registerComponent('column');
            $this->registerComponent('button');
            $this->registerComponent('button.link');
            $this->registerComponent('button.primary');
            $this->registerComponent('button.secondary');
            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown.item');
            $this->registerComponent('modal');
            $this->registerComponent('modal.dialog');
            $this->registerComponent('modal.confirmation');
            $this->registerComponent('notification');
            $this->registerComponent('table');
            $this->registerComponent('table.heading');
            $this->registerComponent('table.row');
            $this->registerComponent('table.cell');
            $this->registerComponent('input.group');
            $this->registerComponent('input.textarea');
            $this->registerComponent('input.text');
            $this->registerComponent('input.select');
            $this->registerComponent('input.date');
            $this->registerComponent('input.trix');
            $this->registerComponent('input.checkbox');
            $this->registerComponent('input.money');
            $this->registerComponent('icon.download');
            $this->registerComponent('icon.trash');
            $this->registerComponent('icon.plus');
            $this->registerComponent('icon.cash');
            $this->registerComponent('icon.inbox');
            $this->registerComponent('icon.filter');
            $this->registerComponent('icon.close');
            $this->registerComponent('icon.email');
            $this->registerComponent('icon.phone');
            $this->registerComponent('icon.edit');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('genesis::components.'.$component, 'gen-'.$component);
    }
}
