<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use Session;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function guestSearch(Request $request){
       $validator = Validator::make($request->all(), [
            'navSearch' => ['required', 'string', 'max:255'],
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } 
        $search = $request->input('navSearch');
		$search = explode(" ", $search);
		$data = $this->generateOrder($search);
		$order = $data['order'];

		$recipe = Recipe::with('ingredients')
		->join('users', 'recipes.user_id', '=', 'users.id')
		->select('recipes.*', 'users.name as username')
		->where(function ($query) use ($search) {
			foreach ($search as $term) {

                
				$query->orWhere('recipes.title', 'like', "%$term%");
			}
		})
		->orderByRaw($order)
		->paginate(10);

	return view('pages.home')->withRecipes($recipe);
    }
     private function generateOrder($search) {
		$orderCombined = 'CASE ';
        $order = '';
		$count = count($search);
		$combinedCheck = "";
			
			for ($n = 0; $n < $count; $n++){
				$condition = "%$search[$n]%";
				$order .= "WHEN `recipes`.`title` LIKE '$condition'  THEN 10 ";
                $order .= "WHEN `recipes`.`title` NOT LIKE '$condition'  THEN 5 ";

                if ($n == $count - 1){
                    $combinedCheck .= "AND `recipes`.`title` LIKE '$condition' THEN 20 ";
                }
                else if($n == 0){
                    $combinedCheck .= "WHEN `recipes`.`title` LIKE '$condition' ";
                }
                else{
                    $combinedCheck .= "AND `recipes`.`title` LIKE '$condition' ";
                }
                 
                $bindings[] = $condition;
                $combinedBindings[] = $condition;
			}
           
            if ($count >= 2){
                $orderCombined .= $combinedCheck;
                
                array_push($bindings, $combinedBindings);
            }
            
		$order .= 'ELSE 0 END DESC';
        $orderCombined .= $order;

		return [
            'order' => $orderCombined,
            'bindings' => $bindings,
        ];
	}
    
    public function userSearch(){

        
    }
    public function fuzzySearchOnKeyPress(){


	}


}


