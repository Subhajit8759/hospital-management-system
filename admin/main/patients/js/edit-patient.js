$(document).on("click", ".edit-patient", function (event) {
  event.preventDefault();

  const patientId = $(this).data("id");

  $.ajax({
    url: "patients/edit-patient.php",
    type: "POST",
    data: {
      patient_id: patientId,
    },
    success: function (response) {
      $("#content").html(response);
    },
  });
});

// EDIT PATIENT FORM AND SUBMIT TO UPDATE
$(document).on("submit", "#edit-patient-form", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  $.each(formData, function(key, value) {
    console.log(`${key} : ${value}`);
  })

  $.ajax({
    url: "patients/update-patient.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "JSON",
    success: function (response) {
      if (response.status) {
        showMessage(response.message, "Success", "success");
        showPatients();
      } else {
        let errorMessage = "";

        $.each(response.message, function(field, message) {
            errorMessage = `${field} : ${message}`;
        })

        showMessage(errorMessage, "Error", "error");
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
});
