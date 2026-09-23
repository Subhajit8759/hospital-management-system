$(document).on('change', "#photo", function() {

    const file = this.files[0];

    if (!file) {
        $('#preview-image').attr("src", "").addClass('d-none');
        $("#remove-photo").addClass('d-none');
        return;
    } 

    const reader = new FileReader();

    reader.onload = function (e) {

        $('#preview-image').attr("src", e.target.result).removeClass('d-none');

        $('#remove-photo').removeClass('d-none');  

    }

    reader.readAsDataURL(file);

});


// Remove Photo
$(document).on('click', '#remove-photo', function(e) {
    // File input reset
    $('#photo').val('');

    // Remove Review
    $('#preview-image').addClass('d-none');

    // Hide remove button
    $('#remove-photo').addClass('d-none');
})