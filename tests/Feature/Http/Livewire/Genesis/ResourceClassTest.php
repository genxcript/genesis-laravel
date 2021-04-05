<?php

namespace LaravelGenesis\Genesis\Tests\Feature\Http\Livewire\Genesis;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Tests\Fixtures\User;
use LaravelGenesis\Genesis\Tests\TestCase;

class ResourceClassTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        // This loads the route needed in the navigation blade file
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');
    }

    /** @test */
    public function it_renders_the_resource_columns_from_array_of_string_names()
    {
        User::factory([
                'name' => 'Emiliano',
                'email' => 'emilianotisato@gmail.com',
            ])->create();

        $response = $this->get(route('genesis::users.index'));

        $response->assertSee('Emiliano');
        $response->assertSee('emilianotisato@gmail.com');
    }
}
