<?php

namespace LaravelGenesis\Genesis\Commands;

use Illuminate\Support\Facades\File;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\FileManipulationCommand;

class MakeFormCommand extends FileManipulationCommand
{
    protected $signature = 'genesis:form {name} {--force} {--inline}';

    protected $description = 'Create a new Livewire component';

    public function handle()
    {
        $this->parser = new ComponentParser(
            config('livewire.class_namespace', 'App\\Http\\Livewire'),
            config('livewire.view_path', resource_path('views/livewire')),
            $this->argument('name')
        );

        if ($this->isReservedClassName($name = $this->parser->className())) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");

            return;
        }

        $force = $this->option('force');
        $inline = $this->option('inline');

        $class = $this->createClass($force, $inline);
        $view = $this->createView($force, $inline);

        $this->refreshComponentAutodiscovery();

        if ($class || $view) {
            $this->line("<options=bold,reverse;fg=green> COMPONENT CREATED </> 🤙\n");
            $class && $this->line("<options=bold;fg=green>CLASS:</> {$this->parser->relativeClassPath()}");

            if (! $inline) {
                $view && $this->line("<options=bold;fg=green>VIEW:</>  {$this->parser->relativeViewPath()}");
            }
        }
    }

    protected function createClass($force = false, $inline = false)
    {
        $classPath = $this->parser->classPath();

        if (File::exists($classPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->classContents($inline));

        return $classPath;
    }

    public function classContents($inline = false)
    {
        $stubName = 'form.stub';

        $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$stubName);

        return preg_replace_array(
            ['/\[namespace\]/', '/\[class\]/', '/\[view\]/'],
            [$this->parser->classNamespace(), $this->parser->className(), $this->parser->viewName()],
            $template
        );
    }

    protected function createView($force = false, $inline = false)
    {
        if ($inline) {
            return false;
        }
        $viewPath = $this->parser->viewPath();

        if (File::exists($viewPath) && ! $force) {
            $this->line("<fg=red;options=bold>View already exists:</> {$this->parser->relativeViewPath()}");

            return false;
        }

        $this->ensureDirectoryExists($viewPath);

        File::put($viewPath, $this->viewContents());

        return $viewPath;
    }

    public function viewContents()
    {
        if (! File::exists($stubPath = base_path('stubs/livewire.view.stub'))) {
            $stubPath = __DIR__.DIRECTORY_SEPARATOR.'livewire.view.stub';
        }

        return preg_replace(
            '/\[quote\]/',
            '',
            file_get_contents($stubPath)
        );
    }

    public function isReservedClassName($name)
    {
        return array_search($name, ['Parent', 'Component', 'Interface']) !== false;
    }
}
