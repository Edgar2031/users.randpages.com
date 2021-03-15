<head>
    @include('user::Layouts._common_script_links')
</head>
@extends('user::Layouts._master')
@section('title')
    <title>{{env('WEBSITE_TITLE')}} | SignUp</title>
@endsection
@section('main-content')
    <!--begin::Signup-->
    <div class="login-form pt-2">
        <!--begin::Form-->

        <!--begin::Title-->
        <div class="text-center pb-8">
            <h2 class="font-weight-bolder font-size-h2 font-size-h1-lg">Sign Up</h2>
            <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
        </div>
        <!--end::Title-->
        <form id="signup_form">
        @csrf
        <!--begin::Form group-->
            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text"
                           value="{{ old('firstName') }}" placeholder="First name" name="firstName" id="firstName"
                           autocomplete="off"/>
                    <span><i class="far fa-user"></i></span>
                </div>
                <div id="firstNameError" style="font-size: medium"></div>
                <span id="validFirstName" style="color: red;font-size: medium;font-size: medium;font-size: medium " role="alert">
                      <strong>{{ $errors->first('firstName') }}</strong>
                </span>
            </div>
            <!--end::Form group-->

            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text"
                           value="{{ old('lastname') }}" placeholder="Last Name" name="lastname" id="lastname"
                           autocomplete="off"/>
                    <span><i class="far fa-user"></i></span>
                </div>
                <div id="lastNameError" style="font-size: medium"></div>
                <span id="validLastName" style="color: red;font-size: medium" role="alert">
                      <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            </div>

            <!--begin::Form group-->
            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text"
                           placeholder="Username" name="username" id="username" value="{{ old('username') }}"
                           autocomplete="off"/>
                    <span><i class="far fa-user"></i></span>
                </div>
                <div id="usernameError" style="font-size: medium"></div>
                <span id="validUsername" style="color: red;font-size: medium" role="alert">
                      <strong>{{ $errors->first('username') }}</strong>
                </span>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="text"
                           id="email" value="{{old('email')}}" placeholder="Email" name="email" autocomplete="off"/>
                    <span><i class="far fa-envelope-open"></i></span>
                </div>
                <div id="emailField" style="font-size: medium"></div>
                <span id="validEmail" style="color: red;font-size: medium" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                </span>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="password"
                           placeholder="Password" name="password" id="password" value="{{old('password')}}"
                           autocomplete="off"/>
                    <span><i class="fas fa-unlock"></i></span>

                </div>
                <span id='message' style="font-size: medium"></span>
                <span id="validPassword" style="color: red;font-size: medium" role="alert">
                </span>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group">
                <div class="input-icon">
                    <input class="form-control form-control-solid h-auto py-7 rounded-lg font-size-h6" type="password"
                           placeholder="Confirm password" name="password_confirmation" id="password_confirmation"
                           value="{{ old('password_confirmation') }}" autocomplete="off"/>
                    <span><i class="fas fa-unlock"></i></span>
                </div>
                <div id="conf_password" style="font-size: medium"></div>
                <span id="validConfirmPassword" style="color: red;font-size: medium" role="alert">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group">
                <label class="checkbox mb-0">
                    <input type="checkbox" name="agree"/>
                    <span class="mr-2"></span>
                    I Agree the &nbsp;<a href="#" class="text-primary"> terms and conditions</a>.
                </label>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group d-flex flex-wrap flex-center">
                <button type="submit" id="submit" class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">
                    Submit
                </button>
                <button type="button" id="Sb_login_signup_cancel"
                        class="btn font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel
                </button>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
    </div>

    <!--begin: Aside footer for desktop-->
    <div class="text-center">
        <!-- Facebook login button -->
        <div>
            <button type="button" class="btn bg-facebook font-weight-bolder pl-20 pr-20 mt-5 font-size-h6">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-facebook"></i>
                                    </span>
                Sign in with Facebook
            </button>
        </div>
        <!-- end:Facebook login button -->
        <!-- Google login button -->
        <div>
            <button type="button" class="btn bg-google font-weight-bolder pl-20 pr-20 mt-5 font-size-h6">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-google"></i>
                                    </span>
                Sign in with Google
            </button>
        </div>
        <!-- end:Google login button -->

        <!-- Twitter login button -->
        <div>
            <button type="button" class="btn bg-twitter font-weight-bolder pl-20 pr-20 mt-5 font-size-h6">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-twitter"></i>
                                    </span>
                Sign in with Twitter
            </button>
        </div>
        <!-- end:Twitter login button -->
        <!-- Git-hub login button -->
        <div>
            <button type="button" class="btn bg-github font-weight-bolder pl-20 pr-20 mt-5 font-size-h6">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="fab fa-github"></i>
                                    </span>
                Sign in with Github
            </button>
        </div>
        <!-- end:Git-hub login button -->
    </div>
    <!--end: Aside footer for desktop-->

    <!--end::Signup-->
@endsection
@section('footer-content')
    <!-- begin:Signin -->
    <div class="text-center pt-2">
        <span class="font-weight-bold font-size-h4">Already have an account? <a href="/login"
                                                                                class="text-primary font-weight-bolder"
                                                                                id="">Sign In</a></span>
    </div>
    <!-- end:Signin -->
@endsection

