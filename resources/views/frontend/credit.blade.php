@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="text-light" style=""
            data-bgimage="url(assets/images/background/subheader2.jpg) top">
            <h1>Credit Cards</h1>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=HDFC Bank">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center "><img style=""
                                        src="assets/images/services-logos/1.jpg" alt=""></i>
                                <div class="fb-text">
                                    <h4>HDFC Credit Card</h4>
                                    <p>Apply for Credit Card Online at HDFC Bank &amp; enjoy Exclusive Benefits.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=IDFC Bank">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class=" bg-color text-light"> <img src="assets/images/services-logos/2.jpg"
                                        alt=""></i></i>
                                <div class="fb-text ">
                                    <h4>IDFC Credit Card</h4>
                                    <p>Lifetime free credit card by IDFC First Bank.</p>
                                    <br>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=IndusInd Bank">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class=" bg-color text-light"><img src="assets/images/services-logos/3.jpg"
                                        alt=""></i></i>
                                <div class="fb-text">
                                    <h4>IndusInd Credit Card</h4>
                                    <p>Get an instant credit card with IndusInd Bank in 3 easy steps. </p>
                                    <br>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=Bajaj RBL SuperCard">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-light">
                                    <img src="assets/images/services-logos/4.jpg" alt=""></i>
                                </i>
                                <div class="fb-text">
                                    <h4>Bajaj RBL SuperCard</h4>
                                    <p> Get power of 4 cards in 1 card</p>
                                    <br>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=SBI Bank">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-light">
                                    <img src="assets/images/services-logos/5.jpg" alt=""></i>
                                </i>
                                <div class="fb-text">
                                    <h4>SBI Credit Card</h4>
                                    <p>Sell SBI Simply Save Credit Card</p>
                                    <br>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/creditcard?creditcard=AU Bank">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-light">
                                    <img src="assets/images/services-logos/6.jpg" alt=""></i>
                                </i>
                                <div class="fb-text">
                                    <h4>AU Credit Card</h4>
                                    <p>Live limitless with AU Small Finance Bank Credit Card.</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                    </div>
        </section>

        <div id="callusdark-container"></div>
    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection
