@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 m-auto">
          <div class="card">
              <div class="card-header"><h2 class="m-auto">Add Product</h2></div>
              <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-4">
                    <select name="category_id" id="" class="form-control">
                        <option value="">Select Category</option>

                    </select>
                </div>
                <div class="mt-4">
                    <select name="subcategory_id" id="" class="form-control">
                        <option value="">Select Sub-Category</option>

                    </select>
                </div>

                <div class="mt-4">
                    <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                </div>
                <div class="mt-4">
                    <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand Name">
                </div>
                <div class="mt-4">
                    <input type="text" name="base_price" class="form-control" placeholder="Enter Product Base Price">
                </div>
                <div class="mt-4">
                    <label for="" class="">Product Image: </label>
                    <input type="file" name="product_image" class="form-control" placeholder="Enter Product Name">
                </div>
                <div class="mt-4">
                    <button class="btn btn-success" type="submit">Submit</button>

                </div>


            </form>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
