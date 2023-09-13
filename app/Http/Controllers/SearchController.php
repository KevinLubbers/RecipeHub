<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use Session;

class SearchController extends Controller
{
    public function guestSearch(Request $request){
        $search = $request->input('navSearch');

        $recipe = Recipe::where('title', 'like', "%$search%")->get();
    }

    public function userSearch(){
        
    }
}
