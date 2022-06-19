@extends('customer.layout')

<style>
    .product-title {
        font-size: 34px;
        line-height: 40px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .product-rental-period {
        font-size: 24px;
        line-height: 40px;
        font-weight: 700;
    }

    .product-price {
        font-size: 34px;
        line-height: 40px;
        font-weight: 700;
    }
</style>

@section('content')
    <section style="padding-top: 220px; padding-bottom: 150px;">
        <div class="container">
            <div class="card" style="padding: 25px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center">
                            <img src="{{ url('image/show/' . $product->image->slug) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <p>{!! $product->description !!}</p>
                        <p class="product-rental-period">Rental {{ $product->rental_period }} Days</span>
                        <p class="product-price">฿{{ $product->price }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
