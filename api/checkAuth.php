<?php
require 'dbh.php';
$processFunction = 'checkAuthorization';
function checkAuthorization($requestData)
{
    if (isset($requestData['id'])) {
        $checkId = $requestData["id"];
        session_start();
        if ((isset($_SESSION['adminAuthorized']) && $_SESSION['adminAuthorized'] === true)) {
            return (['success' => true, 'data'=>['authorized'=>'admin']]);
        }
        if (
            (isset($_SESSION['authorizedTickets']) && in_array($checkId, $_SESSION['authorizedTickets'])) 
        ) {
            return (['success' => true, 'data'=>['authorized'=>'user']]);
        }
        return (['success' => true, 'data'=>['authorized'=>'none']]);
    }
    return (['success' => false, 'error' => 'ID not specified']);
}

include 'generalEndpoint.php';
