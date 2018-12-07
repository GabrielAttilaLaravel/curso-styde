<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /**
     * da la bienvenida a los usuarios con apodo
     *
     * @test
     */
    public function it_welcomes_users_with_nickname()
    {
        $this->get('saludo/Gabriel/Attila')
            ->assertStatus(200)
            ->assertSee('Bienvenido: Gabriel, tu apodo es Attila');
    }

    /**
     * da la bienvenida a los usuarios sin apodo
     *
     * @test
     */
    public function it_welcomes_users_without_nickname()
    {
        $this->get('saludo/Gabriel')
            ->assertStatus(200)
            ->assertSee('Bienvenido: Gabriel');
    }
}
