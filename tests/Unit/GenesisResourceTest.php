<?php

namespace LaravelGenesis\Genesis\Tests\Unit;

use Illuminate\Support\Facades\Route;
use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Tests\TestCase;
use LaravelGenesis\Genesis\Tests\Fixtures\UserResource;

class GenesisResourceTest extends TestCase
{
    /** @test */
    public function it_generates_resourse_routs_from_generated_uri_key()
    {
        GenesisFacade::registerResourceRoute('LaravelGenesis\Genesis\Tests\Fixtures\UserResource');

        // Base on name of resource class, we get plural version
        $this->assertEquals(
            'users',
            UserResource::uriKey()
        );

        // And a valid rout is declared
        $this->assertEquals(
            url('users'),
            route('genesis::users.index')
        );
    }
}
