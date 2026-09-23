function deleteUser() {
  $(document).on("click", ".delete-btn", function (e) {
    e.preventDefault();

    const userID = $(this).data("id");

    Swal.fire({
      title: "Are you sure ?",
      text: "You won't be able to recover this user !",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, Delete",
      cancelButtonText: "Cancel",
      confirmButtonColor: "#dc3545",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "users/delete-user.php",
          type: "POST",
          data: {
            user_id: userID,
          },
          dataType: "json",

          success: function (response) {
            if (response.status) {
              showMessage(response.message, "Deleted Successfully", "success");

              showUsers();
            } else {
              showMessage(response.message, "Delete Failed", "error");
            }
          },

          error: function (xhr, status, error) {
            console.error(xhr.responseText);
            showMessage("Something went wrong", "Server Error", "error");
          },
        });
      }
    });
  });
}

deleteUser();
