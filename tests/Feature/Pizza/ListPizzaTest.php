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

        $url = route('api:v1:pizzas.read',$pizza);

        $response = $this->jsonApi()->get($url);


        $response->assertSee($pizza->name);
    }

    /**  @test  */

    public function cant_fetch_all_pizza()
    {

        $this->withoutExceptionHandling();

        $pizza =Pizza::factory()->count(5)->create();

        //dd($pizza);

        $url = route('api:v1:pizzas.index');

        $response = $this->jsonApi()->get($url);

       // dd($response);
       foreach ($pizza as $value) {
           $response->assertSee($value->name);
       }
    }

        /**  @test  */

    //  public function cant_create_pizza()
    //     {

    //         $this->withoutExceptionHandling();

    //         $pizza =Pizza::factory()->raw();
    //         //dd($pizza);

    //         $response = $this->postJson(route('pizza.store'),$pizza);

    //         $response
    //         ->assertStatus(201);
    //     }

    //             /**  @test  */

    //  public function cannot_create_pizza()
    //  {

    //      $this->withoutExceptionHandling();

    //      $response = $this->postJson(route('pizza.store'),['names' => 'Sally']);

    //      $response
    //      ->assertStatus(400);
    //  }

    // /**  @test  */

    // public function cant_update_pizza()
    // {

    //     $this->withoutExceptionHandling();
    //     $pizza =Pizza::factory()->create();

    //     $response = $this->patchJson(route('pizza.update',$pizza),['name' => 'Sally']);

    //     $response
    //     ->assertStatus(200);
    // }


}
