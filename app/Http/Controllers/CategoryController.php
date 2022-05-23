<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function show_category(){
        $category_info=Category::all();
        return view('category.add_category',[
            'category_info'=>$category_info,
        ]);
    }
    function add_category(Request $request){
        $request->validate([
            'name'=>'required|max:100|string|unique:categories,name',
            'image'=>'mimes:png,jpg,JPG,PNG|max:2048',
        ],[
            'name.required'=>'You have to give a Category Name',
            'name.unique'=>'This Category has been already added',
             'name.max'=>'Category name must be within 100 characters',
             'name.string'=>'Category name must contain only alphabets',
              'image.mimes'=>'Image must be in (png,PNG,JPG,jpg) format',
              'image.max'=>'Size must be within 2 Mb',
        ]);



        if($request->hasFile('image')){

          $id=Category::insertGetId([
                'name'=>$request->name,
                'created_at'=>Carbon::now(),
            ]);
            $category_image=$request->image;
            $extension=$category_image->getClientOriginalExtension();
            $image_name=$id.'.'.$extension;
            Image::make($category_image)->save(public_path('uploads/category/'.$image_name));

            Category::find($id)->update([
                'image'=>$image_name,
            ]);
        }else{
            Category::insertGetId([
                'name'=>$request->name,
                'created_at'=>Carbon::now(),
            ]);

        }
        return back();


    }

    function delete_category($category_id){


        $category=Category::find($category_id);
        if ($category->image == '0.png'){

        $category->delete();


        }else{
            unlink(public_path('uploads/category/'.$category->image));
            $category->delete();

        }

        return back();

    }
    function form_category($category_id){
        $category=Category::find($category_id);
        return view('category.edit_category',[
            'category'=>$category,
        ]);


    }
    function edit_category(Request $request){
        $request->validate([
            'name'=>'required|max:100|string',
            'image'=>'mimes:png,jpg,JPG,PNG|max:2048',
        ],[
            'name.required'=>'You have to give a Category Name',
             'name.max'=>'Category name must be within 100 characters',
             'name.string'=>'Category name must contain only alphabets',
              'image.mimes'=>'Image must be in (png,PNG,JPG,jpg) format',
              'image.max'=>'Size must be within 2 Mb',
        ]);
        if($request->hasFile('image')){

              $id=$request->id;
              $category_image=$request->image;
              $extension=$category_image->getClientOriginalExtension();
              $image_name=$id.'.'.$extension;
              Image::make($category_image)->save(public_path('uploads/category/'.$image_name));

              Category::find($id)->update([
                  'image'=>$image_name,
                  'name'=>$request->name,
                  'updated_at'=>Carbon::now(),

              ]);
          }else{
              Category::find($request->id)->update([
                  'name'=>$request->name,
                  'updated_at'=>Carbon::now(),
              ]);

        }
        return back();


    }

}
