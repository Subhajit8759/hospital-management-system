$(document).on("click", ".edit-patient", function (event) {
    event.preventDefault();

    const patientId = $(this).data('id');

    $.ajax({
        url : "patients/edit-patient.php",
        type : "POST",
        data : {
            patient_id : patientId
        },
        success : function (response) {
            $("#content").html(response);
        }
    })
});