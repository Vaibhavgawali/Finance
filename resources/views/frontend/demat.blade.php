@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="text-light" style=""
            data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }}) top">
            <h1>Demat Account</h1>
        </section>
        <!-- section close -->
        <section>
            <div class="container">
                <div class="row bg-white p-3 rounded-3">
                    <div class="col-md-7 col-12 border border-2 p-3 rounded-3">
                        <h3 class="text-center">Personal Details</h3>
                        <form id="dematForm" action="" class="bg-white">
                            <div class="form-group pb-3">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter name" />
                                <div id="name_error" class="text-danger mx-2"></div>
                            </div>
                            <div class="form-group pb-3">
                                <input type="text" name="pan_num" id="pan_num" class="form-control"
                                    placeholder="Pan Number" />
                                <div id="pan_num_error" class="text-danger mx-2"></div>
                            </div>
                            <div class="form-group pb-3">
                                <input type="text" name="adhar_num" id="adhar_num" class="form-control"
                                    placeholder="Aadhar Number" />
                                <div id="adhar_num_error" class="text-danger mx-2"></div>
                            </div>
                            <div class="form-group pb-3">
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Mobile Number" />
                                <div id="phone_error" class="text-danger mx-2"></div>
                            </div>
                            <div class="form-group pb-3">
                                <select name="bank" id="bank" class="form-control" id="bank">
                                    <option value="" selected disabled>--Select Bank--</option>
                                    <option value="icici">ICICI</option>
                                    <option value="hdfc">HDFC</option>
                                </select>
                                <div id="bank_error" class="text-danger mx-2"></div>
                            </div>

                            <button type="submit" id="demat_btn" class="btn btn-primary">Apply</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-5">
                        <img class="w-100" src="{{ asset('assets/images/demat/demataccount.jpeg') }}" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <div id="callusdark-container"></div>
    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection
