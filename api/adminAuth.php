<?php

$processFunction = 'authorizeAdmin';
function authorizeAdmin($jsonData)
{
    $token = $jsonData["token"];
    if ($token === "z3vnn4WjPMgKvBc8B7rb") {
        session_start();
        $_SESSION["adminAuthorized"] = true;
        return (['success' => true]);
    } else {
        return (['success' => false, 'error' => 'Token does not match']);
    }
}

include 'generalEndpoint.php';