<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    // Con este trait todas las consultas sql de las pruebas se van a ejecutar dentro de uns transaccion de la bd
    // De este modo las pruebas no van a hacer cambios en la bd.
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {

        $user = factory(\App\User::class)->create([
         'name' => 'R0bertinski',
         'email' => 'robbyschuh@gmail.com'
        ]

        );

        $this->actingAs($user, 'api')->visit('api/user')
             ->see('R0bertinski')
             ->see('robbyschuh@gmail.com');
    }
}
