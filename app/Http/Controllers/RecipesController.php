<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Recipe;
use Session;

use Illuminate\Support\Facades\Auth;


class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::with('ingredients')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('recipes.index')->with('recipes' ,$recipes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recipe_title' => 'required|max:255',

        ]);

        $recipe = new Recipe;
        $recipe->user_id = Auth::id();
        $recipe->title = $request->input('recipe_title');
        $recipe->public = true;
        $recipe->save();

        Session::flash('success', 'New Recipe -' . $recipe->title . '- has been added | Use Edit to Add Ingredients');

        return redirect()->route('recipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recipe = Recipe::find($id);

        if ($recipe->user_id != auth()->user()->id){
            abort(403);
        } 

        return view('recipes.show')->with('show', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Recipe::find($id);
        if ($record->user_id != auth()->user()->id){
            abort(403);
        } 
        
        return view('recipes.edit')->withRecord($record);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'recipe_title' => 'required|max:255'
        ]);

        $recipe = Recipe::find($id);

        $recipe->title = $request->input('recipe_title');
        $recipe->save();

        Session::flash('info', 'Renamed Recipe -' . $recipe->title .'-');

        return redirect()->route('recipes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::find($id);

        if($recipe){
            $recipe->delete();
        }

        Session::flash('error', 'Removed Recipe -' . $recipe->title .'-');
        return redirect()->route('recipes.index');
    }
    public function copyFlashAuth(){
        Session::flash('success', 'Recipe has been Copied to Clipboard - Ctrl + V to Paste');

        return redirect()->back();
    }
   
}
