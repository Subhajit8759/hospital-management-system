


<?php include "configs/header.php" ?>



<!-- sidebar -->
<?php include "configs/sidebar.php"; ?>

<div class="main">

    <!-- Navbar -->
    <?php include "configs/navbar.php"; ?>

    <!-- content -->
    <div id="content"></div>

</div>

<?php include "../main/users/js/user-js.php"; ?>
<?php include "../main/departments/js/department-js.php"; ?>
<?php include "../main/doctors/js/doctor-js.php"; ?>
<?php include "../main/patients/js/patients-js.php"; ?>

<script>
    history.pushState(null, null, window.location);
    window.onpopstate = function () {
        history.go(1);
    }
</script>

<?php include "configs/footer.php"; ?>