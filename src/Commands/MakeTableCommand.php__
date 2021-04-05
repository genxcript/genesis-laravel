<?php

namespace LaravelGenesis\Genesis\Commands;

use Illuminate\Support\Facades\File;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\FileManipulationCommand;

class MakeTableCommand extends FileManipulationCommand
{
    protected $signature = 'genesis:table {name} {--force} {--inline}';

    protected $description = 'Create a new Livewire component as a Genesis resource table';

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

        $this->refreshComponentAutodiscovery();

        if ($class) {
            $this->line("<options=bold,reverse;fg=green> COMPONENT CREATED </> 🤙\n");
            $class && $this->line("<options=bold;fg=green>CLASS:</> {$this->parser->relativeClassPath()}");
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
        $stubName = 'table.stub';

        $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$stubName);

        return preg_replace_array(
            ['/\[namespace\]/', '/\[class\]/', '/\[view\]/'],
            [$this->parser->classNamespace(), $this->parser->className(), $this->parser->viewName()],
            $template
        );
    }

    public function isReservedClassName($name)
    {
        return array_search($name, ['Parent', 'Component', 'Interface']) !== false;
    }
}
