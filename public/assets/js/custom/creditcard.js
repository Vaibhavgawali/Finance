$(document).ready(function () {
    var currentTab = 0;
    showTab(currentTab);
    updateStepper(currentTab); // Update stepper initially

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
        var name = $("#name").val().trim();
        var panNumber = $("#pan_number").val().trim();
        var email = $("#email").val().trim();
        var mobile = $("#mobile").val().trim();
        var income = $("#annual_income").val().trim();
        var adharNumber = $("#adhar_number").val().trim();
        var panFile = $("#pan_file").prop("files")[0];
        var adharFrontFile = $("#adhar_front_file").prop("files")[0];
        var adharBackFile = $("#adhar_back_file").prop("files")[0];
        var itrFile = $("#itr_file").prop("files")[0];
        var bankStatementFile = $("#bank_statement_file").prop("files")[0];
        
        var allowedImageExtensions = /(jpg|jpeg|png|pdf)$/i;

        // Validation for each input field
        if (currentTab == 0) {
            if (name === "") {
                $("#name_error").text("Please enter your name.");
                isValid = false;
            } else  if (panNumber === "") {
                $("#pan_number_error").text("Please enter your PAN number.");
                isValid = false;
            } else if (!isValidPanNumber(panNumber)) {
                $("#pan_number_error").text("Please enter a valid PAN number.");
                isValid = false;
            } else if (adharNumber === "") {
                $("#adhar_number_error").text("Please enter your Aadhar number.");
                isValid = false;
            } else if (!isValidAdharNumber(adharNumber)) {
                $("#adhar_number_error").text("Please enter a valid Aadhar number.");
                isValid = false;
            }  else if (email === "") {
                $("#email_error").text("Please enter your email.");
                isValid = false;
            } else if (!isValidEmail(email)) {
                $("#email_error").text("Please enter a valid email address.");
                isValid = false;
            } else if (mobile === "") {
                $("#mobile_error").text("Please enter your mobile number.");
                isValid = false;
            } else if (!isValidMobile(mobile)) {
                $("#mobile_error").text("Please enter a valid mobile number.");
                isValid = false;
            } else if (income === "") {
                $("#annual_income_error").text("Please enter your net annual income.");
                isValid = false;
            } else if (isNaN(income) || parseFloat(income) <= 0) {
                $("#annual_income_error").text("Please enter a valid net annual income.");
                isValid = false;
            }
        } else if (currentTab == 1) {
            if ($("#residence_address").val().trim() === "") {
                $("#residence_address_error").text("Please enter your address.");
                isValid = false;
            } else if ($("#office_address").val().trim() === "") {
                $("#office_address_error").text("Please enter your office address.");
                isValid = false;
            } else  if (!panFile) {
                $("#pan_file_error").text("Please upload your PAN card.");
                isValid = false;
            } else if (!allowedImageExtensions.test(panFile.name)) {
                $("#pan_file_error").text("Please upload a PDF, JPEG, JPG, or PNG image.");
                isValid = false;
            } else if (panFile.size > 2048 * 1024) { // Max size in bytes (2048 KB)
                $("#pan_file_error").text("File size should not exceed 2MB.");
                isValid = false;
            } else if (!adharFrontFile) {
                $("#adhar_front_file_error").text("Please upload your Aadhar front.");
                isValid = false;
            } else if (!allowedImageExtensions.test(adharFrontFile.name)) {
                $("#adhar_front_file_error").text("Please upload a PDF, JPEG, JPG, or PNG image.");
                isValid = false;
            } else if (adharFrontFile.size > 2048 * 1024) { // Max size in bytes (2048 KB)
                $("#adhar_front_file_error").text("File size should not exceed 2MB.");
                isValid = false;
            } else if (!adharBackFile) {
                $("#adhar_back_file_error").text("Please upload your Aadhar back.");
                isValid = false;
            } else if (!allowedImageExtensions.test(adharBackFile.name)) {
                $("#adhar_back_file_error").text("Please upload a PDF, JPEG, JPG, or PNG image.");
                isValid = false;
            } else if (adharBackFile.size > 2048 * 1024) { // Max size in bytes (2048 KB)
                $("#adhar_back_file_error").text("File size should not exceed 2MB.");
                isValid = false;
            } else if (!itrFile) {
                $("#itr_file_error").text("Please upload your ITR file.");
                isValid = false;
            } else if (!allowedImageExtensions.test(itrFile.name)) {
                $("#itr_file_error").text("Please upload a PDF, JPEG, JPG, or PNG image.");
                isValid = false;
            } else if (itrFile.size > 2048 * 1024) { // Max size in bytes (2048 KB)
                $("#itr_file_error").text("File size should not exceed 2MB.");
                isValid = false;
            } else if (!bankStatementFile) {
                $("#bank_statement_file_error").text("Please upload your bank statement file.");
                isValid = false;
            } else if (!allowedImageExtensions.test(bankStatementFile.name)) {
                $("#bank_statement_file_error").text("Please upload a PDF, JPEG, JPG, or PNG image.");
                isValid = false;
            } else if (bankStatementFile.size > 2048 * 1024) { // Max size in bytes (2048 KB)
                $("#bank_statement_file_error").text("File size should not exceed 2MB.");
                isValid = false;
            }
            
        }
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

    function isValidMobile(mobile) {
        var mobileRegex = /^\d{10}$/;
        return mobileRegex.test(mobile);
    }

    $(".nextBtn").on("click", function () {
        nextPrev(1);
    });

    $(".prevBtn").on("click", function () {
        nextPrev(-1);
    });

    // Function to extract parameter from URL
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return "";
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Get the insurance plan from the URL
    var creditcard = getParameterByName("creditcard");
    $("#card").val(creditcard);

    function updateStepper(n) {
        $(".step").removeClass("active"); // Remove active class from all steps
        $(".step").eq(n).addClass("active"); // Add active class to current step
    }

    $("#creditForm").submit(function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Validate the form before submitting
        if (validateForm()) {
            var formData = new FormData();

            formData.append("card", $("#card").val());
            formData.append("name", $("#name").val());
            formData.append("pan_num", $("#pan_number").val());
            formData.append("adhar_num", $("#adhar_number").val());
            formData.append("email", $("#email").val());
            formData.append("mobile", $("#mobile").val());
            formData.append("annual_income", $("#annual_income").val());
            formData.append("residence_address", $("#residence_address").val());
            formData.append("office_address", $("#office_address").val());
            formData.append("pan_file", $("#pan_file").prop("files")[0]);
            formData.append("adhar_front_file", $("#adhar_front_file").prop("files")[0]);
            formData.append("adhar_back_file", $("#adhar_back_file").prop("files")[0]);
            formData.append("itr_file", $("#itr_file").prop("files")[0]);
            formData.append("bank_statement_file", $("#bank_statement_file").prop("files")[0]);

            // Submit form data via AJAX
            $.ajax({
                url: "/credit-card",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == true) {
                        $(".error-message").remove();
                        $("#credit_card_submit_btn").attr("disabled", true);
                        window.location.reload();
                        $("#creditForm")[0].reset();
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
            console.log("Form submission failed. Please resolve all errors.");
        }
    });

});
