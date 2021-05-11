<?php

namespace LaravelGenesis\Genesis\Tests\Feature\Livewire\Genesis;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Tests\Fixtures\User;
use LaravelGenesis\Genesis\Tests\Fixtures\UserResource;
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
    }

    /** @test */
    public function it_renders_the_resource_table_on_route_index()
    {
        $userResource = new UserResource();

        GenesisFacade::registerResourceRoute($userResource);

        User::factory([
                'name' => 'Emiliano',
                'email' => 'emilianotisato@gmail.com',
            ])->create();


        $response = $this->get(route('genesis::users.index'))
        ->assertSeeLivewire('laravel-genesis.genesis.tests.fixtures.user-resource');

        $response->assertSee('Emiliano');
        $response->assertSee('emilianotisato@gmail.com');
    }

    /** @test */
    public function it_renders_column_string_representation_if_found_in_database()
    {
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');

        $userResource = $this->mock(UserResource::class)->makePartial();

        $userResource
        ->shouldReceive('getRowsProperty')
        ->andReturn([
            'Email',
            ]);


        User::factory([
            'email' => 'emilianotisato@gmail.com',
        ])->create();

        $response = $this->get(route('genesis::users.index'));

        $response->assertSee('emilianotisato@gmail.com');
    }

    /** @test */
    public function it_ignores_other_columns_that_arent_in_the_returned_array()
    {
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');

        $userResource = $this->mock(UserResource::class)->makePartial();

        $userResource
            ->shouldReceive('getRowsProperty')
            ->andReturn([
                'Email',
                ]);


        User::factory([
                'name' => 'Emiliano',
                'email' => 'emilianotisato@gmail.com',
            ])->create();

        $response = $this->get(route('genesis::users.index'));

        $response->assertDontSee('Emiliano');
        $response->assertSee('emilianotisato@gmail.com');
    }
}
