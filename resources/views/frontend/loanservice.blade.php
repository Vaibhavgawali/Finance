@extends('frontend/layouts.main')
@section('main-section')
<div class="no-bottom no-top" id="content">
        
        <div id="top"></div>
        <!-- MultiStep Form -->
        <!-- section begin -->
        <section
          id="subheader"
          class="text-light"
          data-bgimage="url(assets/images/background/subheader2.jpg) top"
        >
          <h1>Loan</h1>
        </section>
        <!-- section close -->
        <section>
          <div class="container">
            <div class="row bg-white p-3 rounded-3 g-0">
              <div class="col-md-12 col-12 border border-2 p-3 rounded-3">
                <h3 class="text-center">Loan Application</h3>
                <form id="creditForm" action="" class="bg-white">
                  <!-- One "tab" for each step in the form: -->
                  <div class="tab">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group pb-3">
                          <select name="loan" id="loan" class="form-control">
                            <option value="null" selected disabled>
                              --Select Loan Type--
                            </option>
                            <option value="Home Loan">Home Loan</option>
                            <option value="Business Loan">Business Loan</option>
                            <option value="Personal Loan">Personal Loan</option>
                            <option value="Vehicle Loan">Vehicle Loan</option>
                          </select>
                          <div id="loan_error" class="text-danger mx-2"></div>
                        </div>

                        <div class="form-group pb-3">
                          <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Name"
                          />
                          <div id="name_error" class="text-danger mx-2"></div>
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
                      </div>

                      <div class="col-md-6">
                        <div class="form-group pb-3">
                          <div class="form-group pb-3">
                            <input
                              type="text"
                              name="phone"
                              id="phone"
                              class="form-control"
                              placeholder="Mobile Number"
                            />
                            <div
                              id="phone_error"
                              class="text-danger mx-2"
                            ></div>
                          </div>
                          <div class="form-group pb-3">
                            <select
                              name="income_source"
                              id="income_source"
                              class="form-control"
                            >
                              <option value="" selected disabled>
                                --Select Income Source--
                              </option>
                              <option value="salaried">Salaried</option>
                              <option value="business">Business</option>
                            </select>
                            <div
                              id="income_source_error"
                              class="text-danger mx-2"
                            ></div>
                          </div>

                          <div class="form-group pb-3">
                            <input
                              type="text"
                              class="form-control"
                              name="monthly_income"
                              id="monthly_income"
                              placeholder="Monthly Income"
                            />
                            <div
                              id="monthly_income_error"
                              class="text-danger mx-2"
                            ></div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="form-control"
                            name="pincode"
                            id="pincode"
                            placeholder="Pincode"
                          />
                          <div
                            id="pincode_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            placeholder="Date of Birth"
                            onfocus="(this.type='date')"
                            onblur="(this.type='text')"
                            class="form-control"
                            name="date_of_birth"
                            id="date_of_birth"
                          />
                          <div
                            id="date_of_birth_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="form-control"
                            name="pancard"
                            id="pancard"
                            placeholder="Pancard"
                          />
                          <div
                            id="pancard_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <select name="martial_status" id="martial_status" class="form-control">
                            <option value="null" selected disabled>Martial Status</option>
                            <option value="married">Married</option>
                            <option value="unmarried">Un Married</option>
                          </select>
                          <div
                            id="martial_status_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="form-control"
                            name="adharcard"
                            id="adharcard"
                            placeholder="Adhar Card Number"
                          />
                          <div
                            id="adharcard_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="loan_amount form-control"
                            name="loan_amount"
                            id="loan_amount"
                            placeholder="Loan Amount"
                          />
                          <div
                            id="loan_amount_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="form-control"
                            name="credit_score"
                            id="credit_score"
                            placeholder="Credit Score"
                          />
                          <div
                            id="credit_score_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        <div class="form-group pb-3">
                          <input
                            type="text"
                            class="form-control"
                            name="mother_name"
                            id="mother_name"
                            placeholder="Mother's Name"
                          />
                          <div
                            id="mother_name_error"
                            class="text-danger mx-2"
                          ></div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
