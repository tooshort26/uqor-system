@extends('admin.layouts.app')
@section('title', 'Admin Login')
@section('content')
<body class="">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome back Administrator</h1>
                                    </div>
                                    <form class="user"  method="POST" action="{{  route('admin.auth.loginAdmin') }}">
                                        <div class="form-group">
                                            @include('templates.error')
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="text-center mb-4">
                                            <img width="150" src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1580730503/university_app/sdssu.png" alt="">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user font-weight-bold" name="email" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user font-weight-bold" name="password" id="userPassword" placeholder="Password">
                                        </div>
                                      {{--   <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> --}}
                                       <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-user">
                                                Login
                                            </button>
                                       </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
