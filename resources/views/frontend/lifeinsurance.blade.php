@extends('frontend/layouts.main')
@section('main-section')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- section begin -->
    <section id="subheader" class="text-light" style="" data-bgimage="url(assets/images/background/subheader2.jpg) top">
        <h1>Life Insurance</h1>
    </section>
    <!-- section close -->

    <section>
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 mb30">
                    <a href="/dashboard"><div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                        <i class="bg-color text-center text-light fa-solid fa-graduation-cap"></i>
                        <div class="fb-text">
                            <h4>Child Education</h4>
                            <p>Estimate your child's graduation and post graduation costs and plan to build the required amount.</p>
                        </div>
                    </div></a>
                </div>

                <div class="col-lg-4 col-md-6 mb30">
                   <a href="/dashboard"> <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                    <i class="bg-color text-center text-light fa-solid fa-gift"></i>

                    <div class="fb-text">
                        <h4>Wedding Expenses</h4>
                        <p>The cost inflates each year. With inflation may cost 1.4 crores in 25 years.</p>
                    </div>
                </div></a>
                </div>

                <div class="col-lg-4 col-md-6 mb30">
                    <a href="/dashboard">
                        <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                            <i class="bg-color text-center text-light fa-solid fa-calendar"></i>
    
                            <div class="fb-text">
                                <h4>Milestone Planning</h4>
                                <p>Plan for any goal (eg: vacation, home ownership, wedding) with confidence.</p>
    
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb30">
                   <a href="/dashboard">
                    <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                        <i class="bg-color text-center text-light fa-solid fa-indian-rupee-sign"></i>

                        <div class="fb-text">
                            <h4>Retirement Insurance Plans</h4>
                            <p>Helps ro create a retirement corpus, so that you can retire gracefully.</p>
                            <br>
                        </div>
                    </div>
                   </a>
                </div>

                <div class="col-lg-4 col-md-6 mb30">
                  <a href="/dashboard">
                    <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                        <i class="bg-color text-center text-light fa-solid fa-money-bill-transfer"></i>

                        <div class="fb-text">
                            <h4>Money-Back Insurance Policy</h4>
                            <p>Provides periodic returns along with the benefits of life insurance cover.</p>
                        </div>
                    </div>
                  </a>
                </div>

                <div class="col-lg-4 col-md-6 mb30">
                  <a href="/dashboard">  <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                    <i class="bg-color text-center text-light fa-solid fa-money-bill-trend-up"></i>

                    <div class="fb-text">
                        <h4>Investment Plan</h4>
                        <br>
                        <p>Provide an opportunity to save and gain long-term investment returns.</p>
                    </div>
                </div></a>
                </div>

                <div>
                </div>
    </section>

    <section class="bg-color text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><span class="id-color-secondary">Call us</span> for further information. BlarkaFin customer care is here to help you <span class="id-color-secondary">anytime</span>.</h2>
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
                    <a href="#" class="btn-custom capsule med">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <div id="counts-container" data-bgcolor="#F2F6FE" data-textcolor="text-dark"></div>


</div>
<!-- content close -->

<a href="#" id="back-to-top"></a>
@endsection