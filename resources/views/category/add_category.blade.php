@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
        </ol>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header m-auto">
                   <h3> Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.category')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-6">
                            <input name='name' type="text" placeholder="Category Name" class="form-control">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="" class="mt-6"> Category Image:</label>
                            <input type="file" name="image" placeholder="Category Image" class="form-control">
                            @error('image')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success" type="submit" class="form-control"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header m-auto">
                   <h3> Category Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table bordered">
                        <tr>
                            <th class=""> Sl</th>
                            <th class="">Image</th>
                            <th class="">Name</th>
                            <th class=""> Action</th>
                        </tr>
                        @forelse ($category_info as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{asset('uploads/category')}}/{{$item->image}}" height="50" width="50"></td>
                            <td>{{$item->name}}</td>
                            <td> <a href="{{route('delete.category',$item->id)}}" class="btn btn-danger mr-4 mb-2"> Delete</a><a href="{{route('form.category',$item->id)}}" class="btn btn-secondary mr-4 mb-2"> Edit</a></td>

                            @empty
                            <td colspan="3"> No Catgeory Added Yet </td>

                        </tr>
                        @endforelse


                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
