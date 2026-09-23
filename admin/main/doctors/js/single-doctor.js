// Go to the view page
$(document).on('click', ".view-doctor", function (event) {
    event.preventDefault()

    const userId = $(this).data('id');

    $.ajax({
        url : "doctors/view-doctor.php",
        type : "POST",
        data : {
            user_id : userId
        },
        success : function (response) {
            $('#content').html(response);
        }
    })
}) 