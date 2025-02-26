<?php

require 'dbh.php';
require 'ticket.php';
$processFunction = 'login';

function login($requestData)
{
    if (isset($requestData['token'])) {
        try {

            $tokenHash = hash('sha256', $requestData['token']);
            error_log("THIS IS THE TOKEN HASH: " . $tokenHash);
            $result = executeQuery( 
                'SELECT id, subject, description, created, status FROM Tickets WHERE tokenHash = :tokenHash',
                [
                    ':tokenHash' => $tokenHash
                ]
            );
            if ($result !== false) {
                $logMessage = "Array logged: " . print_r($result, true);
        
                // Log to the error log
                error_log($logMessage);

                addAuthorizedTicket($result['id']);

                session_start();
                $logMessage = "Array logged: " . print_r($_SESSION, true);
        
                // Log to the error log
                error_log($logMessage);

                return (['success' => true, 'data' => ['id' => $result['id']]]);
            }
            return (['success' => false, 'error' => 'Zadanému tokenu neodpovídá žádný záznam']);
        } catch (Exception $e) {
            error_log(
                $e->getMessage() .
                    '\n↓\n' .
                    'Could not login ticket\n'
            );
            return (['success' => false, 'error' => 'Nepodařilo se vytvořit tiket']);
        }
    }
    return (['success' => false, 'error' => 'Nebyl zadán token\n' . json_encode($requestData)]);
}

include 'generalEndpoint.php';
