<?php

namespace LaravelGenesis\Genesis\Tests\Feature\Http;

use LaravelGenesis\Genesis\Tests\TestCase;

class MainControllerTest extends TestCase
{
    /** @test */
    public function it_loads_main_dashboard()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/admin');

        $response->assertOk();

        $response->assertSee('Holis');
    }
}