<!-- 
                  <div class="tab">
                   <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <select name="gender" id="gender" class="form-control">
                          <option value="null" selected disabled>--Select Gender--</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="other">Other</option>
                        </select>
                        <div id="gender_error" class="text-danger mx-2"></div>
                      </div>
                      

                    </div>


                    <div class="col-md-6 col-lg-3">
                      
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type="text"
                          placeholder="Name of Father / Husband"
                        />
                        <div id="gender_error" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type="text"
                          placeholder="Mother's Maiden Name"
                        />
                        <div id="gender_error" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Marital Status</option>
                          <option value="male">Married</option>
                          <option value="female">Unmarried</option>
                        </select>
                        <div id="gender_error" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Religion</option>
                          <option value="">Hindu</option>
                          <option value="">Muslim</option>
                          <option value="">Christain</option>
                          <option value="">Sikh</option>
                          <option value="">Buddhist</option>
                          <option value="">Jain</option>
                          <option value="">Other</option>
                        </select>
                        <div id="gender_error" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-12 mb-1">
                      <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Educational & Professional Details</label>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>
                            Educational Qualification
                          </option>
                          <option value="">Post-Graguate</option>
                          <option value="">Diploma-Holder</option>
                          <option value="">Graguate</option>
                          <option value="">Under-Graguate</option>
                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Trade Nature</option>
                          <option value="">Automobile</option>
                          <option value="">Airlines</option>
                          <option value="">Banks/NBFC</option>
                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type=""
                          placeholder="Annual Turn over For Second year"
                        />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Company Type</option>
                          <option value="">Publick Limited</option>
                          <option value="">Pvt.limited</option>
                          <option value="">LLP</option>
                          <option value="">MNC</option>
                          <option value="">PSU</option>
                          <option value="">GOVT</option>
                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="Company Pan Card No" />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type=""
                          placeholder="Annual Turn over For Third year"
                        />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type="date"
                          placeholder="Date of incorporation"
                        />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="MSME" />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Bank Account</option>
                          <option value="">Allahabad Bank</option>
                          <option value="">Andhra Bank</option>
                          <option value="">Bank of Baroda</option>
                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type=""
                          placeholder="Number of Years in Current Organization"
                        />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input
                          class="form-control"
                          type=""
                          placeholder="Annual Turn over For First year"
                        />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>

                    <div class="col-12 mb-1">
                      <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Bank Account Details</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <input type="text" class="form-control" placeholder="Bank Name">
                      <div id="" class="text-danger mx-2"></div>
                    </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="Bank Branch" />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Account Type</option>
                          <option value="">Seving</option>
                          <option value="">Current</option>
                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-12 mb-1">
                      <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Loan Details</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="Household Members" />
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>EMI toward Other Loan</option>
                          <option value="">Yes</option>
                          <option value="">No</option>
                        </select>
                        <div id="" class="text-danger mx-2">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="form-group pb-3">
                        <select name="" id="" class="form-control">
                          <option value="null" selected disabled>Loan Tenure(Months)</option>
                          <option value="">12</option>
                          <option value="">24</option>
                          <option value="">36</option>
                          <option value="">24</option>
                          <option value="">48</option>
                          <option value="">60</option>
                          <option value="">72</option>
                          <option value="">84</option>
                          <option value="">96</option>
                          <option value="">108</option>
                          <option value="">120</option>
                          <option value="">132</option>
                          <option value="">144</option>
                          <option value="">156</option>
                          <option value="">168</option>

                        </select>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                   </div>
                  
                  </div> -->

                  <div class="tab">
                 <div class="row">
                  <!-- <div class="col-md-6 col-lg-3">
                    <div class="form-group pb-3">
                      <select
                        name="gender"
                        id="gender"
                        class="form-control"
                      >
                        <option value="null" selected disabled>
                          Residential Status
                        </option>
                        <option value="">Resident</option>
                        <option value="">NRI</option>
              
                      </select>
                      <div id="" class="text-danger mx-2"></div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="form-group pb-3">
                      <select
                        name="gender"
                        id="gender"
                        class="form-control"
                      >
                        <option value="null" selected disabled>
                          No.of year at Residence
                        </option>
                        <option value="">1 to 5 year</option>
                        <option value="">6 to 10 year</option>
                        <option value="">11 to 15 year</option>
                        <option value="">16 to 25 year</option>
                        <option value="">More than 25 Years</option>
                        
              
                      </select>
                      <div id="" class="text-danger mx-2"></div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="form-group pb-3">
                      <select name="" id="" class="form-control">
                        <option value="null" selected disabled>--Select Residential Type--</option>
                        <option value="">Self Owned</option>
                        <option value="">Rented /Company Provided</option>
                        <option value="">PG</option>
                        <option value="">With parents</option>
                        <option value="">With relatives</option>
                        <option value="">Lease</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="form-group pb-3">
                      <input type="text" class="form-control" placeholder="Monthly Rent">
                    </div>
                  </div> -->
                  <div class="col-12 mb-1">
                    <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Present Address</label>
                  </div>
                 
                  <!-- <div class="col-12 mb-1">
                    <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Permanent Address</label>
                    <div class="form-check 
                    ">
                      <input class="form-check-input " type="checkbox" name="Permanent" id="flexRadioDefault1">
                      <label class="form-check-label " for="flexRadioDefault1">
                         Same as present address
                      </label>
                    </div>
                  </div> -->
                  <div id="show_permanent_address" class="row"></div>
                  <div class="row">
                    <div class="col-12 mb-1">
                      <label for="" class="text-left text-[#2A2C5D] font-bold text-1xl">Office Address</label>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <textarea name="" id="" class="form-control" cols="" rows="" placeholder="Address Line 1"></textarea>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <textarea name="" id=""  class="form-control" cols="" rows="" placeholder="Address Line 2"></textarea>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <textarea name="" id=""  class="form-control" cols="" rows="" placeholder="Address Line 3"></textarea>
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="Landmark">
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="State">
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="City">
                        <div id="" class="text-danger mx-2"></div>
                      </div>
  
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group pb-3">
                        <input class="form-control" type="" placeholder="Pincode">
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                      <div class="form-group pb-3">
                        <input class="form-control" type="number" placeholder="Phone Number">
                        <div id="" class="text-danger mx-2"></div>
                      </div>
                    </div>
                  </div>
                  
                 </div>

                    </div>

                    <div class="tab">
                      <div class="row">
                        <div
                        class="flex top-9 justify-center items-center text-[14px] font-sans bg-[#dfe3f2] h-screen"
                      >
                        <div
                          id="imageForm"
                          class="cardDiv w-[400px] h-auto p-4 shadow-[0 0 5px rgba(0,0,0,1.0)] rounded-md overflow-hidden bg-[#fafbff]"
                        >
                          <div class="topdiv flex justify-between items-center w-full">
                            <p class="text-[0.9rem] font-semibold text-slate-400">
                              <select name="documents_name" id="documents_name">
                                <option value="" selected disabled>--Select Documents--</option>
                                <option value="">Pancard</option>
                                <option value="adhar_card_doc">Adhar Card Front</option>
                                <option value="adhar_card_doc">Adhar Card Back</option>
                                <option value="">3 Year ITR </option>
                                <option value="">1 Year Bank Statement</option>
                                <option value="">Ownership Proof Residence</option>
                                <option value="">Certificate of Incorporation</option>
                                <option value="">GST Certificate/ MSME Certificate</option>
                                <option value="">GST Return(Last 1 year)</option>
                                <option value="">Office Address Proof</option>
                                <option value="">MOA/AOA/MS</option>
                                <option value="">Trade License</option>
                                <option value="">Photo </option>
                                <option value="">Other</option>
                              </select>
                            </p>
                            <button
                              type="submit"
                              id="documents_submit"
                              class="fileButton outline-0 border-0 bg-[#5256ad] text-white rounded transition-[0.3s] cursor-pointer shadow-md text-[0.8rem] py-2 px-3 hover:opacity-[0.8] active:translate-y-[5px]"
                            >
                              Upload
                            </button>
                          </div>
                          <div
                            action=""
                            id=""
                            class="dragover w-full rounded-md border-dashed border-2 text-#c8c9dd font-medium relative bg-[#dfe3f259] flex justify-center items-center mt-5 select-none h-[160px]"
                          >
                            <div class="toggleText">
                              <span class="innerDiv"
                                >Drag & drop image here or
                                <span class="selectDiv text-[#5256ad] ml-[7px] cursor-pointer"
                                  >Browse
                                </span></span
                              >
                            </div>
                            <input type="file" class="file hidden" name="file" multiple />
                          </div>
                          <div class="progress-container">
                            <!-- <div class="progress-bar"  value="50" max="100"></div> -->
                            <div class="mb-1 text-base font-medium text-slate-500">
                              Documents Uploaded <span id="count">0%</span>
                            </div>
                            <div
                              class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700"
                            >
                              <div
                                id="progress-bar"
                                class="progress-bar bg-blue-600 h-1.5 rounded-full dark:bg-blue-500 w-0"
                       
                              ></div>
                            </div>
                          </div>
                  
                          <div
                            class="containerDiv w-full flex justify-start items-start flex-wrap h-auto max-h-[300px] overflow-y-auto mt-5"
                          >
                          <!-- <div class="imageDiv h-[85px] w-[85px] rounded-[5px] shadow-sm overflow-hidden relative mb-2 mr-2 ">
                            <img src="${URL.createObjectURL(
                              e.file
                            )}" alt="" class="h-full w-full ">
                            <span class="  absolute top-[-4px] right-[5px] cursor-pointer text-sm text-white hover:opacity-[0.8]" onclick="deleteImage(${i})">X</span>
                        </div> -->
                        </div>
                        </div>
                      </div>
                      </div>
        </div>
        
          </div>
          



                  <div style="overflow: auto " class="mt-4">
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
                    <span class="step"></span>
                  </div>
                </form>
              </div>
              <!-- <div class="col-12 col-md-5" >
                        <img
                          class="w-100"
                          src="images/credit card/2.png"
                          alt=""
                        />
                      </div> -->
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

        <section
          id="section-fun-facts"
          class="pt60 pb60"
          data-bgcolor="#F2F6FE"
        >
          <div class="container">
            <div class="row text-center">
              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay="0s"
              >
                <div class="de_count">
                  <h3>
                    <span class="timer" data-to="4500" data-speed="3000"
                      >0</span
                    >
                  </h3>
                  <h5 class="id-color">Home Protected</h5>
                </div>
              </div>

              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay=".25s"
              >
                <div class="de_count">
                  <h3>
                    <span class="timer" data-to="16" data-speed="3000">0</span>k
                  </h3>
                  <h5 class="id-color">People Saved</h5>
                </div>
              </div>

              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay=".4s"
              >
                <div class="de_count">
                  <h3>
                    <span class="timer" data-to="4" data-speed="3000">0</span>m
                  </h3>
                  <h5 class="id-color">Money Saved</h5>
                </div>
              </div>

              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay=".6s"
              >
                <div class="de_count">
                  <h3>
                    <span class="timer" data-to="52" data-speed="3000">0</span>k
                  </h3>
                  <h5 class="id-color">Contract Signed</h5>
                </div>
              </div>

              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay=".8s"
              >
                <div class="de_count">
                  <h3>
                    <span class="timer" data-to="100" data-speed="3000">0</span
                    >+
                  </h3>
                  <h5 class="id-color">Countries</h5>
                </div>
              </div>

              <div
                class="col-lg-2 col-md-3 wow fadeInUp mb-sm-30"
                data-wow-delay="1s"
              >
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