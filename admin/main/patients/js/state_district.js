$(document).on('change', '.state', function (event) {
    event.preventDefault();

    let state_id = $(this).val();

    let district_row = $("#district_row");
    district_row.removeClass("d-none");

    console.log("State ID : ", state_id);

    $.ajax({
        url : "patients/fetch_district.php",
        type : "POST",
        data : {
            state_id : state_id
        },
        success : function (response) {
           $("#district").html(response);
        },
        error : function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    })
});


