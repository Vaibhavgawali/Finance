// Alert Box


let loginAlert = () => {
    swal("Good job!", "You clicked the button!", "success");
};
let profileUpdateAlert = () => {
    swal("Good job!", "Profile Updated SuccessFully!", "success");
}
let addressUpdateAlert = () => {
    swal("Good job!", "Address Updated SuccessFully!", "success");
}
let experienceAddAlert = () => {
    swal("Good job!", "Experience Added SuccessFully!", "success");
}
let experienceUpdateAlert = () => {
    swal("Good job!", "Experience Updated SuccessFully!", "success");
}

let imageUploadAlert = () => {
    swal("Good job!", "Image Uploaded SuccessFully!", "success");
};
let resumeUploadAlert = () => {
    swal("Good job!", "Resume Uploaded SuccessFully!", "success");
};
let requirementsAlert = () => {
    swal("Nice!", "We will get back to you soon!", "success");
};


$(document).ready(function () {
    // Reuirements  Update function
    $("#requirement_text_submit_button").click(function (event) {
        // console.log("clicked");
        var requirement_text = $("#requirement_text").val();
        var user_id = $("#user_id").val();
        // console.log(requirement_text);

        $("#requirement_text_error").html("");

        if (
            requirement_text == "" ||
            requirement_text == null ||
            requirement_text == "undefined" ||
            requirement_text == undefined
        ) {
            $("#requirement_text_error").html(
                '<div class=" invalid-feedback d-block">Query is required.</div>'
            );
            $("#requirement_text").focus();
            // console.log("Error");
            return false;
        }
        var data = {
            requirement_text: requirement_text,
            user_id: user_id,
        };
        // console.log(data);

        event.preventDefault();

        var url = window.location.origin + `/requirements`;
        // console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#requirement_text_submit_button").attr("disabled", true);
                    requirementsAlert();
                    // Optional: You can add a delay before reloading the page
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed
                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("profile_image");
const imageView = document.getElementById("image-view");
const imageUploadButton = document.getElementById("image-upload-button");

inputFile.addEventListener("change", uploadImage);

function uploadImage() {
    // Get the file from the input
    const file = inputFile.files[0];

    if (file) {
        // Create an object URL for the file
        let imgLink = URL.createObjectURL(file);

        // Set background image using background-image property
        //   imageView.style.backgroundImage = `url(${imgLink})`;
        //   imageView.style.backgroundRepeat = 'no-repeat';

        // Clear text content (not necessary when using background image)
        imageView.textContent = "";

        // Create an img element for src attribute
        const imgElement = document.createElement("img");
        imgElement.src = imgLink;
        imageView.style.border = 0;
        imgElement.alt = "Uploaded Image";
        imageUploadButton.style.display = "block";
        //   imageUploadButton.style.textAlign="center";

        // Append the img element to the image view
        imageView.appendChild(imgElement);
    }
}
dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});

dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});

