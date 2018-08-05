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
// Route::get('/','HomeController@index');
// Route::post('/hallo', 'HomeController@proses')->name('hallo');
// Route::get('/hallo/{nama}/{umur}/', 'HomeController@index')->where(['umur'=>'[0-9]+','nama'=>'[A-Za-z]+']);

Auth::routes();

Route::get('/home/admin','HomeController@indexAdmin')->middleware('cekAdmin');
Route::get('/home/user', 'HomeController@indexUser')->middleware('cekUser');

Route::get('/waiter',function(){
	
	$orders = DB::table('orders')->get();
	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
	return view('waiter.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif]);
})->name('waiter');

Route::get('/waiterAdd/',function(){

	$recipeList = DB::table('recipes')
				->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
				->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
				->get();

	$cek = "";$j=1;
	if (count($recipeList)>0) {
		for ($i=0; $i <count($recipeList) ; $i++) {
			 if ($cek != $recipeList[$i]->recipeid) {
				$cek = $recipeList[$i]->recipeid;
				$recipeForMax[$j] = $recipeList[$i]->recipeid;
				$j=$j+1;	
			}
			$checkMax[$recipeList[$i]->recipeid][$recipeList[$i]->ingredientid] = (int)($recipeList[$i]->stock / $recipeList[$i]->qtyRecipeIngredients);	
		}

		$j=0;
		for ($i=1; $i <= count($checkMax) ; $i++) { 
			$maxAvailable[$j]['recipeid'] = $recipeForMax[$i];
			$maxAvailable[$j]['max'] = min($checkMax[$i]);	
			$j=$j+1;
		};
		$tablelist = DB::table('tables')->get();
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );	
		return view('waiter.add_order',['recipes' => $recipeList, 'tables' => $tablelist,'notifications'=>$orderNotif,'maxAvailable'=>$maxAvailable]);	
	} else {
		alert('Failed to save');
		return redirect()->route('waiter');	
	}

	
})->name('waiterAdd');

function maxAvailable(){
	$checkRecipe = DB::table('recipes')
				->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
				->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
				->get();

	$cek = "";$j=1;
	if (count($checkRecipe)>0) {
		for ($i=0; $i <count($checkRecipe) ; $i++) {
			 if ($cek != $checkRecipe[$i]->recipeid) {
				$cek = $checkRecipe[$i]->recipeid;
				$recipeForMax[$j] = $checkRecipe[$i]->recipeid;
				$j=$j+1;	
			}
			$checkMax[$checkRecipe[$i]->recipeid][$checkRecipe[$i]->ingredientid] = (int)($checkRecipe[$i]->stock / $checkRecipe[$i]->qtyRecipeIngredients);	
		}

		$j=0;
		for ($i=1; $i <= count($checkMax) ; $i++) { 
			$maxAvailable[$j]['recipeid'] = $recipeForMax[$i];
			$maxAvailable[$j]['max'] = min($checkMax[$i]);	
			$j=$j+1;
		};
	}

	return $maxAvailable;
}

Route::post('/searchRecipeWaiter/',function(){
	$data = Input::all();
	
	$recipelist = DB::table('recipes')
                ->where('title', 'like', '%'.$data['search'].'%')
				->orWhere('price', 'like', '%'.$data['search'].'%')
				->get();
	$maxAvailable = maxAvailable();
	
	if (count($recipelist)>0) {
		$message="";
		$tablelist = DB::table('tables')->get();
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );	
		return view('waiter.add_order',['recipes' => $recipelist, 'tables' => $tablelist,'notifications'=>$orderNotif,'message'=>$message,'maxAvailable']);	
	} else {
		alert('Failed to save');
		$message="";
		$tablelist = DB::table('tables')->get();
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );	
		return view('waiter.add_order',['recipes' => $recipelist, 'tables' => $tablelist,'notifications'=>$orderNotif,'message'=>$message]);	
	}
})->name('searchRecipeWaiter');

