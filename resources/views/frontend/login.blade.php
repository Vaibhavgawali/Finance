@extends('frontend/layouts.main')
@section('main-section')
    <!-- section close -->
    <section id="subheader" class="text-light" data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }}) top">
        <div class="info-register pb-5">
            <div class="container w-100 mt-200 ">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>User Login</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section aria-label="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form name="login_form" id="login_form" class="form-border">
                        <h3>Login to your account</h3>

                        <div class="field-set">
                            <label>Email </label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter Email" />
                            <div id="email_error"></div>
                        </div>


                        <div class="field-set">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter Password" />
                            <div id="password_error"></div>
                        </div>


                        <div id="submit">
                            <input type="submit" id="login_btn" value="Login" class="btn btn-custom color-2" />
                            <div class="clearfix"></div>
                            <div class="spacer-single"></div>
                            <ul class="list s3">
                                <li>Don't have an account ?</li>
                                <li>
                                    {{-- <a class="mx-1" href="/register">Register</a>| --}}
                                </li>
                                <li><a class="mx-1" href="/password/reset">Forgot Password ?</a> |</li>
                                <li><a href="/">Home</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <script></script>
        <!-- Info Section End -->
    @endsection
