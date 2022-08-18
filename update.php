testing changes and commits
####
<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "snk", "password", "snk_cafe");
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Update drink and cost query */
    $update_drink = "UPDATE drinks SET drink='$_POST[drink]', Cost ='$_POST[cost]' WHERE drink_id='$_POST[drink_id]'";

    /* Check the record has been updated */
    if(!mysqli_query($dbcon, $update_drink)) {
        echo 'Update Failed';
    } else {
        echo 'Update Successful';
    }

    /* Refresh the page and redirect */
    header("refresh:2; url=add_drinks.php");
    ?>