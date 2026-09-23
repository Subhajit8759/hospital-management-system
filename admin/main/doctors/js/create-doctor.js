// ADD DOCTOR BUTTON

$(document).on("click", "#addDoctorBtn", function (event) {
  event.preventDefault();

  $.ajax({
    url: "doctors/create-doctor.layout.php",
    type: "POST",
    success: function (response) {
      $("#content").html(response);
    },
  });
});

// Found Doctor Button
$(document).on("submit", "#foundDoctorUser", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  $.ajax({
    url: "doctors/create-doctor.layout.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      $("#content").html(response);
    },
  });
});

// SAVE DOCTOR
$(document).on("submit", "#createDoctorForm", function (event) {
  event.preventDefault();

  const formData = new FormData(this);
  console.log(formData);

  $.ajax({
    url: "doctors/save-doctor.php",
    type: "POST",
    data: formData,
    dataType: "json",
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.status) {
        showDoctors();
        showMessage(response.message, "Doctor Created Successfully", "success");
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
      console.error("AJAX Error", error);
      console.error(xhr.responseText);
    },
  });
});
