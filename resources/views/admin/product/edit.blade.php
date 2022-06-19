@extends('admin.layout')

@section('content')
<div class="container">
    <form action="{{ url('/admin/product/' . $product->slug) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card" style="padding: 25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h3 style="text-gray-800">Edit Product</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Category Product</label><br>
                        <select class="form-control" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $key => $name)
                                <option value="{{ $key }}" {{ ($product->category_id == $key) ? 'selected' : ''}}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" name="description" rows="7">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Rental Period</label>
                        <input type="text" class="form-control" name="rental_period" value="{{ $product->rental_period }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload Image</label><br>
                        <input type="file" id="img" name="base_image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <img src="{{ url('image/show/' . $product->image->slug) }}" style="height: 150px;">
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
