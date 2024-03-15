$(document).ready(function() {
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
      console.log(creditcard);
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
            // All form data is collected here
            var formData = {};
            x.find("input, textarea").each(function() {
                formData[$(this).attr("name")] = $(this).val();
            });
            console.log(formData);

            // Send form data to server using AJAX for validation
            $.ajax({
                type: "POST",
                url: "validate.php", // Replace with your server-side validation script
                data: formData,
                success: function(response) {
                    if (response.valid) {
                        // Proceed to the next tab only if the response is valid
                        showTab(currentTab);
                    } else {
                        // Display validation errors
                        $(".error-message").text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Display an error message or handle accordingly
                    $(".error-message").text("An error occurred. Please try again later.");
                }
            });

            return false;
        }

        showTab(currentTab);
    }

    function validateForm() {
        var x, y, valid = true;
        x = $(".tab");
        y = x.eq(currentTab).find("input, textarea");

        y.each(function() {
            var input = $(this);
            var errorDiv = $("#" + input.attr('id') + "_error");
            var selector = input.attr('id');

            if (input.val() == "" && input.is('input[type="text"]')) {
                input.addClass("invalid");
                errorDiv.text(selector + " is required");
                valid = false;
            } else if (input.is('input[type="file"]')) {
                var allowedFormats = ['jpg', 'jpeg', 'png', 'pdf'];
                var fileExtension = input.val().split('.').pop().toLowerCase();
                if ($.inArray(fileExtension, allowedFormats) == -1) {
                    input.addClass("invalid");
                    errorDiv.text("File type not allowed. Please upload jpg, jpeg, png, or pdf files.");
                    valid = false;
                } else {
                    input.removeClass("invalid");
                    errorDiv.text(""); // Clear the error message if input is valid
                }
            } else if (input.is('textarea')) {
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
                if (selector == "pancard") {
                    if (!input.val().match(/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("PAN is not valid");
                        valid = false;
                    }
                } else if (selector == "email") {
                    if (!input.val().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Email is not valid");
                        valid = false;
                    }
                } else if (selector == "phone") {
                    if (!input.val().match(/^\d{10}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Phone number is not valid");
                        valid = false;
                    }
                } else if (selector == "adharcard") {
                    if (!input.val().match(/^\d{12}$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Adhar number is not valid");
                        valid = false;
                    }
                } else if (selector == "income") {
                    if (!input.val().match(/^\d+(\.\d{1,2})?$/)) {
                        input.addClass("invalid");
                        errorDiv.text("Income should contain only digits");
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

    $("#creditForm").on("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
    });

    $("#nextBtn").on("click", function() {
        nextPrev(1);
    });

    $("#prevBtn").on("click", function() {
        nextPrev(-1);
    });
});
