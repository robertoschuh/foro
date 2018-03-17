<?php

class ExampleTest extends FeatureTestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
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
