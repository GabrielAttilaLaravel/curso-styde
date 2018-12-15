<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersModuleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    // muestra la lista de usuarios
    function it_shows_the_users_list()
    {
        factory(User::class)->create(['name' => 'Alexander']);
        factory(User::class)->create(['name' => 'Milagros']);


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
        $this->get('usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /**
     * carga la página de detalles de usuarios
     *
     * @test
     */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create(['name' => 'Gabriel Moreno']);

        $this->get('usuarios/'. $user->id)
            ->assertStatus(200)
            ->assertSee('Nombre del usuario: '. $user->name)
            ->assertSee('Correo electrónico: '. $user->email);
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
