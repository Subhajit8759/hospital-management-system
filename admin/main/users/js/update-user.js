$(document).on("click", ".edit-btn", function (e) {
  e.preventDefault();

  const id = $(this).data("id");

  $.ajax({
    url: "users/edit-user-layout.php",
    type: "POST",
    data: {
      userid: id,
    },
    success: function (response) {
      $("#content").html(response);
    },
  });
});

// Update User
$(document).on("submit", "#updateForm", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  $.ajax({
    url: "users/update-user.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      
      if (response.status) {

        showMessage(
          response.message,
          "User updated successfully",
          "success"
        )

        showUsers();
        console.log(response);
      } else {

        let errorMessage = "";

        $.each(response.message, function(field, message) {

          errorMessage += `${field} : ${message}`;

          console.error(`${field} : ${message}` );
        })

        showMessage(errorMessage, "Error", "error");
      }

    },
    error : function(xhr, status, error) {
      console.error("AJAX error", error);
      console.error(xhr.responseText);
    }
  });
});
