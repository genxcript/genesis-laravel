<?php

namespace LaravelGenesis\Genesis\Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Tests\Fixtures\User;
use LaravelGenesis\Genesis\Tests\TestCase;

class MainControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        // This loads the route needed in the navigation blade file
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');
    }

    /** @test */
    public function it_loads_main_dashboard()
    {
        $response = $this->actingAs(User::factory()->create())->get(config('genesis.path'));

        $response->assertOk();

        $response->assertSee('genesis-test="dashboard"', false);
    }

    /** @test */
    public function gust_users_are_redirected_to_login()
    {
        // Need to fake the login for the redirect to find it
        Route::get('login', function () {
        })->name('login');

        $response = $this->get(config('genesis.path'));

        $response->assertStatus(302);
    }
}
