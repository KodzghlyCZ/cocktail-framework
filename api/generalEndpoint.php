<?php
require 'cors.php';

// Set the appropriate Content-Type header for JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw input data from the request body
    $inputData = file_get_contents('php://input');

    // Attempt to decode the JSON data
    $jsonData = json_decode($inputData, true);

    // Check if JSON decoding was successful
    if ($jsonData !== null) {
        $processFunction = $processFunction ?? 'getErrorFuncNotSpecified';
        if (is_callable($processFunction)) {
            echo json_encode( $processFunction($jsonData));
        }
    } else {
        // JSON decoding failed
        echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    }
} else {
    // Request method is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

function getErrorFuncNotSpecified($jsonData)
{
    return [
        'success' => false,
        'error'   => 'No function specified'
    ];
}

?>