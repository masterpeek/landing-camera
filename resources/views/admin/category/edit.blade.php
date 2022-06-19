@extends('admin.layout')

@section('content')
<div class="container">
    <form action="{{ url('/admin/category/' . $category->slug) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card" style="padding: 25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h3 style="text-gray-800">Edit Category</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload Image</label><br>
                        <input type="file" id="img" name="base_image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <img src="{{ url('image/show/' . $category->image->slug) }}" style="height: 150px;">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
