<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = Ingredient::query();

        foreach (request('filter',[]) as $filter => $value) {

           if(!$query->hasNamedScope($filter)){
            return response()->json([
                'Message' => "El Filtro '{$filter}' no es permitido"], 400);
            }

            $query->{$filter}($value);
        }


        return response()->json($query->simplePaginate(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try {
            $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
            ]);
            Ingredient::create($request->all());

            return response()->json("Ingrediente Guardado",201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("Error en los datos",400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
        return $ingredient;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {

        //
        try {
            $ingredient->name = $request->name;
            $ingredient->price = $request->price;
            $ingredient->save();
            return response()->json("Ingrediente Actualizado",200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("Error en los datos",400);
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        //
        try {
            $pizzas = $ingredient->pizza()->get();
            $ingredient->delete();
            foreach ($pizzas as $value) {
                $value->price = $value->price();
                $value->save();
            }


           return response()->json("Ingrediente Eliminado",200);

       } catch (\Throwable $th) {
           //throw $th;
           return response()->json("Error en los datos",400);
       }
    }
}
