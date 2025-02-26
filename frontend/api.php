<?php
include 'config.php';

function fetchAPI($endpoint, $dataProcessFunction, $parameters)
{
    $url = API_BASE_URL . $endpoint;

    // Create HTTP headers
    $headers = [
        'Content-Type: application/json',
    ];

    // Configure the request options
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => implode("\r\n", $headers),
            'content' => json_encode($parameters),
        ],
    ];

    // Create a stream context
    $context = stream_context_create($options);

    // Make the request and get the response
    $response = file_get_contents($url, false, $context);

    // Check for errors
    if ($response === false) {
        echo 'Fetch failed:', error_get_last()['message'];
        return;
    }

    // Decode JSON response
    $data = json_decode($response, true);

    // Process the data using the provided function
    $dataProcessFunction($data);
}
