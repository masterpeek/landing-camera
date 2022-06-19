@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="pulll-left">
                    <div class="form-group">
                        <h1 class="h3 mb-2 text-gray-800">Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <div class="form-group">
                        <a href="{{ url('admin/product/create') }}" class="btn btn-primary">Create Product</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of product</h6>
            </div>
            @if (count($products) == 0)
            <div class="text-center">
                <img src="{{ asset('images/no-data.png') }}" style="max-width: 500px;">
            </div>
            @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Rental Period</th>
                                <th>Category</th>
                                <th width="25%">Action</th>
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
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <div class="input-group">
                                            <a href="{{ url('admin/product/' . $product->slug . '/edit') }}"
                                                class="btn btn-warning mr-2">Edit</a>
                                            <form method="POST" action="{{ url('admin/product/' . $product->slug) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-delete">Delete</a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script>
    $('.btn-delete').click(function(e){
        e.preventDefault()
        if (confirm('Do you want delete product ?')) {
            $(e.target).closest('form').submit()
        }
    });
</script>
@endsection
