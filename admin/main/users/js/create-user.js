// Create New User

function createUser() {
  $(document).on("submit", "#userForm", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    $.ajax({
      url: "users/save-user.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (response.status) {

          showMessage(
            response.message,
            "User created successfuly",
            "success"
          )

          showUsers();
          console.log("user saved");
        } else {
          let errorMessage = "";

          $.each(response.message, function (field, message) {
            errorMessage += `${field} : ${message} \n`;

            console.error(`${field} : ${message}`);
          });

          showMessage(errorMessage, "Error", "error");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error", error);
        console.error(xhr.responseText);
      },
    });
  });
}

createUser();
