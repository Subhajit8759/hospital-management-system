function showDoctors() {
    $.ajax({
        url : "doctors/index.php",
        type : "POST",
        success : function (response) {
            $("#content").html(response);
        }
    })
}

showDoctors();

// BACK BUTTON
$(document).on('click', ".back-to-doctor", function (event) {
    event.preventDefault();
    showDoctors();
})

// PAGINATION
$(document).on('click', '.doctor-pagination', function(event) {
    event.preventDefault();

    const page = $(this).data('page');

    if ($(this).parent().hasClass('disabled')) {
        return;
    }

    $.ajax({
        url : "doctors/",
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
            console.error(status);
        }
    })
})