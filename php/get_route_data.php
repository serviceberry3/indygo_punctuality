<?php
# curl.php


$headers = array(
    "Content-type: text/xml",
    //"Content-length: " . strlen($xml),
    "Connection: close",
);

// Initialize a connection with cURL (ch = cURL handle, or "channel")
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, 'https://realtime.indygo.net/InfoPoint/rest/Vehicles/GetAllVehiclesForRoutes?routeIDs=86&_');

// Set the HTTP method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

// Return the response instead of printing it out
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Send the request and store the result in $response
$response = curl_exec($ch);

//echo 'Type of $response is ' . gettype($response) . PHP_EOL;

$response_json = json_decode($response);

//echo 'HTTP Status Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL; //line break
//echo 'Response Body: ' . $response . PHP_EOL; //line break

$num_buses_on_rt = 0;

$id_selector = "VehicleId";
$disp_status_selector = "DisplayStatus";
$laststop_status_selector = "LastStop";

echo 'Route: 86' . PHP_EOL;
echo '</br>';

$num_buses_on_rt = count($response_json);

echo 'Number of buses currently serving 86 route: ' . $num_buses_on_rt . PHP_EOL;
echo '</br>';

$num_buses_on_rt = 0;
foreach ($response_json as $bus) {
    $num_buses_on_rt += 1;

    echo 'Bus ' . $bus->$id_selector . ': status is \'' . $bus->$disp_status_selector . '\', last stop was ' . 
        $bus->$laststop_status_selector . PHP_EOL;
    echo '</br>';

    /*
    //walk through each key-value pair for the bus
    foreach ($bus as $key => $val) {
    }*/
}

//echo 'Number of buses currently serving 86 route: ' . $num_buses_on_rt . PHP_EOL;

// Close cURL resource to free up system resources
curl_close($ch);
?>

