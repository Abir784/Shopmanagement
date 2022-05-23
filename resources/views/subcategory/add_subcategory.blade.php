@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                 <h3>Add Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.subcategory')}}" method="post">
                        @csrf
                        <div class="mt-4">
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Catagory</option>

                                @forelse ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                <option value="">No Categories Added Yet</option>

                                @endforelse
                            </select>
                            @error('category_id')
                               {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="name" id="" class="form-control" placeholder="Enter Subcategory Name">
                            @error('name')
                               {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Subcategory Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($subcategories as $key=>$subcategory )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$subcategory->rel_to_category->name}}</td>
                            <td>{{$subcategory->name}}</td>
                            <td><a href="{{route('delete.subcategory', $subcategory->id)}}" class="btn btn-danger mr-3 mb-2">Delete</a> <a href="{{route('form.subcategory', $subcategory->id)}}" class="btn btn-secondary mr-3 mb-2">Edit</a></td>


                            @empty
                            <td colspan="4"> No subcategories Added Yet</td>

                            @endforelse
                        </tr>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
