@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h1 class="h3 mb-2 text-gray-800">Product in category</h1>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of product</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Rental Period</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ url('image/show/' . $product->image->slug) }}"
                                            style="height: 100px;"></td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->rental_period }}</td>
                                    <td>
                                        <div class="input-group">
                                            <a href="{{ url('admin/product/' . $product->slug . '/edit') }}"
                                                class="btn btn-warning mr-2">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
