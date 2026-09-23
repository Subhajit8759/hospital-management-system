// Menu Bar
$(document).on("click", "#menuToggle", function () {
  $(".sidebar").addClass("show");

  $("#sidebarOverlay").addClass("show");
});

// Menu Bar Close
$(document).on("click", "#sidebarClose", function () {
  $(".sidebar").removeClass("show");

  $("#sidebarOverlay").removeClass("show");
});

// Menubar Overlay
$(document).on("click", "#sidebarOverlay", function () {
  $(".sidebar").removeClass("show");

  $("#sidebarOverlay").removeClass("show");
});

// page loading
$(document).on("click", ".menu-link", function (e) {
  e.preventDefault();

  const page = $(this).data("page");

  $("#content").load(page);
});

// dashboard loading
$(document).ready(function () {
  $("#content").load("content.php");
});

// AJAX শুরু হলে loader দেখাবে
$(document).ajaxStart(function () {
  $("body").waitMe({
    effect: "win8",
    text: "Please wait...",
    bg: "rgba(255,255,255,0.8)",
    color: "#0d6efd",
  });
});

// সব AJAX শেষ হলে loader hide করবে
$(document).ajaxStop(function () {
  setTimeout(() => {
    $("body").waitMe("hide");
  }, 150);
});

// Back to the home page
function backToHome() {
  $(document).on("click", ".back-btn", function () {
    showUsers();
  });
}

backToHome();

// showing modal by sweetalert2

function showMessage(message, title = "message", type = "error") {
  Swal.fire({
    title : title,
    html : message,
    icon : type,
    confirmButtonText : "OK"
  })
}

// Active Class
$(document).on("click", ".sidebar-link", function (e) {

  e.preventDefault();

  // সব link থেকে active remove
  $(".sidebar-link").removeClass("active");

  // যেটাতে click করা হয়েছে সেটাতে active add
  $(this).addClass("active");

});