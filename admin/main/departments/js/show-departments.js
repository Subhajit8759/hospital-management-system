function showDepartments() {

    $.ajax({
        url : "departments/show-department-layout.php",
        type : "POST",
        success : function (response) {
            $("#content").html(response);
        }
    })

}

showDepartments();

// Back Button to back home page

$(document).on('click', ".back-to-department", function(e) {
    e.preventDefault();

    showDepartments();
});


// pagination
$(document).on('click', ".department-pagination", function(event) {
    event.preventDefault();

    const page = $(this).data('page');

    if ($(this).parent().hasClass('disabled')) {
        return;
    }

    $.ajax({
        url : "departments/show-department-layout.php",
        type : "POST",
        data : {
            page : page
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