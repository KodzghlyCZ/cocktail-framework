<?php
// Get the requesting origin from the request header
$requestingOrigin = $_SERVER['HTTP_ORIGIN'];

// Define an array of allowed origins
$allowedOrigins = [
	'https://dev.tickets.catania-service.cz'
];

// Check if the requesting origin is in the allowed list
if (in_array($requestingOrigin, $allowedOrigins)) {
	// Allow the request from the requesting origin
	header("Access-Control-Allow-Origin: " . $requestingOrigin);
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 3600");
} else {
	// Deny the request from an untrusted origin
	header("HTTP/1.1 403 Forbidden");
	exit();
}

?>