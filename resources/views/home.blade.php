@extends('customer.layout')

<style>
    .section-wrapper {
        padding-bottom: 50px;
    }

    .service-card-wrapper>.card-body {
        text-align: center;
        padding: 50px;
    }

    .service-card-wrapper>.card-body>i {
        font-size: 28px;
        margin-bottom: 25px;
    }

    .portfolio-card {
        cursor: pointer;
        margin-bottom: 25px;
    }

    .product-category-card {
        cursor: pointer;
        margin-bottom: 25px;
    }

    .product-category-card .card-title {
        text-align: center;
    }

    .product-category-card>.card-body {
        text-align: center;
    }

    @media only screen and (max-width: 767px) {
        .product-category-card {
            margin-bottom: 25px;
        }
    }
</style>

@section('content')
    <header class="section-wrapper" style="padding-top: 75px;">
        <div class="container" style="padding-left: 0; padding-right: 0;">
            <!--<img src="{{ asset('images/header.jpg') }}" class="d-block w-100" alt="..." style="height: 500px">-->
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/header1.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/header2.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/header3.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
        </div>
    </header>
    <section class="section-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="padding-bottom: 25px;">
                        <h2>Services</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card-wrapper card">
                        <div class="card-body">
                            <i class="fas fa-search"></i>
                            <h5 class="card-title">Search Product</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card-wrapper card">
                        <div class="card-body">
                            <i class="fas fa-headset"></i>
                            <h5 class="card-title">Contact Staff</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card-wrapper card">
                        <div class="card-body">
                            <i class="fas fa-check-circle"></i>
                            <h5 class="card-title">Received Product</h5>
                        </div>
                    </div>
                </div>
                <div>
                </div>
    </section>
    <section class="section-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="padding-bottom: 25px;">
                        <h2>Credits</h2>
                    </div>
                </div>
                @foreach ($portfolios as $portfolio)
                    <div class="col-md-4">
                        <div class="portfolio-card card" onclick="window.location.href = '{{ url('portfolio/' . $portfolio->slug) }}';">
                            <img src="{{ url('image/show/' . $portfolio->image->slug) }}" class="card-img-top"
                                alt="{{ $portfolio->image->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $portfolio->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            <div>
        </div>
    </section>
    <section class="section-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="padding-bottom: 25px;">
                        <h2>Equipments</h2>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="product-category-card card" onclick="window.location.href = '{{ url('category/' . $category->slug) }}';">
                            <img src="{{ url('image/show/' . $category->image->slug) }}" class="card-img-top"
                                alt="{{ $category->name }}" style="padding: 15px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            <div>
        </div>
    </section>
@endsection