Route::post('/searchWaiter/',function(){
	$data = Input::all();
	$orders = DB::table('orders')
				->where('orderid', 'like', '%'.$data['search'].'%')
				->orWhere('status_order', 'like', '%'.$data['search'].'%')
				->orWhere('customer_name', 'like', '%'.$data['search'].'%')
				->orWhere('dateOrder', 'like', '%'.$data['search'].'%')
				->get();
	

	if (count($orders)>0) {
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
		if (count($orders)) {
			return view('waiter.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif]);
		} 	
	} else {
			echo "<script>$('#orderidnotfound').modal('show');</script>";
			$orders = DB::table('orders')->get();
			$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
			$notFound = TRUE;
			$message = $data['search']." not found";
			return view('waiter.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif,'notFound'=>$notFound,'message'=>$message]);	
	}
})->name('searchWaiter');


Route::post('/categoryWaiter',function(){
	$data = Input::all();
	if (isset($data['category'])) {
		$orders = DB::select( DB::raw("select * from `orders` order by status_order = '".$data['category']."' desc") );
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
		return view('waiter.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif]);
	} else {
		return redirect()->route('waiter');	
	}
	
})->name('categoryWaiter');



Route::post('/orderWaiter',function(){
	$data = Input::all();

	echo '<pre>';
	if (
		($data['customer_name']!= NULL) &&
		($data['orderTable']!= NULL) &&
		($data['persons'] != NULL) &&
		(isset($data['orderItem']))
		) 
	{
		$storeOrder = DB::table('orders')->insert(
			[
				'tableid'=>$data['orderTable'],
				'status_order'=> 'ordered',
				'customer_name'=>$data['customer_name'],
				'persons' =>$data['persons'],
				'dateOrder'=>date("Y-m-d h:i:s")
			]	
		);

	} else {
		echo "<script>alert('Failed to save')</script>";
		echo "<script>history.go(-1)</script>";
	}



	if ($storeOrder) {
		DB::table('tables')
            ->where('tableid', $data['orderTable'])
			->update(['status' => 0]);
			

			$order = DB::table('orders')
			->orderBy('orderid', 'desc')
			->limit(1)
			->get();

			
			
			$jmlFilter = array_filter($data['jml']);
			
			$j=0;
			for ($i=0; $i < count($jmlFilter); $i++) { 
				while(!isset($jmlFilter[$j])){
					$j=$j+1;
				}
				$jmlAfterFilter[$i] = $jmlFilter[$j];	
			}

			
			for ($i=0; $i < count($jmlAfterFilter) ; $i++) { 
				
					DB::table('orders_recipes')->insert(
						[
							'orderid'=>$order[0]->orderid,
							'recipeid'=>$data['orderItem'][$i],
							'statusCook'=>'0',
							'qtyOrderItem'=> $jmlAfterFilter[$i]
						]
						);
				
			}

			$orders_recipes = DB::table('orders_recipes')
								->where('orderid','=',$order[0]->orderid)
								->get();
			
											
			for ($i=0; $i < count($orders_recipes) ; $i++) { 
				$qtyOrderItem = $orders_recipes[$i]->qtyOrderItem;
				$recipeId = $orders_recipes[$i]->recipeid;
				$orderId = $orders_recipes[$i]->orderid;
			}

			$orderGet = DB::table('orders')
						->join('tables','tables.tableid','=','orders.tableid')
						->orderBy('orderid','DESC')
						->limit(1)
						->get();

			DB::table('order_notifications')
						->insert([
							'notification' => "Order ". $orderGet[0]->orderid." table ".$orderGet[0]->identifier." ordered",
							'orderid' => $orderGet[0]->orderid	
						]);
			return redirect()->route('waiter');		
	} else {
		echo "<script>alert('Failed to save')</script>";
		echo "<script>history.go(-1)</script>";
	}
	

})->name('orderWaiter');

Route::get('/editOrder/{orderid}',function($orderid){
	
	$dataEdit = DB::table('orders')
			->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
			->join('tables','orders.tableid','=','tables.tableid')
			->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
			
			->where('orders.orderid','=',$orderid)
			->get();
	
	if (count($dataEdit)>0) {
		$tables = DB::table('tables')
				->get();

				$recipes = DB::table('recipes')
				->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
				->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
				->get();

			$maxAvailable = maxAvailable();

			$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
			
			return view('waiter.edit_order',['dataEdit'=>$dataEdit,'tables'=>$tables,'recipes'=>$recipes,'notifications'=>$orderNotif,'maxAvailable'=>$maxAvailable]);		
	} else {
		echo "<script>alert('Failed to save')</script>";
		echo "<script>history.go(-1)</script>";
	}
	
})->name('editOrder');

Route::get('/orderDetail/{orderid}',function($orderid){
	$data = DB::table('orders')
			->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
			->join('tables','orders.tableid','=','tables.tableid')
			->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
			->where('orders.orderid','=',$orderid)
			->get();

			
	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );

	return view('waiter.order_details',['data'=>$data,'notifications'=>$orderNotif]);		
})->name('orderDetail');

Route::post('/searchOrderRecipeCustomer/',function(){
	$search = Input::all();
	$thatSearch = $search['search'];
	
	$orderid = $search['orderid'];

	$data = DB::select( DB::raw(
		"
		SELECT * FROM orders 
			INNER JOIN orders_recipes ON orders.orderid = orders_recipes.orderid 
			INNER JOIN tables ON orders.tableid = tables.tableid 
			INNER JOIN recipes ON orders_recipes.recipeid = recipes.recipeid 
			WHERE (orders.orderid = ".$orderid." AND recipes.title 
			LIKE '%".$thatSearch."%')
		"
		));

	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
	if (count($data)>0) {
		return view('waiter.order_details',['data'=>$data,'notifications'=>$orderNotif]);		
	} else {
		$notFound = TRUE;
		$message = $thatSearch." not found";
		$data = DB::table('orders')
				->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
				->join('tables','orders.tableid','=','tables.tableid')
				->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
				->where('orders.orderid','=',$orderid)
				->get();

		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );

		return view('waiter.order_details',['data'=>$data,'notifications'=>$orderNotif,'notFound'=>$notFound,'message'=>$message]);	
	}
	
	
})->name('searchOrderRecipeCustomer');

Route::post('/updateOrder/',function(){
	$data = Input::all();
	
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
						'qtyOrderItem'=>$data['jml'][$i],
						'statusCook'=>0	
						]
					);
		}
	
		return redirect()->route('waiter');	
})->name('updateOrder');

