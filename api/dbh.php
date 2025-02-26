<?php

require 'config.php';
function executeQuery($sql, $params = [])
{
    try {
        // Create a PDO connection
        global $DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME;
        $pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $success = $stmt->execute();

        if ($success !== false) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result !== false) {
                return $result;
            }
            return ['id' => $pdo->lastInsertId()];
        } else {
            $errorInfo = $stmt->errorInfo();
            $errorMessage = "Query execution failed: " . $errorInfo[2];
            throw new Exception($errorMessage);
        }
    } catch (PDOException $e) {
        throw new Exception("Connection failed, hence " . $e->getMessage());
    } finally {
        $pdo = null;
    }
}
