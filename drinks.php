<?php
    /* Connect to the database */
    $dbcon = mysqli_connect("localhost", "snk", "password", "snk_cafe");

    /* Checks if DB connection was successful */
    if($dbcon == NULL) {
        echo "Could not connect to database";
        exit();
    }

    /* Get from the drink id from index page else set default */
    if(isset($_GET['drink_sel'])) {
        $drink_id = $_GET['drink_sel'];
    } else {
        $drink_id = 1;
    }

    /* Create the SQL query */
    $this_drink_query = "SELECT * FROM drinks WHERE drinks.drink_id = '" .$drink_id . "'";

    /* Perform the query against the database */
    $this_drink_result = mysqli_query($dbcon, $this_drink_query);

    /* Fetch the result into an associative array */
    $this_drink_record = mysqli_fetch_assoc($this_drink_result);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>

        <meta name="description" content="">
        <link href="css/styles.css" rel="stylesheet">

    </head>
    <body>
        <h1>Coffee Shop</h1>
        <!--List the information of the selected drink record-->
        <h2>Drinks Information</h2>
        <?php
            echo "<p> Drink Name: " .$this_drink_record['drink']. "<br>";
            echo "Cost: $" .$this_drink_record['cost']. "</p>";
        ?>

        <!--Allow user to search for a drink-->
        <h2>Drink Search</h2>
        <form action="" method="post">
            <input type="text" name="search">
            <input type="submit" name="submit" value="Search">
        </form>

        <!--Display the search result-->
        <?php
            if(isset($_POST['search'])){
                $search = $_POST['search'];

                /* % represents zero or more characters before and after the search term */
                $search_query = "SELECT * FROM drinks WHERE drinks.drink LIKE '%$search%'";
                $search_result = mysqli_query($dbcon, $search_query);
                $search_records = mysqli_num_rows($search_result);

                /* If there are no results found */
                if($search_records == 0){
                    echo "There was no results found!";
                } else {    /* Print all results found */
                    while ($result_row = mysqli_fetch_array($search_result)) {
                        echo $result_row['drink'];
                        echo "<br>";    /* line break */
                    }
                }
            }
        ?>
    </body>
</html>