@extends('admin.layout')

@section('content')
<div class="container">
    <form action="{{ url('/admin/portfolio') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card" style="padding: 25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h3 style="text-gray-800">Create Portfolio</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Portfolio Name</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Portfolio Description</label>
                        <textarea class="form-control" name="description" rows="7"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Facebook Link</label>
                        <input type="text" class="form-control" name="facebook_link" value="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Youtube Link</label>
                        <input type="text" class="form-control" name="youtube_link" value="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Instragram Link</label>
                        <input type="text" class="form-control" name="instragram_link" value="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tiktok Link</label>
                        <input type="text" class="form-control" name="tiktok_link" value="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload Base Image</label><br>
                        <input type="file" id="img" name="base_image" accept="image/*">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Upload Multiple Image</label><br>
                        <input type="file" class="my-pond" id="upload-multiple-image" name="images[]" multiple/>
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

@section('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
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
