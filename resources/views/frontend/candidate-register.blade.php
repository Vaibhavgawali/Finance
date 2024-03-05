@extends('frontend/layouts.main')
@section('main-section')
<!-- Info Section Start -->

<div class="info-register pb-5">
    <div class="container w-100 mt-50 ">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-4 shadow rounded  p-2   d-none   d-xl-block bg-white">
                <div>
                    <img src="{{asset('assets/img/3D-images/register.png')}}" alt="">
                </div>
                <div>
                    <div class="ins-main-about-list-area ul-li-block">
                        <ul class="">
                            <li class="fs-6 fst-italic">Build your profile.</li>
                            <li class="fs-6 fst-italic">Learn & stay updated.</li>
                            <li class="fs-6 fst-italic">Find a job .</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-1 "></div>
            <div style="margin: auto;" class="col-11 col-md-12 col-lg-7 shadow  rounded p-4 bg-white">
                <div>
                    <h4 class="text-start">Enter your details</h4>
                </div>
                <div>

                    <form id="candidate_register_form">
                        <div id="register_status"></div>
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="What is your Name?">
                            <div id="name_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Mobile number</label>
                            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="numberHelp" placeholder="Mobile Number">
                            <div id="phone_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Tell us your Email ID">
                            <div id="email_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter Your Password">
                            <div id="password_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="passwordHelp" placeholder="Enter Your Confirm Password">
                            <div id="password_confirmation_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Enter City">
                            <div id="city_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Experience</label>
                            <select class="form-control" name="experience" id="experience" aria-label="work status">
                                <option selected disabled>-- Select --</option>
                                <option value="experienced">Experienced</option>
                                <option value="fresher">Fresher</option>
                            </select>
                            <div id="experience_error"></div>
                        </div>

                        <div class="mb-3" id="experienceFields" style="display: none;">
                            <!-- Additional fields for experienced users -->
                            <div class="mb-3">
                                <label for="current-org" class="form-label">Current Organisation</label>
                                <input type="text" class="form-control" name="organization" id="organization" aria-describedby="current-orgHelp" placeholder="Enter your organisation name?">
                                <div id="organization_error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Current Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation" aria-describedby="current-roleHelp" placeholder="Enter your current designation">
                                <div id="designation_error"></div>
                            </div>

                                <!-- <div class="mb-3">
                                    <label for="joining_date" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control"  name="joining_date" id="joining_date" aria-describedby="joiningDateHelp" placeholder="YYYY-MM-DD">
                                    <div id="joining_date_error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="relieving_date" class="form-label">Relieving Date</label>
                                    <input type="date" class="form-control"  name="relieving_date" id="relieving_date" aria-describedby="relievingDateHelp" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD">
                                </div> 

                            <div class="mb-3">
                                <label for="experience_year" class="form-label">Experience (in years)</label>
                                <input type="number" class="form-control" name="experience_year" id="experience_year" aria-describedby="ctcHelp" placeholder="Enter your experience">
                                <div id="experience_year_error"></div>
                                </div> -->
                                
                                <div class="mb-3">
                                    <label for="experience_year" class="form-label">Experience (in years)</label>
                                    <input type="number" class="form-control"  name="experience_year" id="experience_year" aria-describedby="ctcHelp" placeholder="Enter your experience">
                                    <div id="experience_year_error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">Current CTC</label>
                                <input type="number" class="form-control" name="ctc" id="ctc" aria-describedby="ctcHelp" placeholder="Enter your current CTC">
                                <div id="ctc_error"></div>
                            </div>

                        </div>

                        <script>
                            document.getElementById('experience').addEventListener('change', function() {
                                var experienceFields = document.getElementById('experienceFields');

                                if (this.value === 'experienced') {
                                    experienceFields.style.display = 'block';
                                } else {
                                    experienceFields.style.display = 'none';
                                }
                            });
                        </script>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Preffered Line</label>
                            <select class="form-control" name="preffered_line" id="preffered_line" aria-label="work status">
                                <option selected disabled>-- Select --</option>
                                <option value="life">Life</option>
                                <option value="general">General</option>
                                <option value="health">Health</option>
                                <option value="other" id="preffered_line_other_value">Other</option>
                            </select>
                            <div id="preffered_line_error"></div>
                        </div>

                        <div class="mb-3" style="display:none" id="preffered_line_otherDiv">
                            <label for="preffered_line_other" class="form-label">Other preffered Line</label>
                            <input type="text" class="form-control" name="preffered_line_other" id="preffered_line_other" aria-describedby="preffered_line_otherHelp" placeholder="Write Some Preffered Line for Other">
                            <div id="preffered_line_other_error"></div>
                        </div>

                        <script>
                            // Add event listener to the input element
                            document.getElementById('preffered_line_other').addEventListener('input', function() {
                                // Get the input value
                                var inputValue = this.value;

                                // Update the "Other" option in the select tag's value attribute
                                var otherOption = document.getElementById("preffered_line_other_value");
                                otherOption.value = inputValue;
                                console.log(otherOption.value);
                            });

                            // Add event listener to the select element
                            // Add event listener to the select element
                            document.getElementById('preffered_line').addEventListener('change', function() {
                                // Get the selected option
                                var selectedOption = this.options[this.selectedIndex];

                                // Get the other div
                                var otherDiv = document.getElementById('preffered_line_otherDiv');

                                // Check if the selected option's text content is "Other"
                                if (selectedOption.textContent === 'Other') {
                                    // Display the other div
                                    otherDiv.style.display = 'block';
                                } else {
                                    // Hide the other div
                                    otherDiv.style.display = 'none';
                                }
                            });


                            document.getElementById('preffered_line').addEventListener('change', function() {
                                // Get the selected value
                                var selectedValue = this.value;

                                // Log the selected value to the console
                                // console.log("Selected Value:", selectedValue);
                            });
                        </script>


                        <div class="d-flex align-items-center ">
                            <input class="form-check-input m-2" type="checkbox" value="" id="flexCheckDefault">
                            I agree to the <a href="" class="text-primary m-1"> terms & conditions</a>
                        </div>
                        <div id="flexCheckDefault_error"></div>

                        <div>
                            <div>
                                <button type="submit" id="candidate_register_button" class="btn btn-primary  my-2">Register Now</button>
                            </div>
                            Already have an Account ? <a href="/login" class="btn btn-secondary text-white mx-2">Login</a>
                        </div>
                    </form>
                    <script>
                        function enableButton() {
                            var checkbox = document.getElementById('flexCheckDefault');
                            var submitButton = document.getElementById('submitButton');

                            if (checkbox.checked) {
                                submitButton.disabled = false;
                            } else {
                                submitButton.disabled = true;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Info Section End -->
@endsection