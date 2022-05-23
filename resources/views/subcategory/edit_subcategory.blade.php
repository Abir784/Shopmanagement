@extends('layouts.dashboard')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6  m-auto">
            <div class="card">
                <div class="card-header m-auto">
                 <h3>Edit Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('edit.subcategory')}}" method="post">
                        @csrf
                        <div class="mt-4">
                            <input type="hidden" name="id" value="{{$subcategories->id}}">
                            <select name="category_id" id="" class="form-control">
                                <option value="{{$subcategories->category_id}}" selected>{{$subcategories->rel_to_category->name}}</option>

                                @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                               {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <input type="text" name="name" id="" class="form-control" value="{{$subcategories->name}}" placeholder="Enter Subcategory Name">
                            @error('name')
                               {{$message}}
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success" type="submit"> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
