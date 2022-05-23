<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function show_subcategory(){
        $categories=Category::all();
        $subcategories=Subcategory::all();
        return view('subcategory.add_subcategory',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }
    function add_subcategory(Request $request){
        $request->validate([
            'category_id'=>'required',
            'name'=>'required|string|max:50|unique:subcategories,name',

        ],[
            'category_id.required'=>'Select valid Category Name.',
            'name.required'=>'you must enter Subcategory Name.',
            'name.string'=>'Subcategory name must be a string.',
            'name.max'=>'Subcategory Name must be within 50 characters.',
            'name.unique'=>'This subcategory have been already added',
        ]);
        Subcategory::insert([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
        ]);
        return back();

    }
    function delete_subcategory($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back();

    }
    function form_subcategory($subcategory_id){
        $subcategories=Subcategory::find($subcategory_id);
        $categories=Category::where('id','!=',$subcategories->category_id)->get();


        return view('subcategory.edit_subcategory',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);

    }
    function edit_subcategory(Request $request){

        $request->validate([
            'category_id'=>'required',
            'name'=>'required|string|max:50',

        ],[
            'category_id.required'=>'Select valid Category Name.',
            'name.required'=>'you must enter Subcategory Name.',
            'name.string'=>'Subcategory name must be a string.',
            'name.max'=>'Subcategory Name must be within 50 characters.',

        ]);
        Subcategory::find($request->id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'updated_at'=>Carbon::now(),
        ]);

        return back();




    }

}
