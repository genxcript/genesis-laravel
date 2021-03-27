<?php

namespace LaravelGenesis\Genesis\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Laravel\Jetstream\JetstreamServiceProvider;
use LaravelGenesis\Genesis\GenesisServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends Orchestra
{
    public function setUp() : void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'LaravelGenesis\\Genesis\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        // $this->artisan('jetstream:install livewire');
    }

    protected function getPackageProviders($app)
    {
        return [
            GenesisServiceProvider::class,
            JetstreamServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_genesis_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
