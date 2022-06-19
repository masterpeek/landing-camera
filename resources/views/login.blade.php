@extends('customer.layout')
<style>
    .login-submit-btn {
        border: 1px solid rgba(0,0,0,.9);
        background: rgba(0,0,0,.9) !important;
        color: #FFF !important;
    }
</style>
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="padding-top: 150px; padding-bottom: 100px;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="padding-top: 50px; padding-bottom: 50px;">
                    <div class="card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"
                            style=" background-image: url({{ asset('images/logo.jpg') }});
                            background-position: center;
                            background-size: cover;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    @if (session()->get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    @endif
                                    @if (session()->get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('error') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    @endif
                                    <form class="user" action="{{ url('/login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" value="">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block login-submit-btn">
                                            Login
                                        </button>
                                    </form>
                                    <!--
                                    <hr>
                                    <div class="text-center">
                                        <a href="#">Create an Account!</a>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
