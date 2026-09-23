$(document).on('click', ".password-toggle", function(e) {

    e.preventDefault();


    const target = $(this).data('target');
    const input = $(target);
    const icon = $(this).find("i");

    console.log(target)
    console.log(input)
    console.log(icon)

    if (input.attr('type') === "password") {

        input.attr("type", "text");

        icon.removeClass("bi-eye");
        icon.addClass("bi-eye-slash");

    } else {

        input.attr("type", "password");

        icon.removeClass("bi-eye-slash");
        icon.addClass("bi-eye");

    }
})