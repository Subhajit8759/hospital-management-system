// CREATE PATIENT FORM
$(document).on("submit", "#createPatientForm", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  formData.forEach((key, value) => {
    console.log(`${value} : ${key}`);
  });

  $.ajax({
    url: "patients/save-patient.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.status) {
        showMessage(response.message, "Success", "success");
        showPatients();
      } else {
        let errorMessage = "";

        $.each(response.message, function (field, message) {
          errorMessage += `${field} : ${message} <br> <br>`;
        });

        showMessage(errorMessage, "Error", "error");
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
});


// DOB TO AGE
$(document).on("change", "#patient_dob", function (event) {
  event.preventDefault();

  const dobValue = this.value;

  if (!dobValue) {
    $("#age_year").text("");
    $("#age_month").text("");
    $("#age_day").text();
  }

  const dob = new Date(dobValue);
  const today = new Date();

  let years = today.getFullYear() - dob.getFullYear();
  let months = today.getMonth() - dob.getMonth();
  let days = today.getDate() - dob.getDate();

  // if days negetive
  if (days < 0) {
    months--;

    const previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
    days += previousMonth.getDate();
  }

  // Month negetive
  if (months < 0) {
    years--;
    months += 12;
  }

  // Age negetive
  if (years < 0) {
    $("#age_year").text("");
    $("#age_month").text("");
    $("#age_day").text();

    Swal.fire({
      icon: "error",
      title: "Invalid Date",
      text: "Date of birth cannot be a future date.",
    });

    return;
  }

  $("#age_year").text(years);
  $("#age_month").text(months);
  $("#age_day").text(days);
});
