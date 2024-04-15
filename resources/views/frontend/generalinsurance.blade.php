@extends('frontend/layouts.main')
@section('main-section')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- section begin -->
    <section id="subheader" class="text-light" style="" data-bgimage="url(assets/images/background/subheader2.jpg) top">
        <h1>General Insurance</h1>
    </section>
    <!-- section close -->
    <!-- section close -->

    <section>
        <div class="container">
            <div class="row">


                <div class="col-lg-4 col-md-6 mb30">
                    <a href="/dashboard">
                        <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                            <i class="bg-color text-center text-light fa-solid fa-motorcycle"></i>
                            <div class="fb-text">
                                <h4>Bike Insurance</h4>
                                <p>Discover our bike insurance plans tailored to provide comprehensive coverage for your ride.</p>
                                <br>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="/dashboard">
                        <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                            <i class="bg-color text-center text-light fa-solid fa-car"></i>
                            <div class="fb-text">
                                <h4>Car Insurance</h4>
                                <p>Explore our car insurance plans designed to provide comprehensive coverage for your vehicle.</p>
                                <br>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="/dashboard">
                        <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                            <i class="bg-color text-center text-light fa-solid fa-truck"></i>
                            <div class="fb-text">
                                <h4>Commercial Vechile Insurance</h4>
                                <p>Discover our Commercial Vehicle Insurance plans.</p>
                                <br>
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