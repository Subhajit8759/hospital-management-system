// Go to the edit page
$(document).on('click', ".edit-department", function(e) {

    e.preventDefault();

    // getting the department ID
    const dept_id = $(this).data('id');
    console.log(dept_id);

    // going to the edit page with department ID 
    $.ajax({
        url : "departments/edit-department.layout.php",
        type : "POST",
        data : {
            dept_id : dept_id
        },
        success : function (response) {
            $('#content').html(response);
        }
    })
});