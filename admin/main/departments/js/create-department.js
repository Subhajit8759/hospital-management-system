$(document).on("click", ".add-department-btn", function (e) {
  e.preventDefault();

  $.ajax({
    url: "departments/create-department-layout.php",
    type: "POST",
    success: function (response) {
      $("#content").html(response);
    },
  });
});

// get the data from create form and send the data to the save department.php
$(document).on("submit", "#createDepartmentForm", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  // ajax request
  $.ajax({
    url: "departments/save-department.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.status) {
        showMessage(
          response.message,
          "Department Created Successfully",
          "success"
        );
        showDepartments();
      } else {
        let errorMessage = "";

        $.each(response.message, function (field, message) {
          errorMessage += `${field} : ${message} \n`;

          console.error(`${field} : ${message}`);
        });

        showMessage(errorMessage, "Error", "error");
      }
    },
    error : function (xhr, status, error) {
        console.error("AJAX error", error);
        console.error(xhr.responseText);
    }
  });
});
