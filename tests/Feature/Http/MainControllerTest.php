<?php

namespace LaravelGenesis\Genesis\Tests\Feature\Http;

use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Tests\TestCase;

class MainControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        // This loads the rout needed in the navigation blade file
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');
    }

    /** @test */
    public function it_loads_main_dashboard()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(config('genesis.path'));

        $response->assertOk();

        $response->assertSee('genesis-test="dashboard"', false);
    }
}
