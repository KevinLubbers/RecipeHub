<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Recipe;
use Session;
use Illuminate\Support\Facades\Validator;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        
        return view('ingredients.create')->with('sentID', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'ingredient_name' => ['required', 'string', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 


        $ingredient = new Ingredient;
        $ingredient->recipe_id = $request->input('recipe_id');
        $ingredient->ingredient_name = $request->input('ingredient_name');
        $ingredient->quantity = (($request->input('quantityFractions')) + 
            ($request->input('quantityHundreds')) + ($request->input('quantityTens')) +
            ($request->input('quantityOnes')));
        $ingredient->quantityType = $request->input('measurement');
        $ingredient->save();

        Session::flash('success', 'Added Ingredient -' . $ingredient->ingredient_name .'-');

        return redirect()->route('recipes.edit', $ingredient->recipe_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Ingredient::find($id);
        $parent = Recipe::find($record->recipe_id);
        if ($parent->user_id != auth()->user()->id){
            abort(403);
        } 
        
        return view('ingredients.edit')->withRecord($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validator = Validator::make($request->all(), [
            'ingredient_name' => ['required', 'string', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 

        $ingredient = Ingredient::find($id);
        $ingredient->ingredient_name = $request->input('ingredient_name');
        $ingredient->quantity = (($request->input('quantityFractions')) + 
            ($request->input('quantityHundreds')) + ($request->input('quantityTens')) +
            ($request->input('quantityOnes')));
        $ingredient->quantityType = $request->input('measurement');
        $ingredient->save();

        Session::flash('info', 'Renamed Ingredient -' . $ingredient->ingredient_name .'-');

        return redirect()->route('recipes.edit', $ingredient->recipe_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);

        if($ingredient){
            $ingredient->delete();
        }

        Session::flash('error', 'Removed Ingredient -' . $ingredient->ingredient_name .'-');

        return redirect()->route('recipes.edit', $ingredient->recipe_id);
    }
}
