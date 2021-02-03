<?php

namespace Tests\Feature\Pizza;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPizzaTest extends TestCase
{

    use RefreshDatabase;


    /**  @test  */


    public function cant_fetch_single_pizza()
    {

        $this->withoutExceptionHandling();
        $pizza =Pizza::factory()->create();

        $url = route('pizzas.show',$pizza);

        $response =$this->getJson($url);


        $response->assertSee($pizza->name);
    }

    /**  @test  */

    public function cant_fetch_all_pizza()
    {

        $this->withoutExceptionHandling();

        $pizza =Pizza::factory()->count(5)->create();



        $url = route('pizzas.index');

        $response = $this->getJson($url);


       foreach ($pizza as $value) {
           $response->assertSee($value->name);
       }
    }

        /**  @test  */

     public function cant_create_pizza()
        {

            $this->withoutExceptionHandling();

            $pizza =Pizza::factory()->raw();


            $response = $this->postJson(route('pizzas.store'),$pizza);

            $response
            ->assertStatus(201);
        }

                /**  @test  */

     public function cannot_create_pizza()
     {

         $this->withoutExceptionHandling();

         $response = $this->postJson(route('pizzas.store'),['names' => 'Sally']);

         $response
         ->assertStatus(400);
     }

    /**  @test  */

    public function cant_update_pizza()
    {

        $this->withoutExceptionHandling();
        $pizza =Pizza::factory()->create();

        $response = $this->patchJson(route('pizzas.update',$pizza),['name' => 'Sally']);

        $response
        ->assertStatus(200);
    }


}
