<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RecipeController extends Controller
{
    private $status_code    =        200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipe = Recipe::all();
        //dd($recipe);
        $allRecips=[];
        foreach($recipe as $recip)
        foreach ($recip->ingredients as $r) {
            $recip->toArray();
            $allRecips->pluck($recip);
            
        }
        dd($allRecips);
        if(!is_null($allRecips)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Recipes was fatched successfully", "data" => $allRecips]);
        }

    else {
        return response()->json(["status" => "failed", "success" => false, "message" => "failed to fatch the recipes"]);
    }
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator              =        Validator::make($request->all(), [
            "name"                     =>          "required",
            "instractions"             =>          "required",
            "category"                 =>          "required",
            "image"                    =>          "required",
            "cookTime"                 =>          "required",
            "servings"                 =>          "required",
            "rate"                     =>          "required",
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        $name                   =       $request->name;
        $instractions           =       $request->instractions;
        $category               =       $request->category;
        $image                  =       $request->image;
        $cookTime               =       $request->cookTime;
        $servings               =       $request->servings;
        $rate                   =       $request->rate;

        $recipeDataArray          =       array(
            "name"              =>          $name,
            "instractions"      =>          $instractions,
            "category"          =>          $category,
            "image"             =>          $image ,
            "cookTime"          =>          $cookTime,
            "servings"          =>          $servings,
            "rate"              =>          $rate
        );
        $ingredientsArray          =       array(
            "name"              =>          $name,
            "instractions"      =>          $instractions,
            "category"          =>          $category,
            "image"             =>          $image ,
            "cookTime"          =>          $cookTime,
            "servings"          =>          $servings,
            "rate"              =>          $rate
        );

        $recipe                   =           Recipe::create($recipeDataArray);

        $recipe->ingredients()->sync([1=>['amont'=>2,'unit'=>'grm']]);
        //or us =>>
        // $user->roles()->attach([
        //     1 => ['expires' => $expires],
        //     2 => ['expires' => $expires],
        // ]);

        //should see this when adding the react viewe {https://www.youtube.com/watch?v=v6kX9U5xxqQ}

        if(!is_null($recipe)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Recipe was add successfully", "data" => $recipe]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to add the recipe"]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
