@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="text-light" style=""
            data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }})" top">
            <h1>Loan</h1>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan-service">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-house"></i>
                                <div class="fb-text">
                                    <h4>Home Loan</h4>
                                    <p>Nurturing hopes, homes and happiness</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan-service">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-car"></i>
                                <div class="fb-text">
                                    <h4>Vehicle Loan</h4>
                                    <p>Get doorstep loan assistance from our associates</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan-service">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-hand-holding-dollar"></i>

                                <div class="fb-text">
                                    <h4>Personal Loan</h4>
                                    <p>Make your dreams come true with our Personal Loans</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan-service">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-building"></i>

                                <div class="fb-text">
                                    <h4>Business Loan</h4>
                                    <p>Help you manage working capital funds and business expansion</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                    </div>
        </section>

        <section class="bg-color text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2><span class="id-color-secondary">Call us</span> for further information. BlarkaFin customer care
                            is here to help you <span class="id-color-secondary">anytime</span>.</h2>
                        <p class="lead">We're available for 24 hours!</p>
                    </div>

                    <div class="col-md-6 text-lg-center text-sm-center">
                        <div class="phone-num-big">
                            <i class="fa fa-phone id-color-secondary"></i>
                            <span class="pnb-text">
                                Call Us Now
                            </span>
                            <span class="pnb-num">
                                +91-83416-83476
                            </span>
                        </div>
                        <a href="" class="btn-custom capsule med">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
        <div id="counts-container" data-bgcolor="#F2F6FE" data-textcolor="text-dark"></div>
    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection
