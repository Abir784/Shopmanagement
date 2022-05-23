<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//profile

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//profile update
Route::get('/profile/update/{admin_id}',[ProfileController::class, 'profile_update'])->name('profile.update');
Route::post('/admin/profile/update',[ProfileController::class, 'admin_profile_update']);

//category
Route::get('/category',[CategoryController::class, 'show_category'])->name('show.category');
Route::post('/category/add',[CategoryController::class, 'add_category'])->name('add.category');
Route::get('/delete/category/{category_id}',[CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/edit/category/{category_id}',[CategoryController::class, 'form_category'])->name('form.category');
Route::post('/edit/category/backend',[CategoryController::class, 'edit_category'])->name('edit.category');
//sub category
Route::get('/subcategory',[SubcategoryController::class,'show_subcategory'])->name('show.subcategory');
Route::post('/subcategory/add',[SubcategoryController::class,'add_subcategory'])->name('add.subcategory');
Route::get('/subcategory/delete/{subcategory_id}',[SubcategoryController::class, 'delete_subcategory'])->name('delete.subcategory');
Route::get('/subcategory/edit_form/{subcategory_id}',[SubcategoryController::class, 'form_subcategory'])->name('form.subcategory');
Route::post('/subcategory/edit',[SubcategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
//product add
Route::get('/product/form',[ProductController::class, 'form_product'])->name('form.product');


