<?php

include('priv/db_info.php');

#total server analysis time
$hrs = null;
$min = null;

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$curr_value = null;

if (!$link) {
    #echo "Connection failed" . PHP_EOL;
    die('Could not connect: ' . mysqli_error($link));
}
else {
    #echo "Connection successful" . PHP_EOL;
}


$sql_get_curr_time_tot = "SELECT value FROM globs WHERE id = 0";
//$sql_get_curr_time_tot = "SELECT * from globs";
$result = $link->query($sql_get_curr_time_tot);

if ($result->num_rows > 0) {
    //output data of each row
    while ($row = $result->fetch_assoc()) {
      $curr_value = $row["value"];
      #echo $curr_value;
    }
} 
else {
    echo "0 results";
}

#seconds in an hour = 3600
$tot_hrs_raw = ($curr_value / 3600);

//floor raw to get total hours
$hrs = floor($tot_hrs_raw);  


$minutes_fract = $tot_hrs_raw - $hrs;

$min = ceil($minutes_fract * 60);



