function showPatients() {
    $.ajax({
        url : "patients/index.php",
        type : "POST",
        success : function (response) {
            $('#content').html(response);
        },
        error : function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    })
};


showPatients();

// ADD PATIENT BUTTON
$(document).on('click', "#create-patient", function (event) {
    event.preventDefault();

    $.ajax({
        url : "patients/create-patient.php",
        type : "POST",
        success : function (reponse) {
            $('#content').html(reponse);
        },
        error : function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    })
})

// BACK BUTTON
$(document).on('click', ".back-to-patients", function (event) {
    showPatients();
})