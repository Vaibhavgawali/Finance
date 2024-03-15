$(document).ready(function() {

let showPermanentAddress = $('#show_permanent_address');
    
  showPermanentAddress.html(` <div class="col-md-6 col-lg-3">
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
</div>`);





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

        // if (currentTab == 4) {
        //   $("#nextBtn").prop("disabled", true);
        // }
        // else
        // {
        //   showTab(currentTab);

        // }
          showTab(currentTab);

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
                        // showTab(currentTab);
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

        
    }

    function validateForm() {
        var x, y, valid = true;
        x = $(".tab");
        y = x.eq(currentTab).find("input, textarea");

//         y.each(function() {
//             var input = $(this);
//             var errorDiv = $("#" + input.attr('id') + "_error");
//             var selector = input.attr('id');
//             var fieldName = selector.replace(/\_/g, ' ').replace(/\b\w/g, function(match) {
//                 return match.toUpperCase();
//             }); 
//             var loan = $("#loan").val();
//             var loan_error = $("#loan_error");
//             var incomeSource = $("#income_source").val();
//             var incomeSource_error = $("#income_source_error");
//             // console.log("Loan"+loan);
//             if(loan == "null" || loan == null || loan == "undefined" || loan == undefined) {
//                 input.addClass("invalid");
//                loan_error.text("Loan type is required");
//                 valid = false;
//             }
//             else
//             {
//                 loan_error.text("");
//             }
//             if(incomeSource == "null" || incomeSource == null || incomeSource == "undefined" || incomeSource == undefined) {
//                 input.addClass("invalid");
//                incomeSource_error.text("Income source is required");
//                 valid = false;
//             }
//             else
//             {
//                 input.removeClass("invalid");
//                 incomeSource_error.text("");
//             }

// ;
    
//            if (input.val() == "" && input.is('input[type="text"]') || input.is('input[type="date"]') ) {
//                 input.addClass("invalid");
//                 errorDiv.text(fieldName + " is required");
//                 valid = false;
//             }
//              else if (input.is('input[type="file"]')) {
//                 var allowedFormats = ['jpg', 'jpeg', 'png', 'pdf'];
//                 var fileExtension = input.val().split('.').pop().toLowerCase();
//                 if ($.inArray(fileExtension, allowedFormats) == -1) {
//                     input.addClass("invalid");
//                     errorDiv.text("File type not allowed. Please upload jpg, jpeg, png, or pdf files.");
//                     valid = false;
//                 } else {
//                     input.removeClass("invalid");
//                     errorDiv.text(""); // Clear the error message if input is valid
//                 }
//             } else if (input.is('textarea')) {
//                 if (input.val().trim() === "") {
//                     input.addClass("invalid");
//                     errorDiv.text("Address is required");
//                     valid = false;
//                 } else {
//                     input.removeClass("invalid");
//                     errorDiv.text(""); // Clear the error message if input is valid
//                 }
//             }            
//               else {
//                 input.removeClass("invalid");
//                 errorDiv.text(""); // Clear the error message if input is valid

//                 // Other validations (PAN, email, phone, Aadhar, income, etc.) can be added here
//                 if (selector == "pancard") {
//                     if (!input.val().match(/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("PAN is not valid");
//                         valid = false;
//                     }
//                 } else if (selector == "email") {
//                     if (!input.val().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("Email is not valid");
//                         valid = false;
//                     }
//                 } else if (selector == "phone") {
//                     if (!input.val().match(/^\d{10}$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("Phone number is not valid");
//                         valid = false;
//                     }
//                 } else if (selector == "adharcard") {
//                     if (!input.val().match(/^\d{12}$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("Adhar number is not valid");
//                         valid = false;
//                     }
//                 } else if (selector == "pincode") {
//                     if (!input.val().match(/^\d{6}$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("Pincode is not valid");
//                         valid = false;
//                     }      
//                 } else if (selector == "loan_amount") {
//                     var loanAmount = parseInt(input.val());
//                      if (!/^\d+$/.test(input.val())) { // Check if input contains only digits
//                         input.addClass("invalid");
//                         errorDiv.text("Please enter a valid numerical input for loan amount");
//                         valid = false;
//                     } else if (isNaN(loanAmount) || loanAmount < 15000 || loanAmount > 50000000) {
//                         input.addClass("invalid");
//                         errorDiv.text("Loan amount should be between 15,000 and 5 crore");
//                         valid = false;
//                     } 
//                 } else if (selector == "monthly_income") {
//                     var monthlyIncome = parseInt(input.val());
//                      if (!/^\d+$/.test(input.val())) { // Check if input contains only digits
//                         input.addClass("invalid");
//                         errorDiv.text("Please enter a valid numerical input for monthly income");
//                         valid = false;
//                     } else if (isNaN(monthlyIncome) || monthlyIncome < 15000) {
//                         input.addClass("invalid");
//                         errorDiv.text("Monthly income should be more than 15,000");
//                         valid = false;
//                     }

//                 } else if (selector == "credit_score") {
//                     var creditScore = parseInt(input.val());
//                     if (!/^\d+$/.test(input.val())) { // Check if input contains only digits
//                         input.addClass("invalid");
//                         errorDiv.text("Please enter a valid numerical input for credit score");
//                         valid = false;
//                     } else if (isNaN(creditScore) || creditScore < 300 || creditScore > 900) {
//                         input.addClass("invalid");
//                         errorDiv.text("Credit score should be between 300 and 900");
//                         valid = false;
//                     } 
//                 }
//                 else if (selector == 'date_of_birth') {
//                     if (!input.val().match(/^\d{4}-\d{2}-\d{2}$/)) {
//                         input.addClass("invalid");
//                         errorDiv.text("Date of Birth is not valid");
//                         valid = false;
//                     } else {
//                         var dobParts = input.val().split('-');
//                         var dob = new Date(dobParts[0], dobParts[1] - 1, dobParts[2]); // Assuming YYYY-MM-DD format
//                         var today = new Date();
//                         var eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
//                         if (dob >= eighteenYearsAgo) {
//                             input.addClass("invalid");
//                             errorDiv.text("Age must be greater than 18 years");
//                             valid = false;
//                         }
//                         else {
//                             // Clear error message and remove "invalid" class
//                             input.removeClass("invalid");
//                             errorDiv.text("");
//                         }
//                     }
//                 }
                
//             }
        
//         });

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
