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
                        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <div class="form-group">
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary">Create Category</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List of category</h6>
                    </div>
                    @if (count($categories) == 0)
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
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td><img src="{{ url('image/show/' . $category->image->slug) }}"
                                                        style="height: 100px;"></td>
                                                <td>
                                                    <div class="input-group">
                                                        <a href="{{ url('admin/category/' . $category->slug) }}"
                                                            class="btn btn-primary mr-2">View</a>
                                                        <a href="{{ url('admin/category/' . $category->slug . '/edit') }}"
                                                            class="btn btn-warning mr-2">Edit</a>
                                                        <form method="POST"
                                                            action="{{ url('admin/category/' . $category->slug) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-danger btn-delete">Delete</a>
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
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.btn-delete').click(function(e) {
            e.preventDefault()
            if (confirm('Do you want delete category ?')) {
                $(e.target).closest('form').submit()
            }
        });
    </script>
@endsection
