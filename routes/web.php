<?php

/*
|--------------------------------------------------------------------------
| Web Routesjml
|;
--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     echo "Selamat Datang";
// });

// Route::get('/', 'HomeController@index');
Route::get('/','HomeController@index');
Route::post('/hallo', 'HomeController@proses')->name('hallo');
// Route::get('/hallo/{nama}/{umur}/', 'HomeController@index')->where(['umur'=>'[0-9]+','nama'=>'[A-Za-z]+']);

Auth::routes();

Route::get('/home/admin','HomeController@indexAdmin')->middleware('cekAdmin');
Route::get('/home/user', 'HomeController@indexUser')->middleware('cekUser');

Route::get('/waiter','waiterController@index')->name('waiter');
Route::get('/waiterAdd',function(){
	$recipelist = DB::table('recipes')->get();
    $tablelist = DB::table('tables')->get();
    return view('waiter.add_order',['recipes' => $recipelist, 'tables' => $tablelist]);
})->name('waiterAdd');;

Route::post('/orderWaiter',function(){
	$data = Input::all();

	$storeOrder = DB::table('orders')->insert(
		[
			'tableid'=>$data['orderTable'],
			'status_order'=> 'ordered',
			'customer_name'=>$data['customer_name'],
			'persons' =>$data['persons'],
			'dateOrder'=>date("Y-m-d h:i:s")
		]
	);


	if ($storeOrder) {
		DB::table('tables')
            ->where('tableid', $data['orderTable'])
			->update(['status' => 0]);
			

			$order = DB::table('orders')
			->orderBy('orderid', 'desc')
			->limit(1)
			->get();

			

			for ($i=0; $i < count($data['orderItem']) ; $i++) { 
				if ($data['jml'][$i]) {
					DB::table('orders_recipes')->insert(
						[
							'orderid'=>$order[0]->orderid,
							'recipeid'=>$data['orderItem'][$i],
							'qtyOrderItem'=> $data['jml'][$i]
						]
						);
				}
			}

			$orders_recipes = DB::table('orders_recipes')
								->where('orderid','=',$order[0]->orderid)
								->get();

			
			for ($i=0; $i < count($orders_recipes) ; $i++) { 
				$qtyOrderItem = $orders_recipes[$i]->qtyOrderItem;
				$recipeId = $orders_recipes[$i]->recipeid;
				$orderId = $orders_recipes[$i]->orderid;
				
				$recipeIngredients = DB::table('recipes_ingredients')
				->where('recipeid','=',$recipeId)
				->get();

			
				for ($i=0; $i < count($recipeIngredients); $i++) { 
					$sUpdate = 0;
					$qtyRecipeIngredients = $recipeIngredients[$i]->qtyRecipeIngredients;
					$qtyG = $qtyOrderItem * $qtyRecipeIngredients;

						$stock = DB::table('ingredients')
								->select('stock')
								->where('ingredientid','=',$recipeIngredients[$i]->ingredientid)
								->get();
					
					$sUpdate = $stock[0]->stock - $qtyG;

					DB::table('ingredients')
							->where('ingredientid', '=',$recipeIngredients[$i]->ingredientid)
							->update(['stock' => $sUpdate]);

				}
			}		
			return redirect()->route('waiter');		
	} else {
		echo "STORE ORDER GAGAL";
	}

})->name('orderWaiter');

Route::get('/editOrder/{orderid}',function($orderid){
	// $dataOrders = DB::table('orders') 
	// 		->where('orderid','=',$orderId)
	// 		->get();
	// $dataTables = DB::table('tables') 
	// 		->get();	
	
	$dataEdit = DB::table('orders')
			->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
			->join('tables','orders.tableid','=','tables.tableid')
			->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
			->where('orders.orderid','=',$orderid)
			->get();

	$tables = DB::table('tables')
				->get();
	$recipes = DB::table('recipes')
				->get();


	return view('waiter.edit_order',['dataEdit'=>$dataEdit,'tables'=>$tables,'recipes'=>$recipes]);
	
})->name('editOrder');

Route::get('/orderDetail/{orderid}',function($orderid){
	$data = DB::table('orders')
			->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
			->join('tables','orders.tableid','=','tables.tableid')
			->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
			->where('orders.orderid','=',$orderid)
			->get();
	return view('waiter.order_details',['data'=>$data]);		
})->name('orderDetail');

Route::post('/updateOrder/',function(){
	// echo "<pre>";
	$data = Input::all();
	// var_dump($data);
	
	if ($data['tableBefore'] != $data['orderTable']) {
		$reStatusTableBefore = DB::table('tables')
            ->where('tableid', '=',$data['tableBefore'])
			->update(['status' => 1]);
		if ($reStatusTableBefore) {
			DB::table('tables')
            ->where('tableid', '=',$data['orderTable'])
			->update(['status' => 0]);
		} else {
			echo 'ReStatus Table Baru gagal';
		}
	} else {
		echo 'ReStatus Table Lama gagal';
	}

	$deleteOrderRecipes = DB::table('orders_recipes')
							->where('orderid','=',$data['orderid'])
							->delete();
	if ($deleteOrderRecipes) {
				$dataEdit = DB::table('orders')
				->where('orders.orderid','=',$data['orderid'])
				->update([
					'customer_name'=>$data['customer_name'],
					'persons'=>$data['persons']
					]);
	}
	
	
		$dataEdit = DB::table('orders')
				->where('orders.orderid','=',$data['orderid'])
				->update([
					'customer_name'=>$data['customer_name'],
					'persons'=>$data['persons']
					]);
		for ($i=0; $i < count($data['orderItem']) ; $i++) { 
			$ins = DB::table('orders_recipes')
				->insert(
					[
						'recipeid'=>$data['orderItem'][$i],
						'orderid'=>$data['orderid'],
						'qtyOrderItem'=>$data['jml'][$i]
						]
					);
		}
	
	
	
		return redirect()->route('waiter');	
})->name('updateOrder');

Route::get('/deleteOrder/{orderid}',function($orderid){
	$orders = DB::table('orders')
		->where('orderid','=',$orderid)
		->get();
		// echo '<pre>';
	// var_dump($orders);
	echo $orders[0]->tableid;
	$reStatusTable = DB::table('tables')
				->where('tableid','=',$orders[0]->tableid)
				->update([
					'status'=>1
					]);

	if ($reStatusTable) {
		DB::table('orders_recipes')->where('orderid', '=', $orderid)->delete();
		DB::table('orders')->where('orderid', '=', $orderid)->delete();
	}
	return redirect()->route('waiter');	
})->name('deleteOrder');


Route::get('/chef','chefController@index');
Route::post('/createRecipe',function(){
	$data = Input::all();
	
	$storeRecipes = DB::table('recipes')->insert(
		[
			'title'=>$data['title'],
			'price'=>$data['price'],
			'markup'=>0,		
			'description'=>$data['desc']
		]
	);

	$recipe = DB::table('recipes')
		->orderBy('recipeid', 'desc')
		->limit(1)
		->get();
	
		for ($i=0; $i < count($data['ingredientid']) ; $i++) { 
			if ($data['qtyRecipeIngredients'][$i]!= NULL) {
				$res = DB::table('recipes_ingredients')->insert(
								[
									'ingredientid'=>$data['ingredientid'][$i],
									'recipeid'=>$recipe[0]->recipeid,
									'qtyRecipeIngredients'=> $data['qtyRecipeIngredients'][$i]
								]
							);
			}
		}
		
	}


// }
)->name('createRecipe');

Route::get('/chefOrder','chefController@order');

// Route::get('/one', function(){
// 	$updateIngridient = DB::table('ingredients')
//             ->where('ingredientid', $recipes_ingredients[$i]->ingredientid)
//                     ->update(['stock' => $qtyHasil]);
//                     }
// });