$(document).on('click', '.delete-department', function (event) {
    event.preventDefault();

    const dept_id = $(this).data('id');

    Swal.fire({
        title : "Are you sure ?",
        text: "You won't be able to recover this department!",
        icon : "question",
        showCancelButton : true,
        confirmButtonText : "Yes, Delete",
        cancelButtonText : "Cancel",
        cancelButtonColor : "#dc3545"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : "departments/delete-department.php",
                type : "POST",
                data : {
                    dept_id : dept_id
                },
                dataType : "json",
                success : function (response) {
                    if (response.status) {
                        showDepartments();
                        showMessage (response.message, "Department Deleted Successfully", "success");
                    } else {
                        let errorMessage = "";
                        $.each(response.message, function (field, message) {
                            errorMessage += `${field} : ${message}`;
                            console.error(errorMessage);
                        }) 
                    }
                },
                error : function(xhr, status, error) {
                    console.error("AJAX error", error);
                    console.error(xhr.responseText);
                }
            })
        }
    })
})