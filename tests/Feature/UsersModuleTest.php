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
     * muestra un error 404 si el usuario no es encontrado
     *
     * @test
     */
    function it_displays_a_404_errors_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
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
            ->assertSee('Crear usuario');
    }

    /**
     * crea un nuevo usuario
     *
     * @test
     */
    function it_creates_a_new_user()
    {
        $this->post('/usuarios/', [
                'name' => 'GabrielAttila',
                'email' => 'gabrieljmorenot@gmail.com',
                'password' => bcrypt('123')
            ])
            ->assertRedirect(route('users.index'));

        $this->assertEquals(1, User::count());
    }

    /**
     * El nombre es requerido
     * @test
     */
    function the_name_is_required()
    {
        // el metodo validate redirecciona hacia la pagina anterior para ello usamos
        // el metodo from() para indicarla en las pruebas
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'gabrieljmorenot@gmail.com',
                'password' => bcrypt('123')
            ])->assertRedirect(route('users.create'))
            // afirmamos que la sesion tiene errores
            ->assertSessionHasErrors(['name'], 'El campo name es obligatorio');

        $this->assertEquals(0, User::count());
    }

    /**
     * El email es requerido
     * @test
     */
    function the_email_is_required()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Gabriel',
                'email' => '',
                'password' => bcrypt('123')
            ])->assertRedirect(route('users.create'))
            // afirmamos que la sesion tiene errores
            ->assertSessionHasErrors(['email'], 'El campo email es obligatorio');

        $this->assertEquals(0, User::count());
    }

    /**
     * el correo debe ser valido
     * @test
     */
    function the_email_must_be_valid()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Gabriel',
                'email' => 'correo-no-valido',
                'password' => bcrypt('123')
            ])->assertRedirect(route('users.create'))
            // afirmamos que la sesion tiene errores
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /**
     * el correo debe ser unico
     * @test
     */
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'gabrieljmorenot@gmail.com'
        ]);

        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Gabriel',
                'email' => 'gabrieljmorenot@gmail.com',
                'password' => bcrypt('123')
            ])->assertRedirect(route('users.create'))
            // afirmamos que la sesion tiene errores
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /**
     * El password es requerido
     * @test
     */
    function the_password_is_required()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Gabriel',
                'email' => 'gabrieljmorenot@gmail.com',
                'password' => ''
            ])->assertRedirect(route('users.create'))
            // afirmamos que la sesion tiene errores
            ->assertSessionHasErrors(['password'], 'El campo password es obligatorio');

        $this->assertEquals(0, User::count());
    }

    /**
     * carga la pagina para editar usuario
     *
     * @test
     */
    function it_loads_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertSee('Editar usuario')
            // comprobamos que la vista tiene una variable
            // comparamos el usuario de la vista con el usuario de la prueba ya que da el error
            // wasRecentlyCreated en donde en la prueba creamos el usuario recientemente
            // pero en la vista no, por ello el error
            ->assertViewHas('user', function ($viewUser) use ($user){
                // comparamos el usuario de la vista con el de la prueba
                return $viewUser->id === $user->id;
            });
    }

    /**
     * actualiza un usuario
     *
     * @test
     */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();
        $this->withoutExceptionHandling();
        $this->put("/usuarios/{$user->id}", [
            'name' => 'GabrielAttila',
            'email' => 'gabrieljmorenot@gmail.com',
            'password' => '123456'
        ])
            ->assertRedirect(route('users.show', compact('user')));

        $this->assertCredentials([
            'name' => 'GabrielAttila',
            'email' => 'gabrieljmorenot@gmail.com',
            'password' => '123456'
        ]);
    }
}
