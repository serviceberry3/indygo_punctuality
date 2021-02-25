<?php
    include('priv/db_info.php');

    /*
    ini_set('display_errors', 1); 
    error_reporting(-1); 
    phpinfo();*/

    //error_reporting(-1); 
    
    $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if (!$link) {
        echo "Connection failed" . PHP_EOL;
        die('Could not connect: ' . mysqli_error($link));
    }
    else {
        echo "Connection successful" . PHP_EOL;
    }

    
    $sql_get_curr_time_tot = "SELECT value FROM globs WHERE id = 0";
    //$sql_get_curr_time_tot = "SELECT * from globs";
    $result = $link->query($sql_get_curr_time_tot);

    if ($result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
          $curr_value = $row["value"];
          echo "Current value: " . $curr_value . PHP_EOL;
        }
    } 
    else {
        echo "0 results";
    }

    //up the total time by 10
    $sql_update_curr_time_tot = "UPDATE globs SET value = value + 10 WHERE id = 0";


    if ($link->query($sql_update_curr_time_tot) === TRUE) {
        echo "Record updated successfully" . PHP_EOL;
    } 
    else {
        echo "Error updating record: " . $link->error;
    }
?>