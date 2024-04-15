// Event delegation for delete users
$(document).on("click", ".delete-finance-button", function (e) {
    e.preventDefault();
    let finance_id = $(this).closest(".delete-finance-form").data("finance-id");
    let route = $(this).closest(".delete-finance-form").data("finance-route");
    console.log(route);

    // console.log(finance_id);
    financeDeleteAlert(finance_id, route);
    // console.log("this is clicked");
});

let financeDeleteAlert = (finance_id, route) => {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            deleteFinanceFunction(finance_id, route);
        } else {
            swal("Your user is safe!");
        }
    });
};

// Delete user
const deleteFinanceFunction = (finance_id, route) => {
    var data = {
        finance_id: finance_id,
    };
    var url = `/${route}/${finance_id}`;

    $.ajax({
        url: url,
        type: "DELETE",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.status == true) {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
                swal("Your user has been deleted!", {
                    icon: "success",
                });
            }
        },
        error: function (response) {
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
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
};
