 // Event delegation for delete users
 $(document).on("click", ".delete-user-button", function (e) {
    e.preventDefault();
    let user_id = $(this).closest(".delete-user-form").data("user-id");
    userDeleteAlert(user_id);
  });

  let userDeleteAlert = (user_id) => {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this user!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        deleteUserFunction(user_id);
      } else {
        swal("Your user is safe!");
      }
    });
  };

  // Delete user
  const deleteUserFunction = (user_id) => {
    var data = {
      user_id: user_id,
    };
    var url = `/candidate/${user_id}`;

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
            input.after('<div class="error-message invalid-feedback d-block">' + messages.join(", ") + "</div>");
          });
        }
      },
    });
  };