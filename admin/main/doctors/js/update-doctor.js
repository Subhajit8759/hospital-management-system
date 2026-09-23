$(document).on('click', '.edit-doctor', function(event) {
    event.preventDefault();

    const userId = $(this).data('id');

    $.ajax({
        url : "doctors/edit-doctor.layout.php",
        type : "POST",
        data : {
            user_id : userId
        },
        success : function (response) {
            $('#content').html(response);
        },
        error : function (xhr, status, error) {
            console.error("AJAX Error", error);
            console.error(xhr.responseText);
        }
    })
})

// SAVE UPDATE DOTOR
$(document).on('submit', '#updateDoctorForm', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    $.ajax({
        url : "doctors/update-doctor.php",
        type : "POST",
        data : formData,
        processData : false,
        contentType : false,
        dataType : "JSON",
        success : function (response) {
            if(response.status) {
                showMessage(response.message, "Success", "success");
                showDoctors();

            } else {
                let errorMessage = "";

                $.each(response.message, function(field, message) {
                    errorMessage += `${field} : ${message}`;
                });

                showMessage(errorMessage, "Error", 'error');
            }
        },
        error : function(xhr, status, error) {
            console.error("AJAX Error", error);
            console.error(xhr.responseText);
        }
    })
})