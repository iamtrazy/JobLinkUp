<?php

function getJsonData($url)
{
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        // Handle cURL error
        $error = curl_error($ch);
        // You can log or display the error message
        echo "cURL Error: $error";
        return null;
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $data = json_decode($response, true);

    // Check for JSON decoding errors
    if ($data === null) {
        // Handle JSON decoding error
        // You can log or display the error message
        echo "JSON Decoding Error";
        return null;
    }

    return $data;
}


function gelocate($address)
{
    // Make request to Google Maps Geocoding API
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=AIzaSyBXATlcK_xqsnzPKIw-spbGq_dqZK7hLdU";

    // Get JSON data from the API
    $data = getJsonData($url);

    // Check if API request was successful
    if ($data !== null && $data['status'] == 'OK') {
        // Extract country and city from formatted address
        $components = $data['results'][0]['address_components'];
        $country = null;
        $city = null;

        foreach ($components as $component) {
            if (in_array('country', $component['types'])) {
                $country = $component['long_name'];
            }
            if (in_array('locality', $component['types'])) {
                $city = $component['long_name'];
            }
        }

        // Return country and city
        return ['country' => $country, 'city' => $city];
    } else {
        // Handle API error
        echo "Error: Unable to retrieve geolocation data";
        return null;
    }
}
