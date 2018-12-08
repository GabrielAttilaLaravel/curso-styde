<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** @test */
    // muestra la lista de usuarios
    function it_shows_the_users_list()
    {
        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('Gabriel')
            ->assertSee('Alexander')
            ->assertSee('Milagros')
            ->assertSee('Listado de Usuarios');
    }

    /** @test */
    // Muestra un mensaje predeterminado si la lista de usuarios está vacía.
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('usuarios?empty')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /**
     * carga la página de detalles de usuarios
     *
     * @test
     */
    function it_loads_the_users_details_page()
    {
        $this->get('usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario: 5');
    }

    /**
     * carga la nueva página de usuarios
     *
     * @test
     */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }
}
