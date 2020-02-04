@extends('admin.layouts.app')
@section('title', 'Campus Login')
@section('content')
<body class="bg-gradient-primary">
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
                                    <form class="user"  method="POST" action="{{  route('campus.register.submit') }}">
                                         <div class="form-group">
                                            @include('templates.error')
                                        </div>
                                        {{ csrf_field() }}
                                        

                                        <div class="text-center">
                                            <img width="150" src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1580730503/university_app/sdssu.png" alt="">
                                        </div>

                                        <h3>Request an account</h3>
                                        <hr>


                                        <label>Email Address</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user font-weight-bold" name="email" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}">
                                        </div>

                                        <label>Campus Name</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class='form-control form-control-user font-weight-bold' placeholder="Enter your Campus name" value="{{ old('name') }}">
                                        </div>

                                        <label>Phone number</label>
                                        <div class="form-group">
                                            <input type="text" name="phone_number" class='form-control form-control-user font-weight-bold' placeholder="Enter Phone number" value="{{ old('phone_number') }}">
                                        </div>
                                        
                                        <label>Campus Address</label>
                                        <div class="form-group">
                                            <textarea name='address' class='form-control form-control-user font-weight-bold' placeholder="Enter address">{{ old('address') }}</textarea>
                                        </div>

                                        <label>Password</label>
                                        <div class='form-group'>
                                            <input type="password" class='form-control form-control-user font-weight-bold' name="password" placeholder="Enter your password">
                                        </div>


                                        <label>Re-type Password</label>
                                        <div class='form-group'>
                                            <input type="password" class='form-control form-control-user font-weight-bold' name="password_confirmation" placeholder="Re-type your password">
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-user">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
