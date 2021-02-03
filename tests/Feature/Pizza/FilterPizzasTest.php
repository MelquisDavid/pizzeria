<?php

namespace Tests\Feature\Pizza;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterPizzasTest extends TestCase
{

    use RefreshDatabase;

    /**  @test  */
    public function can_filter_pizza_by_name()
    {
        $this->withoutExceptionHandling();
        Pizza::factory()->create([
            'name' => '4 Quesos'
        ]);
        Pizza::factory()->create([
            'name' => 'Boscaiola'
        ]);

            $url = route('api:v1:pizzas.index',['filter[name]' => 'Quesos']);

            // $this->getJson($url)
            //     ->assertJsonCount(1,'data')
            //     ->assertSee('4 Quesos')
            //     ->assertDontSee('Boscaiola')
            //     ;

               // dd($url);
                $this->jsonApi()->get($url)->dump()
                    ->assertJsonCount(1,'data')
                    ->assertSee('4 Quesos')
                    ->assertDontSee('Boscaiola')
                    ;




    }
}
