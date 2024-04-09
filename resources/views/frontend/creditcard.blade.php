@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="text-light" style=""
            data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }}) top">
            <h1>Credit Cards</h1>
        </section>
        <!-- section close -->
        <section>
            <div class="container">
                <div class="row bg-white p-3 rounded-3">
                    <div class="col-md-7 col-12 border border-2 p-3 rounded-3">
                        <h3 class="text-center">Personal Details</h3>
                        <form id="creditForm" enctype="multipart/form-data" class="bg-white">
                            <input type="hidden" id="formUrl" value="/credit-card">

                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">
                                <div class="form-group pb-3">
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter name" />
                                    <div id="name_error" class="text-danger mx-2"></div>
                                </div>

                                <div class="form-group ">
                                    <input type="text" name="card" id="card" class="form-control"
                                        placeholder="Card" hidden />
                                </div>

                                <div class="form-group pb-3">
                                    <input type="text" name="pan_num" id="pan_num" class="form-control"
                                        placeholder="Pan Number" />
                                    <div id="pan_num_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <input type="text" name="adhar_num" id="adhar_num" class="form-control"
                                        placeholder="Adhar Number" />
                                    <div id="adhar_num_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" />
                                    <div id="email_error" class="text-danger mx-2"></div>
                                </div>

                                <div class="form-group pb-3">
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                        placeholder="Mobile Number" />
                                    <div id="mobile_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <input type="text" name="annual_income" id="annual_income" class="form-control"
                                        placeholder="Net Annual Income" />
                                    <div id="annual_income_error" class="text-danger mx-2"></div>
                                </div>
                            </div>

                            <div class="tab">
                                <div class="form-group pb-3">
                                    <textarea name="residence_address" id="residence_address" cols="30" rows="2" class="form-control"
                                        placeholder="Residenece Address"></textarea>
                                    <div id="residence_address_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <textarea name="office_address" id="office_address" cols="30" rows="2" class="form-control"
                                        placeholder="Office Address"></textarea>
                                    <div id="office_address_error" class="text-danger mx-2"></div>
                                </div>

                                <div class="form-group pb-3">
                                    <label for="pan_file">Upload Pan Card</label>
                                    <input type="file" name="pan_file" class="form-control" id="pan_file"
                                        accept="application/pdf" />
                                    <div id="pan_file_error" class="text-danger mx-2"></div>
                                </div>

                                <div class="form-group pb-3">
                                    <label for="adhar_front_file">Upload Adhar Front</label>
                                    <input type="file" name="adhar_front_file" class="form-control"
                                        id="adhar_front_file" accept="image/jpeg, image/png,image/jpg" />
                                    <div id="adhar_front_file_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <label for="adhar_back_file">Upload Adhar Back</label>
                                    <input type="file" name="adhar_back_file" class="form-control"
                                        id="adhar_back_file" accept="image/jpeg, image/png,image/jpg" />
                                    <div id="adhar_back_file_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <label for="itr_file">Upload ITR(1,2 year)</label>
                                    <input type="file" name="itr_file" class="form-control" id="itr_file" />
                                    <div id="itr_file_error" class="text-danger mx-2"></div>
                                </div>
                                <div class="form-group pb-3">
                                    <label for="bank_statement_file">Upload Bank statement last 6 months</label>
                                    <input type="file" name="bank_statement_file" class="form-control"
                                        id="bank_statement_file" accept="application/pdf" />
                                    <div id="bank_statement_file_error" class="text-danger mx-2"></div>
                                </div>
                            </div>
                            <div style="overflow: auto">
                                <div style="float: right">
                                    <button class="btn btn-secondary" type="button" id="prevBtn"
                                        onclick="nextPrev(-1)">
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
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-5">
                        <img class="w-100" src="assets/images/credit card/2.png" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <div id="callusdark-container"></div>
    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection
