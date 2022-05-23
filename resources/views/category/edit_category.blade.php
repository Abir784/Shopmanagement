@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header m-auto">
                    <h3>Update Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('edit.category')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$category->id}}" name='id'>
                        <div class="mt-6">
                            <input name='name' type="text" placeholder="Category Name" value='{{$category->name}}' class="form-control">
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
    </div>
</div>
@endsection