Route::get('/deliverOrder/{orderid}',function($orderid){
	$reStatusOrder = DB::table('orders')
				->where('orderid','=',$orderid)
				->update([
					'status_order'=>'delivered'
					]);
	if ($reStatusOrder) {
		return redirect()->route('waiter');	
	}
})->name('deliverOrder');

Route::get('/deleteOrder/{orderid}',function($orderid){
	$orders = DB::table('orders')
		->where('orderid','=',$orderid)
		->get();
	
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


Route::post('searchEditOrder',function(){
	$search = Input::all();
	$thatSearch = $search['search'];
	
	$orderid = $search['orderid'];
	
	$dataEdit = DB::select( DB::raw(
		"
		SELECT * FROM orders 
			INNER JOIN orders_recipes ON orders.orderid = orders_recipes.orderid 
			INNER JOIN tables ON orders.tableid = tables.tableid 
			INNER JOIN recipes ON orders_recipes.recipeid = recipes.recipeid 
			WHERE (orders.orderid = ".$orderid." AND recipes.title 
			LIKE '%".$thatSearch."%')
		"
		));
	
	if (count($dataEdit)<1) {
		$message = $thatSearch." not found";
	}
	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
	
	$tables = DB::table('tables')
				->get();
	$recipes = DB::table('recipes')
				->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
				->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
				->get();

				

	for ($i=0; $i <count($recipes) ; $i++) { 
		$checkMax[$recipes[$i]->recipeid]['recipeid'] = $recipes[$i]->recipeid;
		$checkMax[$recipes[$i]->recipeid][$recipes[$i]->ingredientid] = (int)($recipes[$i]->stock / $recipes[$i]->qtyRecipeIngredients);	
	}
	
	for ($i=0; $i < count($checkMax); $i++) { 
		$maxAvailable[$i]['recipeid']=$checkMax[$i+1]['recipeid'];
		$maxAvailable[$i]['max']=min($checkMax[$i+1]);
	}	

	return view('waiter.edit_order',['dataEdit'=>$dataEdit,'tables'=>$tables,'recipes'=>$recipes,'notifications'=>$orderNotif, 'maxAvailable'=>$maxAvailable]);
})->name('searchEditOrder');

Route::get('chef/',function(){
	$orderDeliveredCount = DB::table('orders')
				->where('status_order','=','delivered')
				->count();
	$orderCookedCount = DB::table('orders')
				->where('status_order','=','cooked')
				->count();
	$orderOrderedCount = DB::table('orders')
				->where('status_order','=','ordered')
				->count();				
				
	$recipeList = DB::table('recipes')
			->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
			->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
			->get();

	$tempCek =""; 
	$checkAvailbility = "Available"; 

	$recipeAvailableCount = 0;
	$recipeUnvailableCount = 0;

				foreach ($recipeList as $recipe): ?>
				<?php 
						if ($recipe->qtyRecipeIngredients > $recipe->stock ) {
							$checkAvailbility = "Unavailable";
							$recipeUnvailableCount = $recipeUnvailableCount +1;
						}

						if (($tempCek != $recipe->recipeid) && ($checkAvailbility == "Available"))  :
							$tempCek = $recipe->recipeid; 
							$recipeAvailableCount = $recipeAvailableCount +1;  
						 endif;
				endforeach;
				
	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
	
	return view('chef.chef_dashboard',
		[
			'orderDeliveredCount'=>$orderDeliveredCount,
			'orderCookedCount'=> $orderCookedCount,
			'orderOrderedCount'=> $orderOrderedCount,
			'recipeAvailableCount'=>$recipeAvailableCount,
			'recipeUnvailableCount'=>$recipeUnvailableCount,
			'notifications'=>$orderNotif 
		]
	);
})->name('chef');


Route::get('/chefToday',function(){
	$orders = DB::table('orders')
				->get();
	$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );

	return view('chef.today_orders',['orders'=>$orders,'notifications'=>$orderNotif ]);
})->name('chefToday');

Route::post('/categoryChef',function(){
	$data = Input::all();
	if (isset($data['category'])) {
		$orders = DB::select( DB::raw("select * from `orders` order by status_order = '".$data['category']."' desc") );
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
		return view('chef.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif]);
	} else {
		return redirect()->route('chefToday');	
	}
})->name('categoryChef');

Route::post('/searchChef/',function(){
	$data = Input::all();
	$orders = DB::table('orders')
				->where('orderid', 'like', '%'.$data['search'].'%')
				->orWhere('status_order', 'like', '%'.$data['search'].'%')
				->orWhere('customer_name', 'like', '%'.$data['search'].'%')
				->orWhere('dateOrder', 'like', '%'.$data['search'].'%')
				->get();
	

	
	if (count($orders)>0) {
		$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
		if (count($orders)) {
			return view('chef.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif]);
		} 	
	} else {
			
			$orders = DB::table('orders')->get();
			$orderNotif = DB::select( DB::raw("SELECT * FROM `order_notifications` WHERE DATE(order_notifications.date) = DATE(CURDATE())") );
			$notFound = TRUE;
			$message = $data['search']." not found";
			return view('chef.today_orders',['orders'=>$orders, 'notifications'=>$orderNotif,'notFound'=>$notFound,'message'=>$message]);	
	}
})->name('searchChef');


Route::get('/recipeList',function(){
	$recipeList = DB::table('recipes')
				->join('recipes_ingredients','recipes_ingredients.recipeid','=','recipes.recipeid')
				->join('ingredients','ingredients.ingredientid','=','recipes_ingredients.ingredientid')
				->get();
	return view('chef/recipes_list',['recipes'=>$recipeList]);
})->name('recipeList');

Route::get('/CreateRecipes',function(){
	$ingredients = DB::table('ingredients')
					->get();
	return view('chef.recipe_create',['ingredients'=> $ingredients]);
})->name('CreateRecipes');

Route::post('/recipeCreate',function(){
	$data = Input::all();

		$temp = 0;
	for ($i=0; $i < count($data['qtyRecipeIngredient']) ; $i++) { 
		if ($data['qtyRecipeIngredient'][$i] != NULL) {
			echo $data['qtyRecipeIngredient'][$i];
			$ingredients[$temp] = array(
				'ingredientid' =>$data['ingredientid'][$temp],
				'qtyRecipeIngredient' => $data['qtyRecipeIngredient'][$i],
			);
			$temp = $temp +1;
		}
	}
	
	$storeRecipes = DB::table('recipes')->insert(
		[
			'title'=>$data['recipe_name'],
			'price'=>$data['recipe_price'],
			'markup'=>0,		
			'description'=>$data['recipe_description']
		]
	);

	$recipe = DB::table('recipes')
		->orderBy('recipeid', 'desc')
		->limit(1)
		->get();

	for ($i=0; $i < count($ingredients) ; $i++) { 
		$result = DB::table('recipes_ingredients')->insert([
				'ingredientid'=>$ingredients[$i]['ingredientid'],
				'recipeid'=>$recipe[0]->recipeid,
				'qtyRecipeIngredients'=>$ingredients[$i]['qtyRecipeIngredient']
			]
		);
	}
		if ($result) {
			return redirect()->route('recipeList');	
		}
		
	}

)->name('recipeCreate');

Route::get('/orderDetailChef/{orderid}', function($orderid){
	$data = DB::table('orders')
			->join('orders_recipes','orders.orderid','=','orders_recipes.orderid')
			->join('tables','orders.tableid','=','tables.tableid')
			->join('recipes','orders_recipes.recipeid','=','recipes.recipeid')
			->where('orders.orderid','=',$orderid)
	->get();

	return view('chef.order_details',['data'=>$data]);
})->name('orderDetailChef');

Route::get('/cookedOrder/{orderid}/{recipeid}',function($orderid,$recipeid){
	
	$data = DB::table('recipes_ingredients')
			->join('orders_recipes','orders_recipes.recipeid','=','recipes_ingredients.recipeid')
			->join('ingredients','recipes_ingredients.ingredientid','=','ingredients.ingredientid')
			->where('orders_recipes.orderid','=',$orderid)
			->where('orders_recipes.recipeid','=',$recipeid)
			->get();

			
			for ($i=0; $i < count($data); $i++) { 
				$tot = 0;
				$tot = $data[$i]->qtyRecipeIngredients * $data[$i]->qtyOrderItem;

				$ing = DB::table('ingredients')
					->where('ingredientid','=',$data[$i]->ingredientid)
					->get();
					
				 DB::table('ingredients')
					 ->where('ingredientid','=',$data[$i]->ingredientid)
					 ->update([ 
						'stock'=>$ing[0]->stock - $tot]);
			};

			
			$res = DB::table('orders_recipes')
			->where('orderid','=',$orderid)
			->where('recipeid','=',$recipeid)
			->update(
				[ 
			   'statusCook'=>1
			   ]
			);

			$checkCooked = DB::table('orders_recipes')
					->where('orderid','=',$orderid)
					->get();
			$noCooked = FALSE;
			for ($i=0; $i < count($checkCooked) ; $i++) { 
				if ($checkCooked[$i]->statusCook == 0) {
					$noCooked = TRUE;
					break;
				} 
			}

			if ($noCooked == FALSE) {
				$resRestatusCooked = DB::table('orders')
							->where('orderid','=',$orderid)
							->update([
								'status_order' =>'cooked'
							]);
			}
	if ($res) {
		return redirect()->route('orderDetailChef',['orderid'=>$orderid]);	
	}			
})->name('cookedOrder');

Route::get('/createIngredient', function(){
	return view('chef.recipe_add_new_ingredient');
})->name('createIngredient');

Route::post('/createIng', function(){
	$data = Input::all();

	// date_default_timezone_set('UTC');
	$timestamp = strtotime('2018-01-01');
	$date=date("Y-m-d", $timestamp);
	$result = DB::table('ingredients')->insert([
			'name'=>$data['new_ingredient_name'],
			'stock'=>$data['new_ingredient_recipe_qty'],
			'expiryDate'=>$date,
			'unit_of_measure'=>$data['new_units_of_measure']
		]
	);

	if ($result) {
		return redirect()->route('CreateRecipes');	
	}

})->name('createIng');

Route::get('/recipeDetails/{recipeid}', function($recipeid){
	$data = DB::table('recipes')
			->join('recipes_ingredients','recipes.recipeid','=','recipes_ingredients.recipeid')
			->join('ingredients','recipes_ingredients.ingredientid','=','ingredients.ingredientid')
			->where('recipes.recipeid','=',$recipeid)
			->get();
	return view('chef.recipe_details',['data'=>$data]);
})->name('recipeDetails');

Route::get('/recipeEdit/{recipeid}',function($recipeid){
	$data = DB::table('recipes')
			->join('recipes_ingredients','recipes.recipeid','=','recipes_ingredients.recipeid')
			->join('ingredients','recipes_ingredients.ingredientid','=','ingredients.ingredientid')
			->where('recipes.recipeid','=',$recipeid)
			->get();
	$dataIngredients = DB::table('ingredients')
				->get();
	return view('chef.recipes_edit',['data'=>$data,'dataIngredients'=>$dataIngredients]);
})->name('recipeEdit');

Route::post('updateRecipe',function(){
	$data = Input::all();
	echo '<pre>';
	// var_dump($data['recipeid']);
	
	$res1 = DB::table('recipes_ingredients')
			->where('recipeid','=',$data['recipeid'])
			->delete();
	
		
			if($res1){
		var_dump($data['qtyRecipeIngredient']);
		$temp = 0;
		for ($i=0; $i < count($data['qtyRecipeIngredient']) ; $i++) { 
				if ($data['qtyRecipeIngredient'][$i] != NULL) {
				$ingredients[$temp] = array(
					'ingredientid' =>$data['ingredientid'][$temp],
					'qtyRecipeIngredient' => $data['qtyRecipeIngredient'][$i],
				);
				$temp = $temp +1;
			} 
		}
	}

		// echo count($ingredients);
		for ($i=0; $i < count($ingredients) ; $i++) { 
			// var_dump($ingredients[$i]['ingredientid']);
				$result = DB::table('recipes_ingredients')->insert([
					'ingredientid'=>$ingredients[$i]['ingredientid'],
					'recipeid'=>$data['recipeid'],
					'qtyRecipeIngredients'=>$ingredients[$i]['qtyRecipeIngredient']
				]
			);
		}

		return redirect()->route('recipeDetails',['recipeid'=>$data['recipeid']]);	
})->name('updateRecipe');

Route::get('/deleteRecipe/{recipeid}',function($recipeid){
	$dataDeleteRecipeIngredients = DB::table('recipes_ingredients')
			->where('recipeid','=',$recipeid)
			->delete();
			if ($dataDeleteRecipeIngredients) {
				DB::table('recipes')
				->where('recipeid','=',$recipeid)
				->delete();
			}
	return redirect()->route('recipeList');	
})->name('deleteRecipe');


Route::get('/pantry',function(){
	$data = DB::table('ingredients')
		->get();
	$dTerakhir = DB::table('ingredients')
		->orderBy('ingredientid', 'desc')
		->limit(1)
		->get();
	$lastId = $dTerakhir[0]->ingredientid;
	return view('pantry.index', ['data'=>$data,'lastid'=>$lastId]);
})->name('pantry');

Route::post('/updatePantry/',function(){
	$data =Input::all();
	echo '<pre>';
	var_dump($data);
	if ($data['typeSubmit']=='edit') {
		$timestamp = strtotime($data['expiryDate']);
		$date=date("Y-m-d", $timestamp);
			$result = DB::table('ingredients')
			->where('ingredientid','=',$data['ingredientid'])
			->update([
				'name'=>$data['name'],
				'stock'=>$data['stock'],
				'expiryDate'=>$date,
				'unit_of_measure'=>$data['unitofmeasure']
			]
		);
		return redirect()->route('pantry');	
	} elseif($data['typeSubmit']=='delete') {
		$resultDelete = DB::table('ingredients')
						->where('ingredientid','=',$data['ingredientid'])
						->delete();
		return redirect()->route('pantry');	
	} else {
		echo 'Something wrong with delete or update process';
	}
	

})->name('updatePantry');

Route::post('insertIngredient',function(){
	$data = Input::all();
	$timestamp = strtotime($data['expiryDate']);
	$date=date("Y-m-d", $timestamp);
	$res = DB::table('ingredients')
			->insert(
				[
					'ingredientid'  => $data['ingredientid'],
					'name'			=> $data['name'],
					'stock'			=> $data['stock'],
					'expiryDate'	=> $date,
					'unit_of_measure' => $data['unitofmeasure']
				]
			);
	if ($res) {
		return redirect()->route('pantry');	
	} else{
		echo "<script>window.alert('Insert new ingredient failed')</script>";
		return redirect()->route('pantry');	
	}		
})->name('insertIngredient');

Route::get('customer_service',function(){
	$data = DB::table('critics')
				->join('orders','orders.orderid','=','critics.orderid')
				->get();
	return view('customer_service.customer_service_dashboard',['data'=>$data]);
})->name('customer_service');

Route::get('customer_service_detail/{criticid}',function($criticid){
	$data = DB::table('critics')
				->join('orders','orders.orderid','=','critics.orderid')
				->where('criticid','=',$criticid)
				->get();
	return view('customer_service.critics_detail',['data'=>$data]);
})->name('customer_service_detail');


Route::get('deleteCritic/{criticid}',function($criticid){
	$result = DB::table('critics')
				->where('criticid','=',$criticid)
				->delete();
	if ($result) {
		return redirect()->route('customer_service');
	} else {
		echo "<script>alert('Failed to delete critic')</script>";
		return redirect()->route('customer_service_detail',['criticid'=>$criticid]);
	}			

})->name('deleteCritic');

Route::get('customer',function(){
	return view('customer.critics_detail');
})->name('customer');

Route::post('insertCritic',function(){
	$data = Input::all();
	$findOrder = DB::table('orders')
				->where('orderid','=',$data['orderid'])
				->get();
	
	echo '<pre>';
	var_dump($data);
	if (count($findOrder)==1){
		$res = DB::table('critics')
					->insert([
						'comments'=>$data['critic'],
						'orderid'=>$data['orderid'],
						'coziness'=>$data['coziness'],
						'services'=>$data['services'],
						'menu'=>$data['menu']	
					]);
		if($res){
			return redirect()->route('customer');	
		} else {
			echo "<script>alert('Data fail to save')</script>";
		}
	} else {
		echo "<script>alert('".$data['orderid']." not found ')</script>";
	}
})->name('insertCritic');

function Error(){
	echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
	crossorigin="anonymous"></script>';
	
	echo ' <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">';

	echo '
	<div class="modal fade" id="warningFailed" tabindex="-1" role="dialog" aria-labelledby="warningFailedLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningFailed">
                    <!-- <i class="fa fa-question-circle" aria-hidden="true"></i> -->
                    <!-- <i class="fa fa-exclamation-circle"></i> -->
                    <i class="fa fa-warning" aria-hidden="true"></i>
                    Warning
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
               Failed to save
            </div>
        </div>
    </div>
</div>
	';
		
};