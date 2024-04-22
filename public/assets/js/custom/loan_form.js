$(document).ready(function () {
    if (window.location.pathname === "/loan/create") {
        // console.log("script is running on Loan page");

        var currentTab = 0;
        showTab(currentTab);
        updateStepper(currentTab); // Update stepper initially
        //   console.log("hi");
        function showTab(n) {
            $(".tab").hide();
            $(".tab").eq(n).show();
            updateStepper(n); // Update stepper when showing a tab
        }

        function nextPrev(n) {
            var tabs = $(".tab");
            // Check if the form is valid before proceeding
            if (n === -1 && currentTab === 0) return false; // If at the first tab, do nothing

            // Check if the form is valid before proceeding
            if (n === 1 && !validateForm()) return false;

            // Hide the current tab
            tabs.eq(currentTab).hide();
            // Increment or decrement the current tab index
            currentTab += n;
            // Show the new tab
            showTab(currentTab);
        }

        function validateForm() {
            // Reset any previous error messages
            $(".text-danger").text("");
            var isValid = true;
            var loanType = $("#loan_type").val();
            var name = $("#name").val().trim();
            var email = $("#email").val().trim();
            var mobile = $("#mobile").val().trim();
            var incomeSource = $("#income_source").val();
            var monthlyIncome = $("#monthly_income").val().trim();
            var pincode = $("#pincode").val().trim();
            var dob = $("#dob").val().trim();
            var panNum = $("#pan_num").val().trim();
            var maritalStatus = $("#marital_status").val();
            var adharNum = $("#adhar_num").val().trim();
            var loanAmount = $("#loan_amount").val().trim();
            var creditScore = $("#credit_score").val().trim();
            var motherName = $("#mother_name").val().trim();
            // Retrieve present address values
            var presentLine1 = $("#present_line1").val().trim();
            var presentLine2 = $("#present_line2").val().trim();
            var presentLine3 = $("#present_line3").val().trim();
            var presentLandmark = $("#present_landmark").val().trim();
            var presentState = $("#present_state").val().trim();
            var presentCity = $("#present_city").val().trim();
            var presentPincode = $("#present_pincode").val().trim();
            var presentPhone = $("#present_phone").val().trim();

            // Retrieve office address values
            var officeLine1 = $("#office_line1").val().trim();
            var officeLine2 = $("#office_line2").val().trim();
            var officeLine3 = $("#office_line3").val().trim();
            var officeLandmark = $("#office_landmark").val().trim();
            var officeState = $("#office_state").val().trim();
            var officeCity = $("#office_city").val().trim();
            var officePincode = $("#office_pincode").val().trim();
            var officePhone = $("#office_phone").val().trim();

            var identity_proof = $("#identity_proof_file").prop("files")[0];
            var residence_proof = $("#residence_proof_file").prop("files")[0];
            var itr_file = $("#itr_file").prop("files")[0];
            var employment_proof = $("#employment_proof_file").prop("files")[0];
            var income_proof = $("#income_proof_file").prop("files")[0];

            var allowedImageExtensions = /(jpg|jpeg|png|pdf)$/i;

            // var panFile = $("#pan_file").prop("files")[0];

            // Validation for each input field
            if (currentTab == 0) {
                console.log(incomeSource);
                if (
                    loanType === "" ||
                    loanType == "null" ||
                    loanType == null ||
                    loanType == "undefined" ||
                    loanType == undefined
                ) {
                    $("#loan_type_error").text("Please select loan type.");
                    isValid = false;
                } else if (name === "") {
                    $("#name_error").text("Please enter your name.");
                    isValid = false;
                } else if (email === "") {
                    $("#email_error").text("Please enter your email.");
                    isValid = false;
                } else if (!isValidEmail(email)) {
                    $("#email_error").text(
                        "Please enter a valid email address."
                    );
                    isValid = false;
                } else if (mobile === "") {
                    $("#mobile_error").text("Please enter your mobile number.");
                    isValid = false;
                } else if (!isValidMobile(mobile)) {
                    $("#mobile_error").text(
                        "Please enter a valid mobile number."
                    );
                    isValid = false;
                } else if (
                    incomeSource === "" ||
                    incomeSource == "null" ||
                    incomeSource == null ||
                    incomeSource == "undefined" ||
                    incomeSource == undefined
                ) {
                    $("#income_source_error").text(
                        "Please select your income source."
                    );
                    isValid = false;
                } else if (
                    monthlyIncome === "" ||
                    monthlyIncome == "null" ||
                    monthlyIncome == null ||
                    monthlyIncome == "undefined" ||
                    monthlyIncome == undefined
                ) {
                    $("#monthly_income_error").text(
                        "Please enter your monthly income."
                    );
                    isValid = false;
                } else if (
                    isNaN(monthlyIncome) ||
                    parseFloat(monthlyIncome) <= 0
                ) {
                    $("#monthly_income_error").text(
                        "Please enter a valid monthly income."
                    );
                    isValid = false;
                } else if (
                    isNaN(monthlyIncome) ||
                    parseFloat(monthlyIncome) <= 15000
                ) {
                    $("#monthly_income_error").text(
                        "Monthly income should be greater than 15,000."
                    );
                    isValid = false;
                } else if (pincode === "") {
                    $("#pincode_error").text("Please enter your pincode.");
                    isValid = false;
                } else if (!isValidPincode(pincode)) {
                    $("#pincode_error").text("Please enter a valid pincode.");
                    isValid = false;
                } else if (dob === "") {
                    $("#dob_error").text("Please enter your date of birth.");
                    isValid = false;
                } else if (!isValidDate(dob)) {
                    $("#dob_error").text("Please enter a valid date of birth.");
                    isValid = false;
                } else if (!isValidAge(dob)) {
                    $("#dob_error").text(
                        "Age should be in the range of 23 to 55."
                    );
                    isValid = false;
                } else if (panNum === "") {
                    $("#pan_num_error").text("Please enter your PAN number.");
                    isValid = false;
                } else if (!isValidPanNumber(panNum)) {
                    $("#pan_num_error").text(
                        "Please enter a valid PAN number."
                    );
                    isValid = false;
                } else if (
                    maritalStatus === "" ||
                    maritalStatus == "null" ||
                    maritalStatus == null ||
                    maritalStatus == "undefined" ||
                    maritalStatus == undefined
                ) {
                    $("#marital_status_error").text(
                        "Please select your marital status."
                    );
                    isValid = false;
                } else if (adharNum === "") {
                    $("#adhar_num_error").text(
                        "Please enter your Aadhar number."
                    );
                    isValid = false;
                } else if (!isValidAdharNumber(adharNum)) {
                    $("#adhar_num_error").text(
                        "Please enter a valid Aadhar number."
                    );
                    isValid = false;
                } else if (loanAmount === "") {
                    $("#loan_amount_error").text(
                        "Please enter your loan amount."
                    );
                    isValid = false;
                } else if (isNaN(loanAmount) || parseFloat(loanAmount) <= 0) {
                    $("#loan_amount_error").text(
                        "Please enter a valid loan amount."
                    );
                    isValid = false;
                } else if (creditScore === "") {
                    $("#credit_score_error").text(
                        "Please enter your credit score."
                    );
                    isValid = false;
                } else if (
                    isNaN(creditScore) ||
                    parseFloat(creditScore) <= 0 ||
                    parseFloat(creditScore) > 999
                ) {
                    $("#credit_score_error").text(
                        "Please enter a valid credit score."
                    );
                    isValid = false;
                } else if (motherName === "") {
                    $("#mother_name_error").text(
                        "Please enter your mother's name."
                    );
                    isValid = false;
                }
            } else if (currentTab == 1) {
                if (presentLine1 === "") {
                    $("#present_line1_error").text(
                        "Please enter your address line 1."
                    );
                    isValid = false;
                } else if (presentLine2 === "") {
                    $("#present_line2_error").text(
                        "Please enter your address line 2."
                    );
                    isValid = false;
                } else if (presentLine3 === "") {
                    $("#present_line3_error").text(
                        "Please enter your address line 3."
                    );
                    isValid = false;
                } else if (presentState === "") {
                    $("#present_state_error").text("Please enter your state.");
                    isValid = false;
                } else if (presentCity === "") {
                    $("#present_city_error").text("Please enter your city.");
                    isValid = false;
                } else if (presentPincode === "") {
                    $("#present_pincode_error").text(
                        "Please enter your pincode."
                    );
                    isValid = false;
                } else if (!isValidPincode(presentPincode)) {
                    $("#present_pincode_error").text(
                        "Please enter a valid pincode."
                    );
                    isValid = false;
                } else if (presentPhone === "") {
                    $("#present_phone_error").text(
                        "Please enter your phone number."
                    );
                    isValid = false;
                } else if (!isValidMobile(presentPhone)) {
                    $("#present_phone_error").text(
                        "Please enter a valid phone number."
                    );
                    isValid = false;
                } else if (officeLine1 === "") {
                    $("#office_line1_error").text(
                        "Please enter your address line 1."
                    );
                    isValid = false;
                } else if (officeLine2 === "") {
                    $("#office_line2_error").text(
                        "Please enter your address line 2."
                    );
                    isValid = false;
                } else if (officeLine3 === "") {
                    $("#office_line3_error").text(
                        "Please enter your address line 3."
                    );
                    isValid = false;
                } else if (officeState === "") {
                    $("#office_state_error").text("Please enter your state.");
                    isValid = false;
                } else if (officeCity === "") {
                    $("#office_city_error").text("Please enter your city.");
                    isValid = false;
                } else if (officePincode === "") {
                    $("#office_pincode_error").text(
                        "Please enter your pincode."
                    );
                    isValid = false;
                } else if (!isValidPincode(officePincode)) {
                    $("#office_pincode_error").text(
                        "Please enter a valid pincode."
                    );
                    isValid = false;
                } else if (officePhone === "") {
                    $("#office_phone_error").text(
                        "Please enter your phone number."
                    );
                    isValid = false;
                } else if (!isValidMobile(officePhone)) {
                    $("#office_phone_error").text(
                        "Please enter a valid phone number."
                    );
                    isValid = false;
                }
            } else if (currentTab == 2) {
                if (!identity_proof) {
                    $("#identity_proof_file_error").text(
                        "Please upload your identity proof."
                    );
                    isValid = false;
                } else if (!residence_proof) {
                    $("#residence_proof_file_error").text(
                        "Please upload your residence proof."
                    );
                    isValid = false;
                } else if (!employment_proof) {
                    $("#employment_proof_file_error").text(
                        "Please upload your employment proof."
                    );
                    isValid = false;
                } else if (!income_proof) {
                    $("#income_proof_error").text(
                        "Please upload your income proof."
                    );
                    isValid = false;
                } else if (!itr_file) {
                    $("#itr_file_error").text("Please upload your ITR.");
                    isValid = false;
                } else if (
                    !allowedImageExtensions.test(residence_proof.name) ||
                    residence_proof.size > 2048 * 1024
                ) {
                    $("#residence_proof_file_error").text(
                        "Invalid file format or size. Please upload a PDF, JPEG, JPG, or PNG image with a maximum size of 2MB."
                    );
                    isValid = false;
                } else if (
                    !allowedImageExtensions.test(employment_proof.name) ||
                    employment_proof.size > 2048 * 1024
                ) {
                    $("#employment_proof_file_error").text(
                        "Invalid file format or size. Please upload a PDF, JPEG, JPG, or PNG image with a maximum size of 2MB."
                    );
                    isValid = false;
                } else if (
                    !allowedImageExtensions.test(income_proof.name) ||
                    income_proof.size > 2048 * 1024
                ) {
                    $("#income_proof_error").text(
                        "Invalid file format or size. Please upload a PDF, JPEG, JPG, or PNG image with a maximum size of 2MB."
                    );
                    isValid = false;
                } else if (
                    !allowedImageExtensions.test(itr_file.name) ||
                    itr_file.size > 2048 * 1024
                ) {
                    $("#itr_file_error").text(
                        "Invalid file format or size. Please upload a PDF, JPEG, JPG, or PNG image with a maximum size of 2MB."
                    );
                    isValid = false;
                }
            }
            // console.log("valid;", isValid);
            return isValid;
        }

        function isValidPanNumber(panNumber) {
            var panRegex = /[A-Z]{5}[0-9]{4}[A-Z]{1}/;
            return panRegex.test(panNumber);
        }

        function isValidAdharNumber(adharNumber) {
            var adharRegex = /^\d{12}$/;
            return adharRegex.test(adharNumber);
        }

        function isValidEmail(email) {
            var emailRegex = /\S+@\S+\.\S+/;
            return emailRegex.test(email);
        }
        function isValidPincode(pincode) {
            var pincodeRegex = /^\d{6}$/; // Regular expression for pincode (6 digits)
            return pincodeRegex.test(pincode);
        }
        function isValidDate(dateString) {
            var dateRegex = /^\d{4}-\d{2}-\d{2}$/; // Regular expression for date in the format yyyy-mm-dd
            if (!dateRegex.test(dateString)) {
                return false; // Return false if the date format is incorrect
            }
            // Split the date string into year, month, and day components
            var parts = dateString.split("-");
            var year = parseInt(parts[0], 10);
            var month = parseInt(parts[1], 10);
            var day = parseInt(parts[2], 10);
            // Check if the month and day components are valid
            if (month < 1 || month > 12 || day < 1 || day > 31) {
                return false;
            }
            // Check for specific month-day combinations
            if (
                (month == 4 || month == 6 || month == 9 || month == 11) &&
                day > 30
            ) {
                return false;
            }
            if (month == 2) {
                var isLeapYear =
                    (year % 4 == 0 && year % 100 != 0) || year % 400 == 0;
                if ((day > 29 && isLeapYear) || (day > 28 && !isLeapYear)) {
                    return false;
                }
            }
            // If all checks pass, return true
            return true;
        }
        function isValidAge(dateString) {
            var dateRegex = /^\d{4}-\d{2}-\d{2}$/; // Regular expression for date in the format yyyy-mm-dd
            if (!dateRegex.test(dateString)) {
                return false; // Return false if the date format is incorrect
            }
            // Split the date string into year, month, and day components
            var parts = dateString.split("-");
            var year = parseInt(parts[0], 10);
            var month = parseInt(parts[1], 10);
            var day = parseInt(parts[2], 10);

            // Calculate age based on provided date of birth
            var today = new Date();
            var birthDate = new Date(year, month - 1, day); // Note: JavaScript months are 0-based
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();
            if (
                monthDiff < 0 ||
                (monthDiff === 0 && today.getDate() < birthDate.getDate())
            ) {
                age--;
            }

            // Check if age falls within the specified range
            return age >= 23 && age <= 55;
        }

        function isValidMobile(mobile) {
            var mobileRegex = /^\d{10}$/;
            return mobileRegex.test(mobile);
        }

        $(".nextBtn").on("click", function () {
            nextPrev(1);
            // console.log("hi");
        });

        $(".prevBtn").on("click", function () {
            nextPrev(-1);
        });

        // Function to extract parameter from URL

        // Get the insurance plan from the URL

        function updateStepper(n) {
            $(".step").removeClass("active"); // Remove active class from all steps
            $(".step").eq(n).addClass("active"); // Add active class to current step
        }

        $("#loanForm").submit(function (event) {
            // Prevent default form submission
            event.preventDefault();

            // Validate the form before submitting
            if (validateForm()) {
                var formData = new FormData();

                // Append personal information
                formData.append("loan_type", $("#loan_type").val());
                formData.append("name", $("#name").val().trim());
                formData.append("email", $("#email").val().trim());
                formData.append("mobile", $("#mobile").val().trim());
                formData.append("income_source", $("#income_source").val());
                formData.append(
                    "monthly_income",
                    $("#monthly_income").val().trim()
                );
                formData.append("pincode", $("#pincode").val().trim());
                formData.append("dob", $("#dob").val().trim());
                formData.append("pan_num", $("#pan_num").val().trim());
                formData.append("adhar_num", $("#adhar_num").val().trim());
                formData.append("marital_status", $("#marital_status").val());
                formData.append("loan_amount", $("#loan_amount").val().trim());
                formData.append(
                    "credit_score",
                    $("#credit_score").val().trim()
                );
                formData.append("mother_name", $("#mother_name").val().trim());

                // Append present address
                formData.append(
                    "present_line1",
                    $("#present_line1").val().trim()
                );
                formData.append(
                    "present_line2",
                    $("#present_line2").val().trim()
                );
                formData.append(
                    "present_line3",
                    $("#present_line3").val().trim()
                );
                formData.append(
                    "present_landmark",
                    $("#present_landmark").val().trim()
                );
                formData.append(
                    "present_state",
                    $("#present_state").val().trim()
                );
                formData.append(
                    "present_city",
                    $("#present_city").val().trim()
                );
                formData.append(
                    "present_pincode",
                    $("#present_pincode").val().trim()
                );
                formData.append(
                    "present_phone",
                    $("#present_phone").val().trim()
                );

                // Append office address
                formData.append(
                    "office_line1",
                    $("#office_line1").val().trim()
                );
                formData.append(
                    "office_line2",
                    $("#office_line2").val().trim()
                );
                formData.append(
                    "office_line3",
                    $("#office_line3").val().trim()
                );
                formData.append(
                    "office_landmark",
                    $("#office_landmark").val().trim()
                );
                formData.append(
                    "office_state",
                    $("#office_state").val().trim()
                );
                formData.append("office_city", $("#office_city").val().trim());
                formData.append(
                    "office_pincode",
                    $("#office_pincode").val().trim()
                );
                formData.append(
                    "office_phone",
                    $("#office_phone").val().trim()
                );

                // Append document type and upload document
                // Display the selected file in the console for debugging
                // console.log(
                //     "Selected file:",
                //     $("#upload_document").prop("files")[0]
                // );

                // Append document type and upload document
                // formData.append(
                //     "document_type",
                //     $("#identity_proof_file").val()
                // );
                // formData.append(
                //     "upload_document",
                //     $("#upload_document").prop("files")[0]
                // );
                formData.append(
                    "pan_file",
                    $("#identity_proof_file").prop("files")[0]
                );
                formData.append(
                    "adhar_front_file",
                    $("#residence_proof_file").prop("files")[0]
                );
                formData.append(
                    "adhar_back_file",
                    $("#employment_proof_file").prop("files")[0]
                );
                formData.append(
                    "itr_file",
                    $("#income_proof_file").prop("files")[0]
                );
                formData.append(
                    "bank_statement_file",
                    $("#itr_file").prop("files")[0]
                );

                console.log(formData); // Check formData in the console after appending

                console.log(formData);

                // Submit form data via AJAX
                $.ajax({
                    url: "/loan",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status == true) {
                            $(".error-message").remove();
                            // $("#loan_submit_btn").attr("disabled", true);
                            window.open(
                                "https://ugrocapital.com/lead-form?gp_code=MTg3NjUtICBBWFlCWkNEUFFfR1AxOTMy"
                            );
                            window.location.reload();
                            // swal({
                            //     title: "Success!",
                            //     text: "Loan application submitted successfully.",
                            //     icon: "success",
                            //     button: "OK",
                            //     closeOnClickOutside: false,
                            // }).then((value) => {
                            //     if (value) {
                            //         window.open(
                            //             "https://ugrocapital.com/lead-form?gp_code=MTg3NjUtICBBWFlCWkNEUFFfR1AxOTMy"
                            //         );
                            //         window.location.reload();

                            //     }
                            // });
                            return false;
                        }
                    },
                    error: function (response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            $(".error-message").remove();
                            $.each(errors, function (field, messages) {
                                // Display error messages
                            });
                        }
                    },
                });
            } else {
                // If form is invalid, display an error message or take appropriate action
                // console.log(
                //     "Form submission failed. Please resolve all errors."
                // );
            }
        });
    }
});
