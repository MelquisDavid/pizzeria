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



        $response = $this->getJson(route('pizza.show',$pizza));


        $response->assertSee($pizza->name);
    }

    /**  @test  */

    public function cant_fetch_all_pizza()
    {

        $this->withoutExceptionHandling();

        $pizza =Pizza::factory()->count(5)->create();

        //dd($pizza);

        $response = $this->getJson(route('pizza.index'));

       // dd($response);
       foreach ($pizza as $value) {
           $response->assertSee($value->name);
       }
    }

        /**  @test  */

     public function cant_create_pizza()
        {

            $this->withoutExceptionHandling();

            $pizza =Pizza::factory()->raw();
            //dd($pizza);

            $response = $this->postJson(route('pizza.store'),$pizza);

            $response
            ->assertStatus(201);
        }

                /**  @test  */

     public function cannot_create_pizza()
     {

         $this->withoutExceptionHandling();

         $response = $this->postJson(route('pizza.store'),['names' => 'Sally']);

         $response
         ->assertStatus(400);
     }


}
