<?php

function tokenHashExists($tokenHash)
{
    try {
        $result = executeQuery(
            'SELECT id FROM Tickets WHERE tokenHash = :tokenHash',
            [
                ':tokenHash' => $tokenHash
            ]
        );
        return isset($result['data']);
    } catch (Exception $e) {
        throw new Exception('Unable to check token hash presence in the database hence ' . $e->getMessage());
    }
}

function generateRandomToken($length = 30)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $tokenHash = '';

    try {
        do {
            $token = '';
            for ($i = 0; $i < $length; $i++) {
                $token .= $characters[rand(0, strlen($characters) - 1)];
            }
            $tokenHash = hash('sha256', $token);
        }
        while (tokenHashExists($tokenHash));

        return [
            'token'     => $token,
            'tokenHash' => $tokenHash
        ];
    } catch (Exception $e) {
        throw new Exception(
            $e->getMessage() .
            '\n↓\n' .
            'Could not generate token\n'
        );
    }
}

function addAuthorizedTicket($tokenId)
{
    session_start();
    if (!isset($_SESSION['authorizedTickets'])) {
        $_SESSION['authorizedTickets'] = [];
    }
    array_push($_SESSION['authorizedTickets'], $tokenId);
    session_write_close();
}


