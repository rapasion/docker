<?php
function db() {
    static $db = null;

    if ($db === null) {
        $dsn = "pgsql:host=postgres;port=5432;dbname=postgresdb;";
        $user = "richardp";
        $pass = "Password1!";

        try {
            $db = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    return $db;
}
