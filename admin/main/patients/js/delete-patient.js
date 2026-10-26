$(document).on('click', ".delete-patient", function (event) {
    event.preventDefault();

    const patient_id = $(this).data('id');

    Swal.fire({
        title : "Are you confirm ?",
        text : "You won't be able to recover this patient !",
        icon : "danger",
        showCancelButton : true,
        confirmButtonText : "Yes, Delete.",
        cancelButtonText : "Cancel",
        conformuButtonColoe : "#dc3545"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : "patients/delete-patient.php",
                type : "POST",
                data : {
                    patient_id : patient_id
                },
                dataType : "json",
                success : function (response) {
                    if (response.status) {
                        showMessage(response.message, "Delete Success", "success");
                        showPatients();
                    } else {
                        showMessage(response.message, "Delete Failed.", "error");
                    }
                },
                error : function(xhr, status, error) {
                    console.error(xhr.status, " = ", xhr.responseText);
                }
            })
        }
    })
})