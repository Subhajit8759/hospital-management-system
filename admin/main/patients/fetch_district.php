<?php

include "../configs/config.php";

if (isset($_POST['state_id'])) {

    $state_id = trim($_POST['state_id']);

    $sql_district = "SELECT * FROM districts WHERE sid = '{$state_id}'";

    $result_distrct = mysqli_query($connection, $sql_district) or die("Mysqli_query_failed");

    if (mysqli_num_rows($result_distrct) > 0) {

?>

        <option value="" selected disabled>Select District</option>
        <?php
        while ($row_district = mysqli_fetch_assoc($result_distrct)) {

        ?>

            <option value="<?= $row_district['district_id'] ?>"><?= $row_district['district_name']; ?></option>

<?php

        }
    }
}

?>