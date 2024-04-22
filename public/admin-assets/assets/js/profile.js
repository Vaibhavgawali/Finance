// Finance start

let loginAlert = () => {
    swal("Good job!", "You clicked the button!", "success");
};

let profileUpdateAlert = () => {
    swal("Good job!", "Profile Updated SuccessFully!", "success");
};

let imageUploadAlert = () => {
    swal("Good job!", "Image Uploaded SuccessFully!", "success");
};

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
        imageView.textContent = "";

        // Create an img element for src attribute
        const imgElement = document.createElement("img");
        imgElement.src = imgLink;
        imageView.style.border = 0;
        imgElement.alt = "Uploaded Image";
        imageUploadButton.style.display = "block";
        imageView.appendChild(imgElement);
    }
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});

dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    var file = e.dataTransfer.files[0];
    var reader = new FileReader();

    reader.onload = function (event) {
        $image_crop
            .croppie("bind", {
                url: event.target.result,
            })
            .then(function () {
                // console.log("jQuery bind complete");
            });
    };

    reader.readAsDataURL(file);
    $("#imageModel").modal("show");
});

// Toggle input field for gst number
document.addEventListener("DOMContentLoaded", function () {
    var gstSelect = document.getElementById("gst");
    var gstNumberField = document.getElementById("gst_number_field");

    gstSelect.addEventListener("change", function () {
        gstNumberField.style.display = this.value === "1" ? "block" : "none";
    });
});

// Toggle input field for msme number
document.addEventListener("DOMContentLoaded", function () {
    var msmeSelect = document.getElementById("msme");
    var msmeNumberField = document.getElementById("msme_number_field");

    msmeSelect.addEventListener("change", function () {
        msmeNumberField.style.display = this.value === "1" ? "block" : "none";
    });
});

// Toggle input field for other domain
document.addEventListener("DOMContentLoaded", function () {
    var domainSelect = document.getElementById("domain");
    var otherDomainField = document.getElementById("other_domain_field");

    function toggleOtherDomainField() {
        var selectedValue = domainSelect.value;
        var showOtherDomain =
            selectedValue &&
            !["Insurance", "Loan", "Sales", "Marketing", "Telecom"].includes(
                selectedValue
            );
        otherDomainField.style.display = showOtherDomain ? "block" : "none";
    }

    domainSelect.addEventListener("change", toggleOtherDomainField);
    toggleOtherDomainField();
});

