let RegisteredAlert = () => {
    swal("Good job!", "Registered sucessfully!", "success");
};

$(document).ready(function () {
    $("#candidate_register_button").click(function (event) {
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();

        var experience = $("#experience").val();
        var organization = $("#organization").val();
        var designation = $("#designation").val();
        var experience_year = $("#experience_year").val();
        // var joining_date = $("#joining_date").val();
        // var relieving_date = $("#relieving_date").val();
        var ctc = $("#ctc").val();

        var preffered_line = $("#preffered_line").val();
        var city = $("#city").val();

        $("#name_error").html("");
        $("#phone_error").html("");
        $("#email_error").html("");
        $("#password_error").html("");
        $("#password_confirmation_error").html("");
        $("#city_error").html("");

        $("#experience_error").html("");
        $("#organization_error").html("");
        $("#designation_error").html("");
        $("#ctc_error").html("");
        $("#experience_year_error").html("");
        // $("#joining_date_error").html("");

        $("#preffered_line_error").html("");
        $("#flexCheckDefault_error").html("");

        $("#register_status").html("");

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

        if (
            password == "" ||
            password == null ||
            password == "undefined" ||
            password == undefined
        ) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password is required.</div>'
            );
            $("#password").focus();
            return false;
        }

        function validatePassword(password) {
            // Minimum 8 characters, at least one uppercase letter,
            // one lowercase letter, one number, and one special character
            var passwordRegex =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            return passwordRegex.test(password);
        }

        if (!validatePassword(password)) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>'
            );
            $("#password").focus();
            return false;
        }

        if (password_confirmation !== password) {
            $("#password_confirmation_error").html(
                '<div class=" invalid-feedback d-block">Confirm password do not match with password.</div>'
            );
            $("#password_confirmation").focus();
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

        if (
            experience == "" ||
            experience == null ||
            experience == "undefined" ||
            experience == undefined
        ) {
            $("#experience_error").html(
                '<div class=" invalid-feedback d-block">Work status is required.</div>'
            );
            $("#experience").focus();
            return false;
        }

        if (experience == "experienced") {
            if (
                organization == "" ||
                organization == null ||
                organization == "undefined" ||
                organization == undefined
            ) {
                $("#organization_error").html(
                    '<div class=" invalid-feedback d-block">Current organization is required.</div>'
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
                    '<div class=" invalid-feedback d-block">Current role is required.</div>'
                );
                $("#designation").focus();
                return false;
            }

            if (
                experience_year == "" ||
                experience_year == null ||
                experience_year == "undefined" ||
                experience_year == undefined
            ) {
                $("#experience_year_error").html(
                    '<div class=" invalid-feedback d-block">Experience in year is required.</div>'
                );
                $("#experience_year").focus();
                return false;
            }

            if (
                ctc == "" ||
                ctc == null ||
                ctc == "undefined" ||
                ctc == undefined
            ) {
                $("#ctc_error").html(
                    '<div class=" invalid-feedback d-block">Ctc is required.</div>'
                );
                $("#ctc").focus();
                return false;
            }
        }

        if (
            preffered_line == "" ||
            preffered_line == null ||
            preffered_line == "undefined" ||
            preffered_line == undefined
        ) {
            $("#preffered_line_error").html(
                '<div class=" invalid-feedback d-block">Please select preffered line is required</div>'
            );
            $("#preffered_line").focus();
            return false;
        } else if (preffered_line.length > 60) {
            $("#preffered_line_error").html(
                '<div class=" invalid-feedback d-block">Preffered line must not be greater than 60 characters</div>'
            );
            $("#preffered_line").focus();
            return false;
        }

        if ($("#flexCheckDefault").prop("checked") == false) {
            $("#flexCheckDefault_error").html(
                '<div class=" invalid-feedback d-block">Agree terms & condition is required.</div>'
            );
            return false;
        } else {
            terms_and_policy = "1";
        }

        var data = {
            name: name,
            phone: phone,
            email: email,
            password: password,
            city: city,
            experience: experience,
            preffered_line: preffered_line,
            password_confirmation: password_confirmation,
        };

        if (experience == "experienced") {
            data["organization"] = organization;
            data["designation"] = designation;
            data["experience_year"] = experience_year;
            // data["joining_date"] = joining_date;
            // data["relieving_date"] = relieving_date;
            data["ctc"] = ctc;
        }

        // console.log(data);

        event.preventDefault();
        // var formData = $("#candidate_register_form").serialize();

        var url = window.location.origin + "/candidate";
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

                    $("#candidate_register_button").attr("disabled", true);
                    RegisteredAlert();
                    $("#candidate_register_form")[0].reset();
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

    $("#insurer_register_button").click(function (event) {
        var name = $("#name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();
        var city = $("#city").val();
        var spoc = $("#spoc").val();
        var preffered_line = $("#preffered_line").val();

        $("#name_error").html("");
        $("#phone_error").html("");
        $("#email_error").html("");
        $("#password_error").html("");
        $("#password_confirmation_error").html("");
        $("#city_error").html("");
        $("#spoc_error").html("");
        $("#preffered_line_error").html("");
        $("#flexCheckDefault_error").html("");

        $("#register_status").html("");

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

        if (
            password == "" ||
            password == null ||
            password == "undefined" ||
            password == undefined
        ) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password is required.</div>'
            );
            $("#password").focus();
            return false;
        }

        if (password_confirmation !== password) {
            $("#password_confirmation_error").html(
                '<div class=" invalid-feedback d-block">Confirm password do not match with password.</div>'
            );
            $("#password_confirmation").focus();
            return false;
        }

        function validatePassword(password) {
            // Minimum 8 characters, at least one uppercase letter,
            // one lowercase letter, one number, and one special character
            var passwordRegex =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            return passwordRegex.test(password);
        }

        if (!validatePassword(password)) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>'
            );
            $("#password").focus();
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

        if (
            spoc == "" ||
            spoc == null ||
            spoc == "undefined" ||
            spoc == undefined
        ) {
            $("#spoc_error").html(
                '<div class=" invalid-feedback d-block">SPOC is required</div>'
            );
            $("#spoc").focus();
            return false;
        }

        if (
            preffered_line == "" ||
            preffered_line == null ||
            preffered_line == "undefined" ||
            preffered_line == undefined
        ) {
            $("#preffered_line_error").html(
                '<div class=" invalid-feedback d-block">Please select preffered line is required</div>'
            );
            $("#preffered_line").focus();
            return false;
        } else if (preffered_line.length > 60) {
            $("#preffered_line_error").html(
                '<div class=" invalid-feedback d-block">Preffered line must not be greater than 60 characters</div>'
            );
            $("#preffered_line").focus();
            return false;
        }

        if ($("#flexCheckDefault").prop("checked") == false) {
            $("#flexCheckDefault_error").html(
                '<div class=" invalid-feedback d-block">Agree terms & condition is required.</div>'
            );
            return false;
        } else {
            terms_and_policy = "1";
        }

        var data = {
            name: name,
            phone: phone,
            email: email,
            password: password,
            password_confirmation: password_confirmation,
            city: city,
            spoc: spoc,
            preffered_line: preffered_line,
        };

        event.preventDefault();

        var url = window.location.origin + "/insurer";
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

                    $("#insurer_register_button").attr("disabled", true);
                    RegisteredAlert();
                    $("#insurer_register_form")[0].reset();
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

    $("#institute_register_button").click(function (event) {
        var name = $("#name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();
        var city = $("#city").val();
        var spoc = $("#spoc").val();

        $("#name_error").html("");
        $("#phone_error").html("");
        $("#email_error").html("");
        $("#password_error").html("");
        $("#password_confirmation_error").html("");
        $("#city_error").html("");
        $("#spoc_error").html("");
        $("#flexCheckDefault_error").html("");

        $("#register_status").html("");

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

        if (
            password == "" ||
            password == null ||
            password == "undefined" ||
            password == undefined
        ) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password is required.</div>'
            );
            $("#password").focus();
            return false;
        }

        if (password_confirmation !== password) {
            $("#password_confirmation_error").html(
                '<div class=" invalid-feedback d-block">Confirm password do not match with password.</div>'
            );
            $("#password_confirmation").focus();
            return false;
        }

        function validatePassword(password) {
            // Minimum 8 characters, at least one uppercase letter,
            // one lowercase letter, one number, and one special character
            var passwordRegex =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            return passwordRegex.test(password);
        }

        if (!validatePassword(password)) {
            $("#password_error").html(
                '<div class=" invalid-feedback d-block">Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>'
            );
            $("#password").focus();
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

        if (
            spoc == "" ||
            spoc == null ||
            spoc == "undefined" ||
            spoc == undefined
        ) {
            $("#spoc_error").html(
                '<div class=" invalid-feedback d-block">Please select preferred line is required</div>'
            );
            $("#spoc").focus();
            return false;
        }

        if ($("#flexCheckDefault").prop("checked") == false) {
            $("#flexCheckDefault_error").html(
                '<div class=" invalid-feedback d-block">Agree terms & condition is required.</div>'
            );
            return false;
        } else {
            terms_and_policy = "1";
        }

        var data = {
            name: name,
            phone: phone,
            email: email,
            password: password,
            password_confirmation: password_confirmation,
            city: city,
            spoc: spoc,
        };

        event.preventDefault();

        var url = window.location.origin + "/institute";
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

                    $("#institute_register_button").attr("disabled", true);
                    RegisteredAlert();
                    $("#institute_register_form")[0].reset();
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
                }
            },
        });
    });
});