$(document).ready(function () {
    // Profile Image Upload function
    $("#image-upload-button").click(function (event) {
        var formData = new FormData($("#Profile-image-upload-form")[0]);

        $("#profile_image_error").html("");

        event.preventDefault();

        var url = window.location.origin + `/image-upload`;
        // console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#image-upload-button").attr("disabled", true);
                    imageUploadAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1500); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function (e) {
    //cv update method
    $("#profile_cv_update-1_button").click(function () {
        var formData = new FormData($("#profile_update_cv_form")[0]);
        var user_id = $("#user_id").val().trim();
        user_id = parseInt(user_id);

        // Get base URL from meta tag
        var baseUrl = $('meta[name="base-url"]').attr("content");

        $.ajax({
            url: baseUrl + `/user-documents-update/${user_id}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_cv_update-1_button").attr("disabled", true);
                    resumeUploadAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.message;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    $("#profile_cv_update_button").click(function () {
        var formData = new FormData($("#profile_cv_form")[0]);
        var url = window.location.origin + `/user-documents`;
        // Get base URL from meta tag
        var baseUrl = $('meta[name="base-url"]').attr("content");

        // e.preventDefault();
        $.ajax({
            url: baseUrl + "/user-documents",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_cv_update_button").attr("disabled", true);
                    resumeUploadAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function (e) {
    $("#profile_cv_update_button").click(function () {
        var formData = new FormData($("#profile_cv_form")[0]);
        var url = window.location.origin + `/user-documents`;
        // Get base URL from meta tag
        var baseUrl = $('meta[name="base-url"]').attr("content");

        e.preventDefault();
        $.ajax({
            url: baseUrl + "/user-documents",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_cv_update_button").attr("disabled", true);
                    resumeUploadAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    // Profile info Update function
    $("#profile_info_update_button").click(function (event) {
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var user_id = $("#user_id").val();

        $("#name_error").html("");
        $("#phone_error").html("");
        $("#email_error").html("");

        $("#profile_info_status").html("");

        if (
            name == "" ||
            name == null ||
            name == "undefined" ||
            name == undefined
        ) {
            $("#name_error").html(
                '<div class=" invalid-feedback d-block">Full Name is required.</div>'
            );
            $("#name").focus();
            return false;
        }

        if (
            phone == "" ||
            phone == null ||
            phone == "undefined" ||
            phone == undefined
        ) {
            $("#phone_error").html(
                '<div class=" invalid-feedback d-block">Mobile number is required.</div>'
            );
            $("#phone").focus();
            return false;
        }

        function validatePhoneNumber(phone) {
            var phonePattern = /^[6-9]\d{9}$/;
            return phonePattern.test(phone);
        }

        if (!validatePhoneNumber(phone)) {
            $("#phone_error").html(
                '<div class=" invalid-feedback d-block">Mobile number is invalid.</div>'
            );
            $("#phone").focus();
            return false;
        }

        if (
            email == "" ||
            email == null ||
            email == "undefined" ||
            email == undefined
        ) {
            $("#email_error").html(
                '<div class=" invalid-feedback d-block">Email Id is required.</div>'
            );
            $("#email").focus();
            return false;
        }

        function validateEmail($email) {
            var emailReg =
                /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            return emailReg.test($email);
        }

        if (!validateEmail(email)) {
            $("#email_error").html(
                '<div class=" invalid-feedback d-block">Email Id is invalid.</div>'
            );
            $("#email").focus();
            return false;
        }

        var data = {
            name: name,
            phone: phone,
            email: email,
            user_id: user_id,
        };
        function extractAndConvertToInteger(str) {
            const trimmedStr = str.trim(); // Trim leading and trailing spaces
            const numericPart = trimmedStr.replace(/\D/g, ""); // Remove non-numeric characters
            return parseInt(numericPart, 10); // Convert to integer
        }

        // Update the user_id value in the data object
        data.user_id = extractAndConvertToInteger(data.user_id);
        // console.log(data);

        event.preventDefault();

        var url = window.location.origin + `/candidate/${user_id.trim()}`;
        // console.log(url);

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_info_update_button").attr("disabled", true);
                     profileUpdateAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages.join(", ") +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    ///    Profile Details Update Function
    $("#profile_details_update_button").click(function (event) {
        var date_of_birth = $("#date_of_birth").val();
        var gender = $("#gender").val();
        var age = $("#age").val();
        var preffered_line = $("#preffered_line").val();
        var other_preffered_line = $("#other_preffered_line").val();
        var spoc = $("#spoc").val();
        var user_id = $("#user_id").val();


        $("#date_of_birth_error").html("");
        $("#gender_error").html("");
        $("#age_error").html("");
        $("#preffered_line_error").html("");
        $("#spoc_error").html("");
        // console.log(other_preffered_line)
        $("#profile_details_status").html("");

        if (
            date_of_birth == "" ||
            date_of_birth == null ||
            date_of_birth == "undefined" ||
            date_of_birth == undefined
        ) {
            $("#date_of_birth_error").html(
                '<div class=" invalid-feedback d-block">Date Of Birth is required.</div>'
            );
            $("#date_of_birth").focus();
            return false;
        }
        if(preffered_line =="other")
        {
            preffered_line = other_preffered_line
        }

        if (
            gender == "" ||
            gender == null ||
            gender == "undefined" ||
            gender == undefined
        ) {
            $("#gender_error").html(
                '<div class=" invalid-feedback d-block">Gender is required.</div>'
            );
            $("#gender").focus();
            return false;
        }


        if (
            age == "" ||
            age == null ||
            age == "undefined" ||
            age == undefined
        ) {
            $("#age_error").html(
                '<div class=" invalid-feedback d-block">Age is required.</div>'
            );
            $("#age").focus();
            return false;
        }

        var data = {
            date_of_birth: date_of_birth,
            gender: gender,
            age: age,
            preffered_line: preffered_line,
            spoc: spoc,
            user_id: user_id,
        };
        function extractAndConvertToInteger(str) {
            const trimmedStr = str.trim(); // Trim leading and trailing spaces
            const numericPart = trimmedStr.replace(/\D/g, ""); // Remove non-numeric characters
            return parseInt(numericPart, 10); // Convert to integer
        }

        // Update the user_id value in the data object
        data.user_id = extractAndConvertToInteger(data.user_id);
        // console.log(data);

        event.preventDefault();

        var url = window.location.origin + `/user-profile/${user_id.trim()}`;
        // console.log(url);

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_details_update_button").attr("disabled", true);
                    profileUpdateAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
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
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    ///    Profile Address Update Function
    $("#profile_address_update_button").click(function (event) {
        var city = $("#city").val();
        var pincode = $("#pincode").val();
        var state = $("#state").val();
        var country = $("#country").val();
        var line1 = $("#line1").val();
        var line2 = $("#line2").val();
        var line3 = $("#line3").val();
        var user_id = $("#user_id").val();

        $("#city_error").html("");
        $("#pincode_error").html("");
        $("#state_error").html("");
        $("#country_error").html("");
        $("#line1_error").html("");
        $("#line2_error").html("");
        $("#line3_error").html("");

        $("#profile_status").html("");

        if (
            city == "" ||
            city == null ||
            city == "undefined" ||
            city == undefined
        ) {
            $("#city_error").html(
                '<div class=" invalid-feedback d-block">City is required.</div>'
            );
            $("#city").focus();
            return false;
        }

        if (
            pincode == "" ||
            pincode == null ||
            pincode == "undefined" ||
            pincode == undefined
        ) {
            $("#pincode_error").html(
                '<div class=" invalid-feedback d-block">Pincode is required.</div>'
            );
            $("#pincode").focus();
            return false;
        }

        if (
            state == "" ||
            state == null ||
            state == "undefined" ||
            state == undefined
        ) {
            $("#state_error").html(
                '<div class=" invalid-feedback d-block">State is required.</div>'
            );
            $("#state").focus();
            return false;
        }

        if (
            country == "" ||
            country == null ||
            country == "undefined" ||
            country == undefined
        ) {
            $("#country_error").html(
                '<div class=" invalid-feedback d-block">Country is required.</div>'
            );
            $("#country").focus();
            return false;
        }
        // if (
        //     line1 == "" ||
        //     line1 == null ||
        //     line1 == "undefined" ||
        //     line1 == undefined
        // ) {
        //     $("#line1_error").html(
        //         '<div class=" invalid-feedback d-block">Address Line 1 is required.</div>'
        //     );
        //     $("#line1").focus();
        //     return false;
        // }
        // if (
        //     line2 == "" ||
        //     line2 == null ||
        //     line2 == "undefined" ||
        //     line2 == undefined
        // ) {
        //     $("#line2_error").html(
        //         '<div class=" invalid-feedback d-block">Address Line 2 is required.</div>'
        //     );
        //     $("#line2").focus();
        //     return false;
        // }

        // if (
        //     line3 == "" ||
        //     line3 == null ||
        //     line3 == "undefined" ||
        //     line3 == undefined
        // ) {
        //     $("#line3_error").html(
        //         '<div class=" invalid-feedback d-block">Address Line 3 is required.</div>'
        //     );
        //     $("#line3").focus();
        //     return false;
        // }

        var data = {
            city: city,
            pincode: pincode,
            state: state,
            country: country,
            line1: line1,
            line2: line2,
            line3: line3,
        };
        function extractAndConvertToInteger(str) {
            const trimmedStr = str.trim(); // Trim leading and trailing spaces
            const numericPart = trimmedStr.replace(/\D/g, ""); // Remove non-numeric characters
            return parseInt(numericPart, 10); // Convert to integer
        }

        // Update the user_id value in the data object
        // console.log(data);

        event.preventDefault();

        var url = window.location.origin + `/user-address/${user_id.trim()}`;
        // console.log(url);

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_address_update_button").attr("disabled", true);
                    addressUpdateAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
                // console.log(response);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    // console.log(errors);

                    $(".error-message").remove();

                    // Display new errors
                    $.each(errors, function (field, messages) {
                        // console.log(messages); // messages is an array

                        var input = $('[name="' + field + '"]');
                        input.after(
                            '<div class="error-message invalid-feedback d-block">' +
                                messages[0] +
                                "</div>"
                        );
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    // Profile Experience Update function
    $("#profile_experience_update_button").click(function (event) {
        var is_current_company = $("#is_current_company").val();
        var organization = $("#organization").val();
        var designation = $("#designation").val();
        var ctc = $("#ctc").val();
        var job_profile_description = $("#job_profile_description").val();
        var state = $("#job_state").val();
        var experience_year = $("#experience_year").val();
        // var joining_date = $("#joining_date").val();
        // var relieving_date = $("#relieving_date").val();
        var user_id = $("#user_id").val();

        $("#is_current_company_error").html("");
        $("#organization_error").html("");
        $("#designation_error").html("");
        $("#ctc_error").html("");
        $("#job_profile_description_error").html("");
        $("#job_state_error").html("");
        $("#experience_year_error").html("");
        // $("#joining_date_error").html("");
        // $("#relieving_date_error").html("");

        $("#profile_experience_status").html("");

        if (
            is_current_company == "" ||
            is_current_company == null ||
            is_current_company == "undefined" ||
            is_current_company == undefined
        ) {
            $("#is_current_company_error").html(
                '<div class=" invalid-feedback d-block">Current Company  is required.</div>'
            );
            $("#is_current_company").focus();
            return false;
        }

        if (
            organization == "" ||
            organization == null ||
            organization == "undefined" ||
            organization == undefined
        ) {
            $("#organization_error").html(
                '<div class=" invalid-feedback d-block">Organization is required.</div>'
            );
            $("#organization").focus();
            return false;
        }

        if (
            designation == "" ||
            designation == null ||
            designation == "undefined" ||
            designation == undefined
        ) {
            $("#designation_error").html(
                '<div class=" invalid-feedback d-block">Designation  is required.</div>'
            );
            $("#designation").focus();
            return false;
        }

        if (
            ctc == "" ||
            ctc == null ||
            ctc == "undefined" ||
            ctc == undefined
        ) {
            $("#ctc_error").html(
                '<div class=" invalid-feedback d-block">CTC  is required.</div>'
            );
            $("#ctc").focus();
            return false;
        }

        if (
            job_profile_description == "" ||
            job_profile_description == null ||
            job_profile_description == "undefined" ||
            job_profile_description == undefined
        ) {
            $("#job_profile_description_error").html(
                '<div class=" invalid-feedback d-block">Job description  is required.</div>'
            );
            $("#job_profile_description").focus();
            return false;
        }

        if (
            state == "" ||
            state == null ||
            state == "undefined" ||
            state == undefined
        ) {
            $("#job_state_error").html(
                '<div class=" invalid-feedback d-block">Job state  is required.</div>'
            );
            $("#job_state").focus();
            return false;
        }

        if (
            experience_year == "" ||
            experience_year == null ||
            experience_year == "undefined" ||
            experience_year == undefined
        ) {
            $("#experience_year_error").html(
                '<div class=" invalid-feedback d-block">Experience is required.</div>'
            );
            $("#experience_year").focus();
            return false;
        }

        var data = {
            is_current_company: is_current_company,
            organization: organization,
            designation: designation,
            ctc: ctc,
            state: state,
            job_profile_description: job_profile_description,
            experience_year: experience_year,
            // joining_date: joining_date,
            // relieving_date: relieving_date,
        };
        // function extractAndConvertToInteger(str) {
        //     const trimmedStr = str.trim(); // Trim leading and trailing spaces
        //     const numericPart = trimmedStr.replace(/\D/g, ''); // Remove non-numeric characters
        //     return parseInt(numericPart, 10); // Convert to integer
        // }

        // Update the user_id value in the data object
        // data.user_id = extractAndConvertToInteger(data.user_id);
        // console.log(data);

        event.preventDefault();

        var url = window.location.origin + `/user-experience/${user_id.trim()}`;
        // console.log(url);

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_experience_update_button").attr(
                        "disabled",
                        true
                    );
                    experienceUpdateAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
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
                    });
                }
            },
        });
    });
});

$(document).ready(function () {
    // Profile Experience Add function
    $("#profile_experience_add_button").click(function (event) {
        var is_current_company = $("#is_current_company").val();
        var organization = $("#organization").val();
        var designation = $("#designation").val();
        var ctc = $("#ctc").val();
        var job_profile_description = $("#job_profile_description").val();
        var state = $("#job_state").val();
        var experience_year = $("#experience_year").val();
        // var joining_date = $("#joining_date").val();
        // var relieving_date = $("#relieving_date").val();
        var user_id = $("#user_id").val();

        $("#is_current_company_error").html("");
        $("#organization_error").html("");
        $("#designation_error").html("");
        $("#ctc_error").html("");
        $("#job_profile_description_error").html("");
        $("#job_state_error").html("");
        $("#experience_year_error").html("");
        // $("#joining_date_error").html("");
        // $("#relieving_date_error").html("");

        $("#profile_experience_status").html("");

        if (
            is_current_company == "" ||
            is_current_company == null ||
            is_current_company == "undefined" ||
            is_current_company == undefined
        ) {
            $("#is_current_company_error").html(
                '<div class=" invalid-feedback d-block">Current Company  is required.</div>'
            );
            $("#is_current_company").focus();
            return false;
        }

        if (
            organization == "" ||
            organization == null ||
            organization == "undefined" ||
            organization == undefined
        ) {
            $("#organization_error").html(
                '<div class=" invalid-feedback d-block">Organization is required.</div>'
            );
            $("#organization").focus();
            return false;
        }

        if (
            designation == "" ||
            designation == null ||
            designation == "undefined" ||
            designation == undefined
        ) {
            $("#designation_error").html(
                '<div class=" invalid-feedback d-block">Designation  is required.</div>'
            );
            $("#designation").focus();
            return false;
        }

        if (
            ctc == "" ||
            ctc == null ||
            ctc == "undefined" ||
            ctc == undefined
        ) {
            $("#ctc_error").html(
                '<div class=" invalid-feedback d-block">CTC  is required.</div>'
            );
            $("#ctc").focus();
            return false;
        }

        if (
            job_profile_description == "" ||
            job_profile_description == null ||
            job_profile_description == "undefined" ||
            job_profile_description == undefined
        ) {
            $("#job_profile_description_error").html(
                '<div class=" invalid-feedback d-block">Job description  is required.</div>'
            );
            $("#job_profile_description").focus();
            return false;
        }

        if (
            state == "" ||
            state == null ||
            state == "undefined" ||
            state == undefined
        ) {
            $("#job_state_error").html(
                '<div class=" invalid-feedback d-block">Job state  is required.</div>'
            );
            $("#job_state").focus();
            return false;
        }

        if (
            experience_year == "" ||
            experience_year == null ||
            experience_year == "undefined" ||
            experience_year == undefined
        ) {
            $("#experience_year_error").html(
                '<div class=" invalid-feedback d-block">Joining date   is required.</div>'
            );
            $("#experience_year").focus();
            return false;
        }

        var data = {
            is_current_company: is_current_company,
            organization: organization,
            designation: designation,
            ctc: ctc,
            state: state,
            job_profile_description: job_profile_description,
            experience_year: experience_year,
            // joining_date: joining_date,
            // relieving_date: relieving_date,
            user_id: user_id,
        };

        event.preventDefault();

        var url = window.location.origin + `/user-experience`;
        // console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#profile_experience_add_button").attr("disabled", true);
                    experienceAddAlert();

                    // Optional: You can add a delay before reloading the page
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000); // 2000 milliseconds (2 seconds) delay, adjust as needed

                    return false;
                }
            },
            error: function (response) {
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
                    });
                }
            },
        });
    });
});



