@extends('admin.layout')

@section('content')
    <div class="container">
        <form action="{{ url('/admin/portfolio/' . $portfolio->slug) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card" style="padding: 25px;">
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <h3 style="text-gray-800">Edit Category</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Portfolio Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $portfolio->name }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Portfolio Description</label>
                            <textarea class="form-control" name="description" rows="7">{{ $portfolio->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Facebook Link</label>
                            <input type="text" class="form-control" name="facebook_link"
                                value="{{ $portfolio->facebook_link }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Youtube Link</label>
                            <input type="text" class="form-control" name="youtube_link"
                                value="{{ $portfolio->youtube_link }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Instragram Link</label>
                            <input type="text" class="form-control" name="instragram_link"
                                value="{{ $portfolio->instragram_link }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tiktok Link</label>
                            <input type="text" class="form-control" name="tiktok_link"
                                value="{{ $portfolio->tiktok_link }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Base Image</label><br>
                            <input type="file" id="img" name="base_image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <img src="{{ url('image/show/' . $portfolio->image->slug) }}" style="height: 150px;">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Multiple Image</label><br>
                            <input type="file" class="my-pond" id="upload-multiple-image" name="images[]" multiple />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Portfolio Images</label>
                    </div>
                    @foreach ($portfolio->images as $image)
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <img src="{{ url('image/show/' . $image->slug) }}"
                                    style="max-width: 100%; height: 150px; border: 1px solid #DEDEDE;">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <form ></form>
                            <form method="POST" action="{{ url('admin/portfolio/' . $portfolio->slug . '/image') }}">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="image_slug" value="{{ $image->slug }}">
                                <button type="button" class="btn btn-danger ok-btn">Delete</a>
                            </form>
                        </div>
                    @endforeach
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

@section('script')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        $('.ok-btn').click(function(e) {
            e.preventDefault()
            if (confirm('Do you want delete this portfolio ?')) {
                $(e.target).closest('form').submit()
            }
        });
    </script>
    <script>
        // Register the plugin with FilePond
        FilePond.registerPlugin(FilePondPluginImagePreview);
        // Get a reference to the file input element
        const inputElement = document.querySelector('#upload-multiple-image');
        // Create a FilePond instance
        const pond = FilePond.create(inputElement);
        pond.setOptions({
            allowMultiple: true,
            storeAsFile: true,
            //maxFiles: 5,
            required: true,
        });
    </script>
@endsection
