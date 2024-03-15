@extends('frontend/layouts.main')
@section('main-section')
<div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section
          id="subheader"
          class="text-light"
          style=""
          data-bgimage="url(assets/images/background/subheader2.jpg) top"
        >
          <h1>Credit Cards</h1>
        </section>
        <!-- section close -->
        <section >
          <div class="container">
            <div class="row bg-white p-3 rounded-3">
              <div class="col-md-7 col-12 border border-2 p-3 rounded-3">
                <h3 class="text-center">Personal Details</h3>
                <form id="creditForm" action="" class="bg-white">
                  <!-- One "tab" for each step in the form: -->
                  <div class="tab">
                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        placeholder="Enter name"
                      />
                      <div id="name_error" class="text-danger mx-2"></div>
                    </div>

                    <div class="form-group ">
                      <input
                        type="text"
                        name="card"
                        id="card"
                        class="form-control"
                        placeholder="Card"
                        hidden/>
                    </div>

                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="pancard"
                        id="pancard"
                        class="form-control"
                        placeholder="Pancard"
                      />
                      <div id="pancard_error" class="text-danger mx-2"></div>
                    </div>
                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="adharcard"
                        id="adharcard"
                        class="form-control"
                        placeholder="Adharcard"
                      />
                      <div id="adharcard_error" class="text-danger mx-2"></div>
                    </div>
                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="Email"
                      />
                      <div id="email_error" class="text-danger mx-2"></div>
                    </div>

                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        placeholder="Mobile Number"
                      />
                      <div id="phone_error" class="text-danger mx-2"></div>
                    </div>
                    <div class="form-group pb-3">
                      <input
                        type="text"
                        name="income"
                        id="income"
                        class="form-control"
                        placeholder="Net Annual Income"
                      />
                      <div id="income_error" class="text-danger mx-2"></div>
                    </div>
                  </div>

                  <div class="tab">
                    <div class="form-group pb-3">
                      <textarea
                        name="address1"
                        id="address1"
                        cols="30"
                        rows="2"
                        class="form-control"
                        placeholder="Residenece Address"
                      ></textarea>
                      <div id="address1_error" class="text-danger mx-2"></div>
                    </div>
                    <div class="form-group pb-3">
                      <textarea
                        name="address2"
                        id="address2"
                        cols="30"
                        rows="2"
                        class="form-control"
                        placeholder="Office Address"
                      ></textarea>
                      <div id="address2_error" class="text-danger mx-2"></div>
                    </div>
                    <!-- <div class="form-group pb-3">
                      <input
                        type="text"
                        name="officialemail"
                        id="officialemail"
                        class="form-control"
                        placeholder="Email"
                      />
                      <div
                        id="officialemail_error"
                        class="text-danger mx-2"
                      ></div>
                    </div> -->

                    <div class="form-group pb-3">
                      <label for="pancardupload">Upload Pan Card</label>
                      <input
                        type="file"
                        name="pancardupload"
                        class="form-control"
                        id="pancardupload"
                      />
                      <div
                        id="pancardupload_error"
                        class="text-danger mx-2"
                      ></div>
                    </div>

                    <div class="form-group pb-3">
                        <label for="pancardupload">Upload Adhar Front</label>
                        <input
                          type="file"
                          name="adharfrontupload"
                          class="form-control"
                          id="adharfrontupload"
                        />
                        <div
                          id="adharfrontupload_error"
                          class="text-danger mx-2"
                        ></div>
                      </div>
                      <div class="form-group pb-3">
                        <label for="adharbackupload">Upload Adhar Back</label>
                        <input
                          type="file"
                          name="adharbackupload"
                          class="form-control"
                          id="adharbackupload"
                        />
                        <div
                          id="adharbackupload_error"
                          class="text-danger mx-2"
                        ></div>
                      </div>
                      <div class="form-group pb-3">
                        <label for="itrupload">Upload ITR(1,2 year)</label>
                        <input
                          type="file"
                          name="itrupload"
                          class="form-control"
                          id="itrupload"
                        />
                        <div
                          id="itrupload_error"
                          class="text-danger mx-2"
                        ></div>
                      </div>
                      <div class="form-group pb-3">
                        <label for="statementupload">Upload Bank statement last 6 months</label>
                        <input
                          type="file"
                          name="statementupload"
                          class="form-control"
                          id="statementupload"
                        />
                        <div
                          id="statementupload_error"
                          class="text-danger mx-2"
                        ></div>
                      </div>
                  </div>
                  <div style="overflow: auto">
                    <div style="float: right">
                      <button
                        class="btn btn-secondary"
                        type="button"
                        id="prevBtn"
                        onclick="nextPrev(-1)"
                      >
                        Previous
                      </button>
                      <button
                        class="btn btn-primary"
                        type="submit"
                        id="nextBtn"
                        class="submit-btn"
                        onclick="nextPrev(1)"
                      >
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
              <div class="col-12 col-md-5" >
                <img
                  class="w-100"
                  src="assets/images/credit card/2.png"
                  alt=""
                />
              </div>
            </div>
          </div>
        </section>
        <div id="callusdark-container"></div>
      </div>
      <!-- content close -->

      <a href="#" id="back-to-top"></a>
@endsection