$(document).ready(function () {
    //crop image
    $image_crop = $("#image_demo").croppie({
        enableExif: true,
        viewport: {
            width: 250,
            height: 250,
            type: "square",
        },
        boundary: {
            width: 300,
            height: 300,
        },
    });

    // show model to crop
    $("#profile_image").on("change", function () {
        var reader = new FileReader();
        reader.onload = function (event) {
            $image_crop
                .croppie("bind", {
                    url: event.target.result,
                })
                .then(function () {
                    // console.log("jQuery bind complete");
                });
        };
        reader.readAsDataURL(this.files[0]);
        $("#imageModel").modal("show");
    });

    // update image
    $(".crop_image").click(function (e) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $image_crop
            .croppie("result", {
                type: "canvas",
                size: "viewport",
            })
            .then(function (response) {
                e.preventDefault();

                var formData = new FormData();
                formData.append("profile_image", response);
                formData.append("_token", csrfToken);

                var url = window.location.origin + `/image-upload`;

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            $(".error-message").remove();
                            $("#image-upload-button").attr("disabled", true);

                            $("#imageModel").modal("hide");

                            imageUploadAlert();

                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);

                            return false;
                        }
                    },
                    error: function (response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            console.log(errors);

                            var validationMessages = "";

                            $.each(errors, function (field, messages) {
                                validationMessages +=
                                    '<div class="error-message invalid-feedback d-block">' +
                                    messages.join(", ") +
                                    "</div>";
                            });

                            $("#validation-messages").html(validationMessages);
                        }
                    },
                });
            });
    });

    // Basic details update function
    $("#basic_details_update_button").click(function (e) {
        var user_id = $("#user_id").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var father_name = $("#father_name").val();
        var date_of_birth = $("#date_of_birth").val();
        var pan = $("#pan").val();
        var alt_phone = $("#alt_phone").val();
        var address = $("#address").val();
        var pincode = $("#pincode").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var gst = $("#gst").val();
        var gst_number = $("#gst_number").val();
        var msme = $("#msme").val();
        var msme_number = $("#msme_number").val();

        $("#name_error").html("");
        $("#email_error").html("");
        $("#phone_error").html("");
        $("#father_name_error").html("");
        $("#date_of_birth_error").html("");
        $("#alt_phone_error").html("");
        $("#pan_error").html("");
        $("#address_error").html("");
        $("#pincode_error").html("");
        $("#state_error").html("");
        $("#city_error").html("");
        $("#msme_number_error").html("");
        $("#gst_number_error").html("");

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
            father_name == "" ||
            father_name == null ||
            father_name == "undefined" ||
            father_name == undefined
        ) {
            $("#father_name_error").html(
                '<div class=" invalid-feedback d-block">Father Name is required.</div>'
            );
            $("#father_name").focus();
            return false;
        }

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

        if (
            alt_phone != "" ||
            alt_phone != null ||
            alt_phone != "undefined" ||
            alt_phone != undefined
        ) {
            if (!validatePhoneNumber(alt_phone)) {
                $("#alt_phone_error").html(
                    '<div class=" invalid-feedback d-block">Alternate Mobile number is invalid.</div>'
                );
                $("#alt_phone").focus();
                return false;
            }
        }

        if (
            pan == "" ||
            pan == null ||
            pan == "undefined" ||
            pan == undefined
        ) {
            $("#pan_error").html(
                '<div class=" invalid-feedback d-block">Pan number is required.</div>'
            );
            $("#pan").focus();
            return false;
        }

        function validatePanNumber(pan) {
            var panPattern = /[A-Z]{5}[0-9]{4}[A-Z]{1}/;
            return panPattern.test(pan);
        }

        if (!validatePanNumber(pan)) {
            $("#pan_error").html(
                '<div class=" invalid-feedback d-block">Pan number is invalid.</div>'
            );
            $("#pan").focus();
            return false;
        }

        if (
            address == "" ||
            address == null ||
            address == "undefined" ||
            address == undefined
        ) {
            $("#address_error").html(
                '<div class=" invalid-feedback d-block">Address is required.</div>'
            );
            $("#address").focus();
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

        if (gst == "1") {
            if (
                gst_number == "" ||
                gst_number == null ||
                gst_number == "undefined" ||
                gst_number == undefined
            ) {
                $("#gst_number_error").html(
                    '<div class=" invalid-feedback d-block">Gst Number is required.</div>'
                );
                $("#gst_number").focus();
                return false;
            }
        }

        if (msme == "1") {
            if (
                msme_number == "" ||
                msme_number == null ||
                msme_number == "undefined" ||
                msme_number == undefined
            ) {
                $("#msme_number_error").html(
                    '<div class=" invalid-feedback d-block">Msme Number is required.</div>'
                );
                $("#msme_number").focus();
                return false;
            }
        }

        var data = {
            user_id: user_id,
            name: name,
            phone: phone,
            email: email,
            father_name: father_name,
            date_of_birth: date_of_birth,
            alt_phone: alt_phone,
            pan: pan,
            address: address,
            pincode: pincode,
            state: state,
            city: city,
            gst: gst,
            msme: msme,
        };

        if (gst == "1") {
            data["gst_number"] = gst_number;
        }
        if (msme == "1") {
            data["msme_number"] = msme_number;
        }

        e.preventDefault();

        var url = window.location.origin + `/basic-details-update`;
        var baseUrl = $('meta[name="base-url"]').attr("content");

        console.log(url);
        console.log(baseUrl);
        $.ajax({
            type: "PATCH",
            url: baseUrl + "/basic-details-update",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#basic_details_update_button").attr("disabled", true);
                    profileUpdateAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
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

    // Bank details update function
    $("#bank_details_update_button").click(function (e) {
        var user_id = $("#user_id").val();
        var bank_name = $("#bank_name").val();
        var acc_holder_name = $("#acc_holder_name").val();
        var ifsc_code = $("#ifsc_code").val();
        var acc_number = $("#acc_number").val();

        var facebook = $("#facebook").val();
        var instagram = $("#instagram").val();
        var linkedin = $("#linkedin").val();
        var twitter = $("#twitter").val();
        var telegram = $("#telegram").val();

        $("#bank_name_error").html("");
        $("#acc_holder_name_error").html("");
        $("#ifsc_code_error").html("");
        $("#acc_number_error").html("");

        $("#facebook_error").html("");
        $("#instagram_error").html("");
        $("#linkedin_error").html("");
        $("#twitter_error").html("");
        $("#telegram_error").html("");

        $("#bank_details_status").html("");

        if (
            bank_name == "" ||
            bank_name == null ||
            bank_name == "undefined" ||
            bank_name == undefined
        ) {
            $("#bank_name_error").html(
                '<div class=" invalid-feedback d-block">Bank Name is required.</div>'
            );
            $("#bank_name").focus();
            return false;
        }

        if (
            acc_holder_name == "" ||
            acc_holder_name == null ||
            acc_holder_name == "undefined" ||
            acc_holder_name == undefined
        ) {
            $("#acc_holder_name_error").html(
                '<div class=" invalid-feedback d-block">Account Holder Name is required.</div>'
            );
            $("#acc_holder_name").focus();
            return false;
        }

        if (
            acc_number == "" ||
            acc_number == null ||
            acc_number == "undefined" ||
            acc_number == undefined
        ) {
            $("#acc_number_error").html(
                '<div class=" invalid-feedback d-block">Account number is required.</div>'
            );
            $("#acc_number").focus();
            return false;
        }

        if (
            ifsc_code == "" ||
            ifsc_code == null ||
            ifsc_code == "undefined" ||
            ifsc_code == undefined
        ) {
            $("#ifsc_code_error").html(
                '<div class=" invalid-feedback d-block">IFSC Code is required.</div>'
            );
            $("#ifsc_code").focus();
        }

        var data = {
            user_id: user_id,
            bank_name: bank_name,
            acc_holder_name: acc_holder_name,
            acc_number: acc_number,
            ifsc_code: ifsc_code,
        };

        if (facebook) {
            data.facebook = facebook;
        }
        if (instagram) {
            data.instagram = instagram;
        }
        if (linkedin) {
            data.linkedin = linkedin;
        }
        if (twitter) {
            data.twitter = twitter;
        }
        if (telegram) {
            data.telegram = telegram;
        }

        e.preventDefault();

        var url = window.location.origin + `/bank-details-update`;

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#bank_details_update_button").attr("disabled", true);
                    profileUpdateAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                    return false;
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;

                    $(".error-message").remove();

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

    // Professional details update function
    $("#professional_details_update_button").click(function (e) {
        var user_id = $("#user_id").val();
        var profession = $("#profession").val();
        var monthly_income = $("#monthly_income").val();
        var company_name = $("#company_name").val();
        var domain = $("#domain").val();
        var other_domain = $("#other_domain").val();

        $("#profession_error").html("");
        $("#monthly_income_error").html("");
        $("#company_name_error").html("");
        $("#domain_error").html("");
        $("#other_domain_error").html("");

        $("#professional_details_status").html("");

        if (
            profession == "" ||
            profession == null ||
            profession == "undefined" ||
            profession == undefined
        ) {
            $("#profession_error").html(
                '<div class=" invalid-feedback d-block">Please select profession.</div>'
            );
            $("#profession").focus();
            return false;
        }

        if (
            monthly_income == "" ||
            monthly_income == null ||
            monthly_income == "undefined" ||
            monthly_income == undefined
        ) {
            $("#monthly_income_error").html(
                '<div class=" invalid-feedback d-block">Please select monthly income.</div>'
            );
            $("#monthly_income").focus();
            return false;
        }

        if (
            domain == "" ||
            domain == null ||
            domain == "undefined" ||
            domain == undefined
        ) {
            $("#domain_error").html(
                '<div class=" invalid-feedback d-block">Please select domain.</div>'
            );
            $("#domain").focus();
            return false;
        }

        if (domain == "Other") {
            if (
                other_domain == "" ||
                other_domain == null ||
                other_domain == "undefined" ||
                other_domain == undefined
            ) {
                $("#other_domain_error").html(
                    '<div class=" invalid-feedback d-block">Domain name is required.</div>'
                );
                $("#other_domain").focus();
                return false;
            }
        }

        var data = {
            user_id: user_id,
            profession: profession,
            monthly_income: monthly_income,
            domain: domain,
        };

        if (company_name) {
            data.company_name = company_name;
        }
        if (domain == "Other") {
            data.other_domain = other_domain;
        }

        e.preventDefault();

        var url = window.location.origin + `/professional-details-update`;

        $.ajax({
            type: "PATCH",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#professional_details_update_button").attr(
                        "disabled",
                        true
                    );
                    profileUpdateAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                    return false;
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;

                    $(".error-message").remove();

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

    // kyc details add function
    $("#kyc_details_add_button").click(function (e) {
        e.preventDefault();

        var user_id = $("#id").val();
        var panCardFile = $("#pan_card")[0].files[0];
        var cancelChequeFile = $("#cancel_cheque")[0].files[0];
        var addressProofName = $("#address_proof_name").val();
        var documentNumber = $("#document_number").val();
        var addressProofFile = $("#address_proof")[0].files[0];
        var partnerPhotoFile = $("#partner_photo")[0].files[0];

        $("#pan_card_error").html("");
        $("#cancel_cheque_error").html("");
        $("#document_number_error").html("");
        $("#address_proof_error").html("");
        $("#partner_photo_error").html("");
        $("#document_number_error").html("");

        $("#kyc_details_status").html("");

        if (!panCardFile) {
            $("#pan_card_error").html(
                '<div class="invalid-feedback d-block">PAN card file must be required.</div>'
            );
            return false;
        }

        if (panCardFile && panCardFile.size > 2 * 1024 * 1024) {
            $("#pan_card_error").html(
                '<div class="invalid-feedback d-block">PAN card file must be less than 2MB.</div>'
            );
            return false;
        }

        if (!cancelChequeFile) {
            $("#cancel_cheque_error").html(
                '<div class="invalid-feedback d-block">Cancel Cheque file must be required.</div>'
            );
            return false;
        }

        if (cancelChequeFile && cancelChequeFile.size > 2 * 1024 * 1024) {
            $("#cancel_cheque_error").html(
                '<div class="invalid-feedback d-block">Cancel Cheque file must be less than 2MB.</div>'
            );
            return false;
        }

        if (
            addressProofName == "" ||
            addressProofName == null ||
            addressProofName == "undefined" ||
            addressProofName == undefined
        ) {
            $("#address_proof_name_error").html(
                '<div class=" invalid-feedback d-block">Please select address proof document.</div>'
            );
            $("#address_proof_name").focus();
            return false;
        }

        if (
            documentNumber == "" ||
            documentNumber == null ||
            documentNumber == "undefined" ||
            documentNumber == undefined
        ) {
            $("#document_number_error").html(
                '<div class=" invalid-feedback d-block">Please enter document number.</div>'
            );
            $("#document_number").focus();
            return false;
        }

        if (!addressProofFile) {
            $("#address_proof_error").html(
                '<div class="invalid-feedback d-block">Address proof file must be required.</div>'
            );
            return false;
        }

        if (addressProofFile && addressProofFile.size > 2 * 1024 * 1024) {
            $("#address_proof_error").html(
                '<div class="invalid-feedback d-block">Address proof file must be less than 2MB.</div>'
            );
            return false;
        }

        if (!partnerPhotoFile) {
            $("#partner_photo_error").html(
                '<div class="invalid-feedback d-block">Partner photo must be required.</div>'
            );
            return false;
        }

        if (partnerPhotoFile && partnerPhotoFile.size > 2 * 1024 * 1024) {
            $("#partner_photo_error").html(
                '<div class="invalid-feedback d-block">Partner photo must be less than 2MB.</div>'
            );
            return false;
        }

        var formData = new FormData();
        formData.append("user_id", user_id);
        formData.append("pan_card", panCardFile);
        formData.append("cancel_cheque", cancelChequeFile);
        formData.append("address_proof_name", addressProofName);
        formData.append("document_number", documentNumber);
        formData.append("address_proof", addressProofFile);
        formData.append("partner_photo", partnerPhotoFile);

        var baseUrl = $('meta[name="base-url"]').attr("content");

        $.ajax({
            url: baseUrl + "/kyc-details-add",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#kyc_details_update_button").attr("disabled", true);
                    resumeUploadAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);

                    return false;
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $(".error-message").remove();

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

    // update document
    $(".update-button").click(function (e) {
        e.preventDefault();
        var documentType = $(this).data("document-type");
        var formGroup = $(this).closest(".form-group");
        var fileInput = formGroup.find('input[type="file"]');
        var addressProofName = $("#address_proof_name").val();
        var documentNumber = $("#document_number").val();

        // Remove any existing error containers
        formGroup.find(".document-error").remove();

        // Check if file input has a value
        if (!fileInput.val()) {
            var errorContainer = $(
                '<div class="document-error invalid-feedback d-block">File must be required.</div>'
            );
            fileInput.after(errorContainer);
            return false;
        }

        // Get the selected file
        var file = fileInput[0].files[0];

        var acceptableTypes;
        if (documentType === "partner_photo") {
            acceptableTypes = ["image/jpeg", "image/png", "image/jpg"];
        } else {
            acceptableTypes = [
                "image/jpeg",
                "image/png",
                "image/jpg",
                "application/pdf",
            ];
        }

        // Check if the file type is acceptable
        if (!acceptableTypes.includes(file.type)) {
            if (documentType === "partner_photo") {
                var errorContainer = $(
                    '<div class="document-error invalid-feedback d-block">Please select a valid file format jpg,jpeg or png.</div>'
                );
            } else {
                var errorContainer = $(
                    '<div class="document-error invalid-feedback d-block">Please select a valid file format jpg,jpeg,png or pdf.</div>'
                );
            }
            fileInput.after(errorContainer);
            return false;
        }

        if (documentType === "address_proof") {
            if (
                addressProofName == "" ||
                addressProofName == null ||
                addressProofName == "undefined" ||
                addressProofName == undefined
            ) {
                $("#address_proof_name_error").html(
                    '<div class=" invalid-feedback d-block">Please select address proof document.</div>'
                );
                $("#address_proof_name").focus();
                return false;
            }

            if (
                documentNumber == "" ||
                documentNumber == null ||
                documentNumber == "undefined" ||
                documentNumber == undefined
            ) {
                $("#document_number_error").html(
                    '<div class=" invalid-feedback d-block">Please enter document number.</div>'
                );
                $("#document_number").focus();
                return false;
            }
        }

        var formData = new FormData();
        formData.append("document_type", documentType);
        formData.append("file", fileInput[0].files[0]);

        if (documentType === "address_proof") {
            formData.append("document_number", documentNumber);
            formData.append("address_proof_name", addressProofName);
        }

        // return false;
        var baseUrl = $('meta[name="base-url"]').attr("content");

        $.ajax({
            url: baseUrl + "/kyc-details-update",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status == true) {
                    $(".error-message").remove();
                    $("#kyc_details_update_button").attr("disabled", true);
                    resumeUploadAlert();

                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);

                    return false;
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $(".error-message").remove();

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
