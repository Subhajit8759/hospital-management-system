$(document).on("click", ".delete-doctor", function (event) {
  event.preventDefault();

  const userId = $(this).data("id");
  
  Swal.fire({
    title : "Are you sure ?",
    text : "You won't be recover this user.",
    icon : "warning",
    showCancelButton : true,
    cancelButtonText : "Cancel",
    confirmButtonText : "Yes, Delete",
    confirmButtonColor : "#dc3545"
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url : "doctors/delete-doctor.php",
            type : "POST",
            data : {
                user_id : userId
            },
            dataType : 'JSON',
            success : function (response) {
                if (response.status) {
                    showMessage(response.message, "Successful", 'success');
                    showDoctors();
                } else {
                    showMessage(response.message, "Error", 'error')
                }
            },
            error : function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
    }
  })
});
