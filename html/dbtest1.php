<?php
echo "Running DB test...<br>";

$dsn = "pgsql:host=postgres;port=5432;dbname=postgresdb;";
$user = "richardp";
$pass = "Password1!";

try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "Connected OK<br>";

    $stmt = $db->query("SELECT NOW()");
    echo "Time: " . $stmt->fetchColumn();

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
