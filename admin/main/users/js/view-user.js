function viewUser() {
    $(document).on('click', ".view-btn", function() {
        const userId = $(this).data('id');

        $.ajax({
            url : "users/view-user.php",
            type : "POST",
            data : {
                user_id : userId
            },
            success : function (response) {
                $("#content").html(response);
            }
        })
    })
}

viewUser();