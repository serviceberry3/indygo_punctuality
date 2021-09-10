<?php

//just in case anyone asks
$route = 86;

//headers for cURL
$headers = array(
    "Content-type: text/xml",
    //"Content-length: " . strlen($xml),
    "Connection: close",
);

//error_log("TESTING ERROR");

//let's check if "rt_to_update" var was set in the AJAX rqst
if (isset($_GET['rt_to_update'])) {
    //if so, check it's value
    if ($_GET['rt_to_update'] == '86') {
        //if value is 86, get 86 route data

        //Initialize connection with cURL (ch = cURL handle, or "channel")
        $ch = curl_init();

        //Set URL
        curl_setopt($ch, CURLOPT_URL, 'https://realtime.indygo.net/InfoPoint/rest/Vehicles/GetAllVehiclesForRoutes?routeIDs=86&_');

        //Set HTTP method
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        //Return response instead of printing it out
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

        print_num_buses_on_rt();
        list_bus_data();

        //Close cURL resource to free up system resources
        curl_close($ch);
    } 
}

function print_num_buses_on_rt() {
    global $response_json;

    $num_buses_on_rt = count($response_json);

    echo 'Number of buses currently serving route: ' . $num_buses_on_rt . PHP_EOL;
    echo '</br>';
}


function list_bus_data() {
    global $response_json;

    $id_selector = "VehicleId";
    $disp_status_selector = "DisplayStatus";
    $laststop_status_selector = "LastStop";

    foreach ($response_json as $bus) {
        #$num_buses_on_rt += 1;

        echo 'Bus ' . $bus->$id_selector . ': status is \'' . $bus->$disp_status_selector . '\', last stop was ' . 
            $bus->$laststop_status_selector . PHP_EOL;
        echo '</br>';

        /*
        //walk through each key-value pair for the bus
        foreach ($bus as $key => $val) {
        }*/
    }
}

?>

