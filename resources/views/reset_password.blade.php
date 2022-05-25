<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{ env('APP_NAME')}}</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg">
            
            <div class="content-center">
                <div class="content-desc-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                          
                                        <h3 class="text-center mt-0 m-b-15">
                                            <a href="index.html" class="logo logo-admin"><img src="{{asset('assets/images/logo-dark.png')}}" height="80" alt="logo"></a>
                                        </h3>
                
                                        <h4 class="text-muted text-center font-18"><b>Reset Password</b></h4>
                
                                        <div class="p-2">
                                                @if($errors->has('login_error'))
                                                    <div class="alert alert-warning">
                                                        {{Session::get('errors')->first('login_error')}}
                                                    </div>

                                                @endif

                                                @if (session('otp'))
                                                    <div class="alert alert-danger">
                                                        {{ session('otp') }}
                                                    </div>
                                                @endif
                                            <form method="POST" class="form-horizontal m-t-20" action="{{route('reset-password')}}">
                                                 @csrf
                                                 
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label>OTP </label>

                                                        <input class="form-control" name="otp" type="number"  placeholder="OTP">
                                                        @error('otp')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label>Password </label>
                                                        <input class="form-control" name="password" type="password"   placeholder="password" value="{{ old('username') }}">
                                                        @error('password')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label>Confirm Password </label>

                                                        <input class="form-control" name="confirm_password" type="password"  placeholder="Confirm Password">
                                                        @error('confirm_password')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{$id}}" name="id" />
                
                                                <div class="form-group text-center row m-t-20">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                                    </div>
                                                </div>
            
                                            </form>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{ asset('assets/js/detect.js')}}"></script>
        <script src="{{ asset('assets/js/fastclick.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{ asset('assets/js/waves.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js')}}"></script>

    </body>
</html> 