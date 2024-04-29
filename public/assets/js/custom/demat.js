$(document).ready(function () {
    $("#demat_btn").click(function (e) {
        e.preventDefault();

        var name = $("#name").val();
        var phone = $("#phone").val();
        var pan_num = $("#pan_num").val();
        var adhar_num = $("#adhar_num").val();
        var bank = $("#bank").val();

        $("#name_error").html("");
        $("#phone_error").html("");
        $("#pan_num_error").html("");
        $("#adhar_num_error").html("");
        $("#bank_error").html("");

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
            pan_num == "" ||
            pan_num == null ||
            pan_num == "undefined" ||
            pan_num == undefined
        ) {
            $("#pan_num_error").html(
                '<div class=" invalid-feedback d-block">Pan number is required.</div>'
            );
            $("#pan_num").focus();
            return false;
        }

        // PAN format validation (Assuming PAN consists of 10 alphanumeric characters)
        var panPattern = /[A-Z]{5}[0-9]{4}[A-Z]{1}/;
        if (!panPattern.test(pan_num)) {
            $("#pan_num_error").html(
                '<div class="invalid-feedback d-block">Invalid PAN number format.</div>'
            );
            $("#pan_num").focus();
            return false;
        }

        if (
            adhar_num == "" ||
            adhar_num == null ||
            adhar_num == "undefined" ||
            adhar_num == undefined
        ) {
            $("#adhar_num_error").html(
                '<div class=" invalid-feedback d-block">Aadhar number is required.</div>'
            );
            $("#adhar_num").focus();
            return false;
        }

        // Aadhar format validation (Assuming Aadhar consists of 12 digits)
        var adharPattern = /^\d{12}$/;
        if (!adharPattern.test(adhar_num)) {
            $("#adhar_num_error").html(
                '<div class="invalid-feedback d-block">Invalid Aadhar number format.</div>'
            );
            $("#adhar_num").focus();
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
        if (
            bank == "" ||
            bank == null ||
            bank == "undefined" ||
            bank == undefined
        ) {
            $("#bank_error").html(
                '<div class=" invalid-feedback d-block">Bank name is required.</div>'
            );
            $("#bank").focus();
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

        var data = {
            name: name,
            phone: phone,
            pan_num: pan_num,
            adhar_num: adhar_num,
            bank: bank,
        };

        $("#demat_btn").attr("disabled", true);
        var url = window.location.origin + "/demat";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                let reditectUrl = "";
                if (data.bank == `hdfc`) {
                    reditectUrl = `https://hdfcsky.page.link/u9fo`;
                } else if (data.bank == `icici`) {
                    reditectUrl = `https://secure.icicidirect.com/accountopening?rmcode=BLAR1122`;
                }
                window.open(`${reditectUrl}`);

                if (response.status == true) {
                    $(".error-message").remove();
                    $("#demat_btn").attr("disabled", true);
                    swal({
                        title: "Success!",
                        text: "Demat account application submitted successfully.",
                        icon: "success",
                        button: "OK",
                        closeOnClickOutside: false,
                    });
                    return false;
                }
            },

            error: function (response) {
                console.log(response.status);
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    console.log(errors);
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
                    $("#demat_btn").attr("disabled", false);
                }
            },
        });
    });
});
