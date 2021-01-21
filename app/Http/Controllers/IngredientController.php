<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{

    private $status_code    =        200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredient = Ingredient::all();
        //dd($recipe);
        //dd($allRecips);
        if(!is_null($ingredient)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Ingredient was fatched successfully", "data" => $ingredient]);
        }

    else {
        return response()->json(["status" => "failed", "success" => false, "message" => "failed to fatch the Ingredient"]);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validator              =        Validator::make($request->all(), [
        //     "name"                     =>          "required",
        //     "file"                     =>          "required|mimes:jpeg,jpg,png|",
        // ]);

        // if($validator->fails()) {
        //     return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        // }

        $name                   =       $request->name;
     
        

        if($request->get('file'))
       {
          $image = $request->get('file');
          $image = $request->get('file');
          $filename = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('images/').$filename);
        }

        $ingredientDataArray          =       array(
            "name"              =>          $name,
            "img"              =>           $filename
       
        );

        $ingredient                   =           Ingredient::create($ingredientDataArray);

       

        if(!is_null($ingredient)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Ingredient was created successfully", "data" => $ingredient]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to add the Ingredient"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        if(!is_null($ingredient)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Ingredient was deleted successfully", "data" => $ingredient]);
        }

    else {
        return response()->json(["status" => "failed", "success" => false, "message" => "failed to delet the Ingredient"]);
    }

    }
}
