// View Patient BY Patient ID
$(document).on('click', '.view-patient', function(event) {
    event.preventDefault();

    const patientId = $(this).data('id');

    $.ajax({
        url : "patients/view-patient.php",
        type : "POST",
        data : {
            patient_id : patientId
        },
        success : function (response) {
            $("#content").html(response);
        },
        error : function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    })
});