<?php

namespace resbroto\Http\Controllers;

use Illuminate\Support\Facades\DB;
use resbroto\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\Input;

class waiterController extends Controller
{
    public function index()
    {
        // $recipelist = DB::table('recipes')->get();
        // $orders = DB::table('orders')->get();
        // return view('waiter.today_orders',['recipes' => $recipelist,'orders'=>$orders]);
    }

    public function store(Request $request)
    {
    	$name = Input::get('name');
    	var_dump($name);  	
    }

}
