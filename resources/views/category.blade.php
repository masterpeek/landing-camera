@extends('customer.layout')

<style>

</style>

@section('content')
    <header style="
    background-image: url({{ url('image/show/' . $category->image->slug) }}),
    linear-gradient(rgba(0,0,0,0.25),rgba(0,0,0,0.25)) !important;
    background-blend-mode: overlay;
    background-position: center;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-size: auto;
    background-position: center;
    position: relative;">
    <div class="container">
        <h1 class="text-ellipsis text-center header-title">
            {{ $category->name }}
        </h1>
    </div>
    </header>
    <section style="padding-top: 100px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                @foreach ($category->products as $product)
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="card text-center" onclick="window.location.href = '{{ url('product/' . $product->slug) }}';" style="cursor: pointer;">
                            <img src="{{ url('image/show/' . $product->image->slug) }}" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
