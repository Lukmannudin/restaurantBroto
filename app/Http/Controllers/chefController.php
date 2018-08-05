<?php

namespace resbroto\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class chefController extends Controller
{
    public function index()
    {
        $ingredients = DB::table('ingredients')->get();
        return view('chef.index',['ingredients'=>$ingredients]);
    }

    public function order()
    {
        // $orders = DB::table('orders')->get();
        

        $orders = DB::table('orders')
            ->join('tables', 'orders.tableid', '=', 'tables.tableid')
            ->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
            ->join('recipes','recipes.recipeid','=','orders_recipes.recipeid')
            // ->where('statusOrder','=','order')
            ->select('*')
            ->get();

        $customers = DB::table('orders')
            ->join('tables', 'orders.tableid', '=', 'tables.tableid')
            // ->where('statusOrder','=','order')
            ->select('*')
            ->get();    

        return view('chef/orders',['orders'=>$orders,'customers'=>$customers]);
    }

    // public function validator()
    // {
    //     $orderid = Input::get('orderId');        


    //     $cooked = DB::table('orders')
    //         ->where('orderid', $orderid)
    //         ->update(['statusOrder' => "cooked"]);

    //             $orders_recipes = DB::table('orders_recipes')
    //             ->where('orderid','=',$orderid)
    //             ->get();
    //             echo "<pre>";
    //             // var_dump($orders_recipes);

    //             for ($i=0; $i < count($orders_recipes); $i++) { 
    //                 $recipes_ingredients = DB::table('recipes_ingredients')
    //                 ->where('recipeid','=',$orders_recipes[$i]->recipeid)
    //                 ->get();
                    
    //                 $qtyOrderItem = $orders_recipes[$i]->qtyOrderItem;
    //                 // echo count($recipes_ingredients);
    //                 var_dump($recipes_ingredients);
    //             }



    //             for ($i=0; $i < count($orders_recipes); $i++) { 
    //                 // $recipes_ingredients = DB::table('recipes_ingredients')
    //                 // ->where('recipeid','=',$orders_recipes[$i]->recipeid)
    //                 // ->get();

    //                 // var_dump($recipes_ingredients);

    //                 // $qtyOrderItem = $orders_recipes[$i]->qtyOrderItem;
    //                 for ($i=0; $i < count($recipes_ingredients) ; $i++) { 
    //                     // $ingredients = DB::table('ingredients')
    //                     // ->where('ingredientid','=',$recipes_ingredients[$i]->ingredientid)
    //                     // ->get();
                    
    //                 // $qtyAllIngredients = $ingredients[0]->stock;
    //                 // $qtyRecipeIngredients = $recipes_ingredients[$i]->qtyRecipeIngredients;
                    
    //                 // $qtyHasil = $qtyAllIngredients - ($qtyOrderItem*$qtyRecipeIngredients);
                    
    //                 // $updateIngridient = DB::table('ingredients')
    //                 // ->where('ingredientid', $recipes_ingredients[$i]->ingredientid)
    //                 // ->update(['stock' => $qtyHasil]);
    //                 }

    //                 // var_dump($orders_recipes);
                       
    //             }
    // }
}
