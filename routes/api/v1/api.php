<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/login', 'AuthController@login');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//-----------Shop-------------------//
Route::prefix('shop')->group(function () {
    Route::post('/update', 'ShopController@update');
    Route::get('/get', 'ShopController@get');
});

//------------Register------------------//
//Store
Route::prefix('register')->group(function () {
    Route::post('/create', 'RegisterController@store');
    //Update
    Route::post('/update', 'RegisterController@update');
    //GET
    Route::get('/getsingle', 'RegisterController@getSingle');
    Route::get('/getall', 'RegisterController@getAll');
    //Delete
    Route::get('/delete/{id}', 'RegisterController@destroy');
    Route::post('/deletemass', 'RegisterController@deleteMass');
});

//-----Product Category--------------------------//
Route::prefix('category')->group(function () {
    //Store
    Route::post('/create', 'ProductcategoryController@store');
    //update
    Route::post('/update', 'ProductcategoryController@update');
    //View
    Route::get('/getall', 'ProductcategoryController@index');
    Route::get('/getvalue', 'ProductcategoryController@getValue');
    //delete
    Route::get('/delete/{id}', 'ProductcategoryController@destroy');
    Route::post('/deletemass', 'ProductcategoryController@deleteMass');
});

/////--------varient-------------------------------------///////
Route::prefix('variant')->group(function () {
    Route::post('/store', 'VariantsController@store');
    Route::get('/getall', 'VariantsController@getall');
    Route::get('/getsingle', 'VariantsController@getsingle');
    Route::post('/update', 'VariantsController@update');
    Route::post('/deletemass', 'VariantsController@deleteMass');
    Route::get('/delete/{id}', 'VariantsController@destroy');
    Route::get('/removeall', 'VariantsController@removeall');
});
/////--------varient Group-------------------------------------///////
Route::prefix('variantgroup')->group(function () {
    Route::post('/store', 'VariantsgroupController@store');
    Route::post('/update', 'VariantsgroupController@update');
    Route::get('/getall', 'VariantsgroupController@getall');
    Route::get('/all', 'VariantsgroupController@showall');
    Route::get('/delete/{id}', 'VariantsgroupController@destroy');
    Route::get('/removeall', 'VariantsgroupController@removeall');
    Route::get('/getvariants', 'VariantsgroupController@getvariants');
    Route::get('/getsingle', 'VariantsgroupController@getsingle');
    Route::post('/deletemass', 'VariantsgroupController@deletemass');
});
/////--------Addon-------------------------------------///////
Route::prefix('addon')->group(function () {
    Route::get('/getall','AddonController@getall');
    Route::get('/getsingle','AddonController@getsingle');
    Route::post('/store', 'AddonController@store');
    Route::post('/deletemass', 'AddonController@deleteMass');
    Route::post('/update', 'AddonController@update');
    Route::get('/delete/{id}', 'AddonController@destroy');
    Route::get('/removeall', 'AddonController@removeall');
});
/////----------------Addon Group-------------------------------------///////
Route::prefix('addongroup')->group(function () {
    Route::post('/store', 'AddongroupController@store');
    Route::post('/update/{id}', 'AddongroupController@update');
    Route::get('/delete/{id}', 'AddongroupController@destroy');
    Route::get('/removeall', 'AddongroupController@removeall');
    Route::get('/getsingle/{id}', 'AddongroupController@getSingle');
    Route::get('/getall', 'AddongroupController@getAll');
});
//////-------------Tax-------------------------///
Route::prefix('tax')->group(function () {
    Route::post('/store', 'TaxController@store');
    Route::post('/update/{id}', 'TaxController@update');
    Route::get('/delete/{id}', 'TaxController@destroy');
    Route::get('/removeall', 'TaxController@removeall');
    Route::get('/getsingle/{id}', 'TaxController@getSingle');
    Route::get('/getall', 'TaxController@getAll');
});
//////-------------Tax-------------------------///
Route::prefix('taxgroup')->group(function () {
    Route::post('/store', 'TaxgroupController@store');
    Route::post('/update/{id}', 'TaxgroupController@update');
    Route::get('/delete/{id}', 'TaxgroupController@destroy');
    Route::get('/removeall', 'TaxgroupController@removeall');
    Route::get('/getsingle/{id}', 'TaxgroupController@getSingle');
    Route::get('/getall', 'TaxgroupController@getAll');
});
//---------Chashier-----------//
Route::prefix('chashier')->group(function () {
    Route::post('/store', 'ChashierController@store');
    Route::post('/update/{id}', 'ChashierController@update');
    Route::get('/delete/{id}', 'ChashierController@destroy');
    Route::get('/removeall', 'ChashierController@removeall');
    Route::get('/getsingle/{id}', 'ChashierController@getSingle');
    Route::get('/getall', 'ChashierController@getAll');
});
//--------------App User---------------------//
Route::prefix('appuser')->group(function () {
    Route::post('/store', 'AppuserController@store');
    Route::post('/update/{id}', 'AppuserController@update');
    Route::get('/delete/{id}', 'AppuserController@destroy');
    Route::get('/removeall', 'AppuserController@removeall');
    Route::get('/getsingle/{id}', 'AppuserController@getSingle');
    Route::get('/getall', 'AppuserController@getAll');
});
//-------------------Kitchen User------------------//
Route::prefix('kitchenuser')->group(function () {
    Route::post('/store', 'KitchenuserController@store');
    Route::post('/update/{id}', 'KitchenuserController@update');
    Route::get('/delete/{id}', 'KitchenuserController@destroy');
    Route::get('/removeall', 'KitchenuserController@removeall');
    Route::get('/getsingle/{id}', 'KitchenuserController@getSingle');
    Route::get('/getall', 'KitchenuserController@getAll');
});
//---------------Waiter User----------------//
Route::prefix('waiteruser')->group(function () {
    Route::post('/store', 'WaiteruserController@store');
    Route::post('/update/{id}', 'WaiteruserController@update');
    Route::get('/delete/{id}', 'WaiteruserController@destroy');
    Route::get('/removeall', 'WaiteruserController@removeall');
    Route::get('/getsingle/{id}', 'WaiteruserController@getSingle');
    Route::get('/getall', 'WaiteruserController@getAll');
});
Route::prefix('products')->group(function () {
    Route::post('/store', 'ProductsController@store');
    Route::post('/update/{id}', 'ProductsController@update');
    Route::get('/getsingle', 'ProductsController@getSingle');
    Route::post('/getall', 'ProductsController@getAll');
    Route::post('/delete/{id}', 'ProductsController@destroy');
    Route::post('/removeall', 'ProductsController@removeall');
    //Route::get('/get', 'ProductsController@relationtest');
});