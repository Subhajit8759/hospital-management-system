function showUsers() {
    $.ajax({
        url : "users/show-users.php",
        type : "post",
        success : function (response) {
            $('#content').html(response);
            
        }
    })
}

showUsers();


// addnew user button
$(document).on('click', '#addUserBtn', function(e) {
    e.preventDefault();
    $.ajax({
        url : "users/create-user.php",
        type : "post",
        success : function(response) {
            $("#content").html(response);
        }
    })
})


// pagination
$(document).on('click', '.user-pagination', function (event) {
    event.preventDefault();

    const page = $(this).data('page');

    if ($(this).parent().hasClass('disabled')) {
        return;
    }

    $.ajax({
        url : "users/show-users.php",
        type : "POST",
        data : {
            page : page
        },
        success : function (response) {
            $('#content').html(response)
        },
        error : function () {
            Swal.fire({
                icon : "error",
                title : "Error",
                text : "Something went wrong."
            })
        }
    })
})