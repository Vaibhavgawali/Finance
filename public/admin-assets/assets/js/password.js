$(document).ready(function () {
    $("#reset_password").submit(function (e) {
        var email = $("#email").val();
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var password_confirmation = $("#password_confirmation").val();

        $(".error-message").remove();
        $("#email_error").html("");
        $("#old_password_error").html("");
        $("#new_password_error").html("");
        $("#password_confirmation_error").html("");

        e.preventDefault();

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
            old_password == "" ||
            old_password == null ||
            old_password == "undefined" ||
            old_password == undefined
        ) {
            $("#old_password_error").html(
                '<div class=" invalid-feedback d-block">Old Password is required.</div>'
            );
            $("#old_password").focus();
            return false;
        }

        if (
            new_password == "" ||
            new_password == null ||
            new_password == "undefined" ||
            new_password == undefined
        ) {
            $("#new_password_error").html(
                '<div class=" invalid-feedback d-block">New Password is required.</div>'
            );
            $("#new_password").focus();
            return false;
        }

        function validatePassword(new_password) {
            // Minimum 8 characters, at least one uppercase letter,
            // one lowercase letter, one number, and one special character
            var passwordRegex =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            return passwordRegex.test(new_password);
        }

        if (!validatePassword(new_password)) {
            $("#new_password_error").html(
                '<div class=" invalid-feedback d-block">Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>'
            );
            $("#new_password").focus();
            return false;
        }

        if (password_confirmation !== new_password) {
            $("#password_confirmation_error").html(
                '<div class=" invalid-feedback d-block">Confirm password do not match with password.</div>'
            );
            $("#password_confirmation").focus();
            return false;
        }

        var data = {
            email: email,
            old_password: old_password,
            new_password: new_password,
            password_confirmation: password_confirmation,
        };
        var url = window.location.origin + `/reset-password/`;

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    $("#reset_password_button").attr("disabled", true);
                    quizCreatedAlert();
                    setTimeout(function () {
                        window.location.href =
                            window.location.origin + "/dashboard/";
                    }, 2000);

                    return false;
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    console.log(errors);

                    $.each(errors, function (field, messages) {
                        var input = $('[name="' + field + '"]');

                        if (Array.isArray(messages)) {
                            input.after(
                                '<div class="error-message invalid-feedback d-block">' +
                                    messages.join(", ") +
                                    "</div>"
                            );
                        } else {
                            var errorContainer = $("#error-container");
                            errorContainer.empty();
                            errorContainer.show();

                            errorContainer.html(messages);
                        }
                    });
                }

                if (response.status === 404) {
                    var errors = response.responseJSON.errors;
                    console.log(errors);

                    var errorContainer = $("#error-container");
                    errorContainer.empty();
                    errorContainer.show();

                    $.each(errors, function (field, messages) {
                        var errorMessage = Array.isArray(messages)
                            ? messages.join(", ")
                            : messages;

                        errorContainer.html(errorMessage);
                    });
                }
            },
        });
    });
});
