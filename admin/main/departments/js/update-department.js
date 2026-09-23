$(document).on("submit", "#updateDepartmentForm", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  $.ajax({
    url: "departments/update-department.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.status) {
        showMessage(
          response.message,
          "Department Updated Successfully",
          "success"
        );
        showDepartments();
      } else {
        let errorMessage = "";
        $.each(response.message, function (field, message) {
          errorMessage += `${field} : ${message} \n`;
          showMessage(errorMessage, "Not successfull", "error");
          console.error(errorMessage);
        });
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX error", error);
      console.error(xhr.responseText);
    },
  });
});