<script>


    $(document).ready(function () {

        //checking First name is valid or not
        $('#firstName').on('keyup', function () {
            $('#validFirstName').hide()
            $regex = /^[a-zA-Z]*$/
            if ($regex.test($('#firstName').val()) && ($('#firstName').val().length) >= 3) {
                $('#firstNameError').html('✅ Valid first Name').css('color', 'green')
            } else {
                $('#firstNameError').html('❌ Invalid first Name(first name should not contain numeric and spaces)').css('color', 'red')
            }
        });

        //Checking last name valid or not
        $('#lastname').on('keyup', function () {
            $('#validLastName').hide()
            $regex = /^[a-zA-Z]*$/
            if ($regex.test($('#lastname').val()) && ($('#lastname').val().length) >= 3) {
                $('#lastNameError').html('✅ Valid').css('color', 'green')
            } else {
                $('#lastNameError').html('❌ Invalid (last name should not contain numeric and spaces)').css('color', 'red')
            }
        });


        //Checking UserName is available or not
        $('#username').on('keyup', function () {
            $('#validUsername').hide()
            $regex = /^[a-zA-Z0-9-_]{3,32}$/
            if ($regex.test($('#username').val())) {
                $.ajax({
                    url: 'http://localhost:5000/v1/checkUserNameAvailability?usernanme=' + $('#username').val(),
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response['code'] == 200) {
                            $('#usernameError').html('✅ Valid username').css('color', 'green')
                        }
                        if (response['code'] == 400) {
                            $('#usernameError').html('❌ Already used.').css('color', 'red');
                        }
                    },
                    error: function (error) {
                        $('#usernameError').html(error).css('color', 'red');
                    }
                });
            } else {
                $('#usernameError').html('❌ Invalid Username((Should contain minimum 3 charecters)').css('color', 'red')
            }
        });

        $('#email').on('keyup', function () {
            $('#validEmail').hide();
            $regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
            if ($regex.test($('#email').val())) {
                $.ajax({
                    url: 'https://user.ems.globusdemos.com/v1/checkEmailAvailability?email=' + $('#email').val(),
                    type: 'GET',
                    success: function (response) {
                        console.log(response)
                        if (response['code'] == 200) {
                            $('#emailField').html('✅ Valid Email').css('color', 'green');
                        }
                        if (response['code'] == 400) {
                            $('#emailField').html('❌ Already used (or) Not valid.').css('color', 'red');
                        }
                    },
                    error: function (error) {
                        $('#emailField').html(error).css('color', 'red');
                    }
                });

            } else {
                $('#emailField').html('❌ Invalid Email format').css('color', 'red')
            }
        });

        $("#password").on('keyup', function () {
            $('#validPassword').hide()
            $regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&-/])[A-Za-z\d@$!%*?&-/]{8,}$/
            if ($regex.test($('#password').val())) {
                $('#message').html('👌 Valid password').css('color', 'green');
            } else {
                $('#message').html('❌ Invalid password pattern(minimum 8 charecters, 1 upper case, 1 lower case, 1 special charecter, 1 numeric)').css('color', 'red');
            }
        });

        $("#password_confirmation").on('keyup', function () {
            if ($('#password_confirmation').val() == $('#password').val() && $('#password_confirmation').val().length != 0) {
                $('#conf_password').html('✅ Matching').css('color', 'green');
            } else {
                $('#conf_password').html('❌ Not Matching(Confirm Password Should match Password)').css('color', 'red');
            }
        });

        $(document).on('submit', '#signup_form', function (e) {
            e.preventDefault();
            var form = document.getElementById('signup_form');
            var formData = new FormData(form);
            $.ajax({
                url: "/register",
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response['firstName'] !== undefined) document.getElementById('validFirstName').innerHTML = response['firstName'];
                    if (response['lastname'] !== undefined) document.getElementById('validLastName').innerHTML = response['lastname'];
                    if (response['username'] !== undefined) document.getElementById('validUsername').innerHTML = response['username'];
                    if (response['email'] !== undefined) document.getElementById('validEmail').innerHTML = response['email'];
                    if (response['password'] !== undefined) document.getElementById('validPassword').innerHTML = response['password'];
                    if (response['password_confirmation'] !== undefined) document.getElementById('validConfirmPassword').innerHTML = response['password_confirmation'];

                    if (response['code'] == 200) {
                        document.getElementById("signup_form").reset();
                        $("#firstNameError").empty();
                        $("#lastNameError").empty();
                        $("#usernameError").empty();
                        $("#emailField").empty();
                        $("#message").empty();
                        $("#conf_password").empty();
                        toastr.success(response.message, "Registered Successfully!");
                        setTimeout(function () {
                            window.location = '/login';
                        }, 1000);
                    } else if (response['code'] == 400) {
                        toastr.error(response.message, "Registration failed!!");
                    } else if(response.code == 500){
                        toastr.error(response.message, "Registration failed!!");
                    } else if (response['error']) {
                        toastr.error(response.error, "Oopss!!!");
                    }else{
                        if (response['password'] !== undefined) document.getElementById('validPassword').innerHTML = response['password'];
                    }
                },
                error: function (error) {
                    toastr.error(error['message'], "ss");
                }
            })
        })
    })
</script>
