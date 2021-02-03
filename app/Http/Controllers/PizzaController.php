<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $query = Pizza::query();

        foreach (request('filter',[]) as $filter => $value) {

           if(!$query->hasNamedScope($filter)){
            return response()->json([
                'Message' => "El Filtro '{$filter}' no es permitido"], 400);
            }

            $query->{$filter}($value);
        }


        return response()->json($query->with('ingredients')->simplePaginate(), 200);
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
            ]);
            Pizza::create($request->all());

            return response()->json("Pizza Guardada",201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("Error en Datos",400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        //

        return  $pizza;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        //
        try {
             $pizza->name = $request->name;
             $pizza->save();
            return response()->json("Pizza Actualizada",200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json("Error en los datos",400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        try {
            $pizza->delete();

           return response()->json("Pizza Eliminada",200);

       } catch (\Throwable $th) {
           //throw $th;
           return response()->json("Error en los datos",400);
       }
    }
    public function add_ingredient(Request $request, Pizza $pizza)
    {

        try {

                $pizza->ingredients()->attach($request->idIngredient);
                $pizza->price = $pizza->price();
                $pizza->save();


           return response()->json("Ingrediente Agregado",200);

       } catch (\Throwable $th) {
           //throw $th;

           return response()->json("Error en los datos",400);
       }
    }
    public function del_ingredient(Request $request, Pizza $pizza)
    {
        try {
            $pizza->ingredients()->detach($request->idIngredient);
            $pizza->price = $pizza->price();
            $pizza->save();

           return response()->json("Ingrediente Elminado",200);

       } catch (\Throwable $th) {
           //throw $th;
           return response()->json("Error en los datos",400);
       }
    }

    public function ingredients(Pizza $pizza)
    {
        try {

            return response()->json([
                'data' => $pizza->ingredients()->get()],200);

       } catch (\Throwable $th) {
           //throw $th;
           return response()->json($th->getmessage() ,400);
       }
    }


}
