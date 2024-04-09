$(document).ready(function () {
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
    // alert(creditcard);
    $("#card").val(creditcard);
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        $(".tab").hide();
        $(".tab").eq(n).show();

        if (n == 0) {
            $("#prevBtn").hide();
        } else {
            $("#prevBtn").show();
        }

        if (n == $(".tab").length - 1) {
            $("#nextBtn").html("Submit");
        } else {
            $("#nextBtn").html("Next");
        }

        fixStepIndicator(n);
    }

    function nextPrev(n) {
        var x = $(".tab");

        if (n == 1 && !validateForm()) return false;

        x.eq(currentTab).hide();
        currentTab += n;

        if (currentTab >= x.length) {
            var formData = new FormData();
            x.find("input, textarea, select").each(function () {
                if ($(this).attr("type") === "file") {
                    formData.append($(this).attr("name"), $(this)[0].files[0]);
                } else {
                    formData.append($(this).attr("name"), $(this).val());
                }
            });

            var formUrl = $("#formUrl").val();

            // Send form data to server using AJAX for validation
            $.ajax({
                type: "POST",
                url: $('meta[name="base-url"]').attr("content") + formUrl,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Accept: "application/json",
                },
                success: function (response) {
                    if (response.valid) {
                        // Proceed to the next tab only if the response is valid
                        showTab(currentTab);
                    } else {
                        // Display validation errors
                        $(".error-message").text(response.message);
                    }
                },
                error: function (response) {
                    console.log(response);
                    if (response.status === 422) {
                        var errors = response.responseJSON.errors;
                        $(".error-message").remove();

                        // Display new errors
                        $.each(errors, function (field, messages) {
                            var input = $('[name="' + field + '"]');
                            input.after(
                                '<div class="error-message invalid-feedback d-block">' +
                                    messages.join(", ") +
                                    "</div>"
                            );
                            input.focus();
                            return false;
                        });
                    }

                    console.error(xhr.responseText);
                    // Display an error message or handle accordingly
                    $(".error-message").text(
                        "An error occurred. Please try again later."
                    );
                },
            });

            return false;
        }

        showTab(currentTab);
    }

    function validateForm() {
        var x,
            y,
            valid = true;
        x = $(".tab");
        y = x.eq(currentTab).find("input, textarea");

        y.each(function () {
            var input = $(this);
            var errorDiv = $("#" + input.attr("id") + "_error");
            var selector = input.attr("id");

            var formUrl = $("#formUrl").val();
            if (formUrl == "/loan") {
                var loanType = $("#loan_type").val();
                $("#loan_type_error").html();
                var loan_type_error = $("#loan_type_error");
                if (
                    loanType == "null" ||
                    loanType == null ||
                    loanType == "undefined" ||
                    loanType == undefined
                ) {
                    input.addClass("invalid");
                    loan_type_error.text("Loan type is required");
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    loan_type_error.text("");
                }

                var maritalStatus = $("#marital_status").val();
                $("#marital_status_error").html();
                var marital_status_error = $("#marital_status_error");
                if (
                    maritalStatus == "null" ||
                    maritalStatus == null ||
                    maritalStatus == "undefined" ||
                    maritalStatus == undefined
                ) {
                    input.addClass("invalid");
                    marital_status_error.text("Marital Status is required");
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    marital_status_error.text("");
                }

                var incomeSource = $("#income_source").val();
                $("#income_source_error").html();
                var income_source_error = $("#income_source_error");
                if (
                    incomeSource == "null" ||
                    incomeSource == null ||
                    incomeSource == "undefined" ||
                    incomeSource == undefined
                ) {
                    input.addClass("invalid");
                    income_source_error.text("Income source is required");
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    income_source_error.text("");
                }
            }

            if (
                (input.val() == "" && input.is('input[type="text"]')) ||
                input.is("select")
            ) {
                input.addClass("invalid");
                errorDiv.text(selector + " is required");
                valid = false;
            } else if (input.is('input[type="file"]')) {
                var allowedFormats = ["jpg", "jpeg", "png", "pdf"];
                var fileExtension = input.val().split(".").pop().toLowerCase();
                if ($.inArray(fileExtension, allowedFormats) == -1) {
                    input.addClass("invalid");
                    errorDiv.text(
                        "File type not allowed. Please upload jpg, jpeg, png, or pdf files."
                    );
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    errorDiv.text(""); // Clear the error message if input is valid
                }
            } else if (input.is("textarea")) {
                if (input.val().trim() === "") {
                    input.addClass("invalid");
                    errorDiv.text("Address is required");
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    errorDiv.text(""); // Clear the error message if input is valid
                }
            } else {
                input.removeClass("invalid");
                errorDiv.text(""); // Clear the error message if input is valid

                // Other validations (PAN, email, phone, Aadhar, income, etc.) can be added here
                if (selector == "pan_num") {
                    if (!input.val().match(/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("PAN is not valid");
                        valid = false;
                    }
                } else if (selector == "email") {
                    if (
                        !input
                            .val()
                            .match(
                                /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
                            )
                    ) {
                        input.addClass("invalid");
                        errorDiv.text("Email is not valid");
                        valid = false;
                    }
                } else if (selector == "mobile") {
                    if (!input.val().match(/^\d{10}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Phone number is not valid");
                        valid = false;
                    }
                } else if (selector == "adhar_num") {
                    if (!input.val().match(/^\d{12}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Adhar number is not valid");
                        valid = false;
                    }
                } else if (selector == "annual_income") {
                    if (!input.val().match(/^\d+(\.\d{1,2})?$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Income should contain only digits");
                        valid = false;
                    }
                } else if (selector == "office_phone") {
                    if (!input.val().match(/^\d{10}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Phone number is not valid");
                        valid = false;
                    }
                }
            }
        });

        return valid;
    }

    function fixStepIndicator(n) {
        var x = $(".step");

        x.removeClass("active");
        x.eq(n).addClass("active");
    }

    $("#creditForm").on("submit", function (event) {
        event.preventDefault();
    });

    $("#loanForm").on("submit", function (event) {
        event.preventDefault();
        // alert("ok");
    });

    $("#nextBtn").on("click", function () {
        nextPrev(1);
    });

    $("#prevBtn").on("click", function () {
        nextPrev(-1);
    });
});
