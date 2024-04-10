@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- MultiStep Form -->

        <!-- section begin -->
        <section id="subheader" class="text-light"
        data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }}) top">
            <h1>Loan</h1>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row bg-white p-3 rounded-3 g-0">
                    <div class="col-md-12 col-12 border border-2 p-3 rounded-3">
                        <h3 class="text-center">Loan Application</h3>
                        <form id="loanForm" enctype="multipart/form-data" class="bg-white">
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group pb-3">
                                            <input type="hidden" id="formUrl" value="/loan">

                                            <select name="loan_type" id="loan_type" class="form-control">
                                                <option value="null" selected disabled>
                                                    --Select Loan Type--
                                                </option>
                                                <option value="Home Loan">Home Loan</option>
                                                <option value="Business Loan">Business Loan</option>
                                                <option value="Personal Loan">Personal Loan</option>
                                                <option value="Vehicle Loan">Vehicle Loan</option>
                                            </select>
                                            <div id="loan_type_error" class="text-danger mx-2"></div>
                                        </div>

                                        <div class="form-group pb-3">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Name" />
                                            <div id="name_error" class="text-danger mx-2"></div>
                                        </div>

                                        <div class="form-group pb-3">
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Email" />
                                            <div id="email_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group pb-3">
                                            <div class="form-group pb-3">
                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    placeholder="Mobile Number" />
                                                <div id="mobile_error" class="text-danger mx-2"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <select name="income_source" id="income_source" class="form-control">
                                                    <option value="" selected disabled>
                                                        --Select Income Source--
                                                    </option>
                                                    <option value="salaried">Salaried</option>
                                                    <option value="business">Business</option>
                                                </select>
                                                <div id="income_source_error" class="text-danger mx-2"></div>
                                            </div>

                                            <div class="form-group pb-3">
                                                <input type="text" class="form-control" name="monthly_income"
                                                    id="monthly_income" placeholder="Monthly Income" />
                                                <div id="monthly_income_error" class="text-danger mx-2"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group pb-3">
                                            <input type="text" class="form-control" name="pincode" id="pincode"
                                                placeholder="Pincode" />
                                            <div id="pincode_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input type="text" placeholder="Date of Birth" onfocus="(this.type='date')"
                                                onblur="(this.type='text')" class="form-control" name="dob"
                                                id="dob" />
                                            <div id="dob_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input type="text" class="form-control" name="pan_num" id="pan_num"
                                                placeholder="Pancard" />
                                            <div id="pan_num_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <select name="marital_status" id="marital_status" class="form-control">
                                                <option value="null" selected disabled>--Select Martial Status--
                                                </option>
                                                <option value="married">Married</option>
                                                <option value="unmarried">Un Married</option>
                                            </select>
                                            <div id="marital_status_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group pb-3">
                                            <input type="text" class="form-control" name="adhar_num" id="adhar_num"
                                                placeholder="Adhar Card Number" />
                                            <div id="adhar_num_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input type="text" class="loan_amount form-control" name="loan_amount"
                                                id="loan_amount" placeholder="Loan Amount" />
                                            <div id="loan_amount_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input type="text" class="form-control" name="credit_score"
                                                id="credit_score" placeholder="Credit Score" />
                                            <div id="credit_score_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input type="text" class="form-control" name="mother_name"
                                                id="mother_name" placeholder="Mother's Name" />
                                            <div id="mother_name_error" class="text-danger mx-2"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Present
                                            Address</label>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group pb-3">
                                            <textarea name="present_line1" id="present_line1" class="form-control" cols="" rows=""
                                                placeholder="Address Line 1"></textarea>
                                            <div id="present_line1_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <textarea name="present_line2" id="present_line2" class="form-control" cols="" rows=""
                                                placeholder="Address Line 2"></textarea>
                                            <div id="present_line2_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group pb-3">
                                            <textarea name="present_line3" id="present_line3" class="form-control" cols="" rows=""
                                                placeholder="Address Line 3"></textarea>
                                            <div id="present_line3" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input class="form-control" type="text" name="present_landmark"
                                                id="present_landmark" type="" placeholder="Landmark">
                                            <div id="present_landmark_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group pb-3">
                                            <input class="form-control" type="text" name="present_state"
                                                id="present_state" placeholder="State">
                                            <div id="present_state_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input class="form-control" name="present_city" id="present_city"
                                                type="text" placeholder="City">
                                            <div id="present_city_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group pb-3">
                                            <input class="form-control" name="present_pincode" id="present_pincode"
                                                type="text" placeholder="Pincode">
                                            <div id="present_pincode_error" class="text-danger mx-2"></div>
                                        </div>
                                        <div class="form-group pb-3">
                                            <input class="form-control" name="present_phone" id="present_phone"
                                                type="number" placeholder="Phone Number">
                                            <div id="present_phone_error" class="text-danger mx-2"></div>
                                        </div>
                                    </div>
                                    <div id="show_permanent_address" class="row"></div>
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <label for=""
                                                class="text-left text-[#2A2C5D] font-bold text-1xl">Office Address</label>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group pb-3">
                                                <textarea name="office_line1" id="office_line1" class="form-control" cols="" rows=""
                                                    placeholder="Address Line 1"></textarea>
                                                <div id="office_line1_error" class="text-danger mx-2"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <textarea name="office_line2" id="office_line2" class="form-control" cols="" rows=""
                                                    placeholder="Address Line 2"></textarea>
                                                <div id="office_line2_error" class="text-danger mx-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group pb-3">
                                                <textarea name="office_line3" id="office_line3" class="form-control" cols="" rows=""
                                                    placeholder="Address Line 3"></textarea>
                                                <div id="office_line3" class="text-danger mx-2"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <input class="form-control" type="text" name="office_landmark"
                                                    id="office_landmark" type="" placeholder="Landmark">
                                                <div id="office_landmark_error" class="text-danger mx-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group pb-3">
                                                <input class="form-control" type="text" name="office_state"
                                                    id="office_state" placeholder="State">
                                                <div id="office_state_error" class="text-danger mx-2"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <input class="form-control" name="office_city" id="office_city"
                                                    type="text" placeholder="City">
                                                <div id="office_city_error" class="text-danger mx-2"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-3">
                                            <div class="form-group pb-3">
                                                <input class="form-control" name="office_pincode" id="office_pincode"
                                                    type="text" placeholder="Pincode">
                                                <div id="office_pincode_error" class="text-danger mx-2"></div>
                                            </div>
                                            <div class="form-group pb-3">
                                                <input class="form-control" name="office_phone" id="office_phone"
                                                    type="number" placeholder="Phone Number">
                                                <div id="office_phone_error" class="text-danger mx-2"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="tab">
                                <div class="row">
                                    <div class="flex justify-center items-center bg-gray-200 h-screen">
                                        <div class="w-96 p-4 shadow rounded-md bg-white">
                                            <select name="document_type" id="document_type">
                                                <option value="" selected disabled>--Select Document--</option>
                                                <option value="pancard">Pancard</option>
                                                <option value="adhar_front">Adhar Card Front</option>
                                                <option value="adhar_back">Adhar Card Back</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <div class="mt-4">
                                                <label for="upload_document" class="block text-gray-600">Upload
                                                    Document</label>
                                                <input type="file" name="upload_document" id="upload_document"
                                                    class="mt-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div style="overflow: auto " class="mt-4">
                        <div style="float: right">
                            <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">
                                Previous
                            </button>
                            <button class="btn btn-primary" type="submit" id="nextBtn" class="submit-btn"
                                onclick="nextPrev(1)">
                                Next
                            </button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align: center; margin-top: 40px">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    </section>


    <section class="bg-color text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        <span class="id-color-secondary">Call us</span> for further
                        information. BlarkaFin customer care is here to help you
                        <span class="id-color-secondary">anytime</span>.
                    </h2>
                    <p class="lead">We're available for 24 hours!</p>
                </div>

                <div class="col-md-6 text-lg-center text-sm-center">
                    <div class="phone-num-big">
                        <i class="fa fa-phone id-color-secondary"></i>
                        <span class="pnb-text"> Call Us Now </span>
                        <span class="pnb-num"> +91-8341683476 </span>
                    </div>
                    <a href="#" class="btn-custom capsule med">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <section id="section-fun-facts" class="pt60 pb60" data-bgcolor="#F2F6FE">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay="0s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="4500" data-speed="3000">0</span>
                        </h3>
                        <h5 class="id-color">Home Protected</h5>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay=".25s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="16" data-speed="3000">0</span>k
                        </h3>
                        <h5 class="id-color">People Saved</h5>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay=".4s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="4" data-speed="3000">0</span>m
                        </h3>
                        <h5 class="id-color">Money Saved</h5>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay=".6s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="52" data-speed="3000">0</span>k
                        </h3>
                        <h5 class="id-color">Contract Signed</h5>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay=".8s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="100" data-speed="3000">0</span>+
                        </h3>
                        <h5 class="id-color">Countries</h5>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30" data-wow-delay="1s">
                    <div class="de_count">
                        <h3>
                            <span class="timer" data-to="2" data-speed="3000">2</span>k
                        </h3>
                        <h5 class="id-color">Staff Member</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection
