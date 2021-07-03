<head>
    @include('user::Layouts._common_script_links')
</head>
@extends('user::Layouts._master')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} | Login</title>
@endsection
@section('main-content')
    <!--begin::Signin-->
        <div id="error" hidden style="color: red;text-align:center;">

        </div>
    <div class="login-form py-11">
        @if(isset($code,$result))
            @if(($code == 400))
                <script>
                        toastr.error("{{$result}}")
                </script>
            @endif
            @if(($code == 200))
                <script>
                        toastr.success("{{$result}}")
                </script>
        @endif
    @endif
    <!--begin::Form-->
        <form class="form" novalidate="novalidate" id="login_form">
        @csrf

        <!--begin::Title-->
        <!--begin::Form-->

        @if(session('invalidSocial'))
            <div style="color: red;text-align:center;">
                {{session('invalidSocial')}}
            </div>
        @endif

        <form class="form" method="post" action="/login" id="form">
            @csrf
            <!--begin::Title-->
            <div class="text-center pb-8">
                <h2 class="font-weight-bolder font-size-h2 font-size-h1-lg">Sign In</h2>
                <span class="font-weight-bold font-size-h4">Or <a href="/register"
                                                                  class="text-primary font-weight-bolder"
                                                                  id="Sb_login_signup">Create An Account</a></span>
            </div>
            <!--end::Title-->
            <form class="form" novalidate="novalidate" id="login_form">
            @csrf

            <!--begin::Form group-->
                <div class="form-group">
                    <div class="input-icon">
                        <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text"
                               name="emailOrusername" autocomplete="off" placeholder="Email"/>
                        <span><i class="far fa-user"></i></span>
                    </div>
                    <span id="validEmail" style="color: red;font-size: medium;font-size: medium;font-size: medium " role="alert">
                      <strong>{{ $errors->first('emailOrusername') }}</strong>
                </span>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group">
                    <div class="input-icon">
                        <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6"
                               type="password" name="password" autocomplete="off" placeholder="Password"/>
                        <span><i class="fas fa-unlock"></i></span>
                    </div>
                    <span id="validPassword" style="color: red;font-size: medium;font-size: medium;font-size: medium " role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group">
                    <div class="d-flex justify-content-between mt-n5">
                        <label class="checkbox mb-0 pt-5">
                            <input type="checkbox" name="remember-me"/>
                            <span class="mr-2"></span>
                            Remember Me
                        </label>
                        <a href="forgot-password"
                           class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="">
                            Forgot Password ?
                        </a>
                    </div>
                </div>
                <!--end::Form group-->


                <!--begin::Action-->
                <div class="text-center pt-2">
                    <button type="submit" class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->

        <!--begin: Aside footer for desktop-->
        <div class="text-center">
            <!-- Email login button -->
            <div>
                <button type="button" class="btn font-weight-bolder pl-20 pr-20 mt-5 font-size-h6" data-toggle="modal" data-target="#emailSignInModal">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="far fa-envelope"></i>
                                    </span>
                    Sign in with Email
                </button>
                <!-- begin:Email modal -->
                <div class="modal fade" id="emailSignInModal" tabindex="-1" role="dialog" aria-labelledby="emailSignInModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailSignInModalLabel">Add Accounts</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="input-icon">
                                        <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text" name="emailLoginName" id="emailLoginId" autocomplete="off" placeholder="Email"/>
                                        <span><i class="far fa-envelope"></i></span>
                                        <div class="error text-danger" id="emailLoginError1"></div>
                                    </div>
                                </div>
                                <!--end::Form group-->
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3" onclick="emailLogin()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:email modal -->
            </div>
            <!-- end:Email login button -->
            <!-- Facebook login button -->
            <div>

                <button type="button" class="btn bg-facebook font-weight-bolder pl-20 pr-20 mt-5 font-size-h6" onclick="location.href='{{ApiConfig::get()}}/Sociallogin?network=facebook'">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-facebook"> </i>
                                    </span>
                    Sign in with Facebook
                </button>
            </div>
            <!-- end:Facebook login button -->
            <!-- Google login button -->
            <div>
                <button type="button" class="btn bg-google font-weight-bolder pl-20 pr-20 mt-5 font-size-h6"  onclick="location.href='{{ApiConfig::get()}}/Sociallogin?network=google'">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-google"></i>
                                    </span>
                        Sign in with Google
                    </button>
                </div>
                <!-- end:Google login button -->

            <!-- Twitter login button -->
            <div>
                <button type="button" class="btn bg-twitter font-weight-bolder pl-20 pr-20 mt-5 font-size-h6" onclick="location.href='{{ApiConfig::get()}}/Sociallogin?network=twitter'">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-twitter"></i>
                                    </span>
                    Sign in with Twitter
                </button>
            </div>
            <!-- end:Twitter login button -->
            <!-- Git-hub login button -->
            <div>
                <button type="button" class="btn bg-github font-weight-bolder pl-20 pr-20 mt-5 font-size-h6" onclick="location.href='{{ApiConfig::get()}}/social/GitHub'">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-github"></i>
                                    </span>
                        Sign in with Github
                    </button>
                </div>
                <!-- end:Git-hub login button -->
            </div>
            <!--end: Aside footer for desktop-->
    </div>
    <!--end::Signin-->
@endsection

<script src="{{asset('../js/IncJsFiles/login.js')}}"></script>

