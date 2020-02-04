

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
                            	 <div class="text-center">
                                    <img width="150" src="{{URL::asset('images/sdssu.png')}}" alt="">
                                 </div>
                                <div class="p-5">
                                	<h4>Please wait for the approval of the administrator to your account request we immediately send you a Email after reviewing your campus credentials.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
