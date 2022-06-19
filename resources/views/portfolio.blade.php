@extends('customer.layout')

<style>

</style>

@section('content')
    <header style="
    background-image: url({{ url('image/show/' . $portfolio->image->slug ) }}),
    linear-gradient(rgba(0,0,0,0.25),rgba(0,0,0,0.25)) !important;
    background-blend-mode: overlay;
    background-position: center;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
    position: relative;">
    <div class="container">
        <h1 class="text-ellipsis text-center header-title">
            {{ $portfolio->name }}
        </h1>
    </div>
    </header>
    <section style="padding-top: 100px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                @foreach ($portfolio->images as $image)
                <div class="col-md-4">
                    <div class="form-group">
                        <img src="{{ url('image/show/' . $image->slug) }}" style="width: 100%;">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
