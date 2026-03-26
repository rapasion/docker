<?php
$dsn = "pgsql:host=postgres;port=5432;dbname=postgresdb;";
$user = "richardp";
$pass = "Password1!";

$db = new PDO($dsn, $user, $pass);

$stmt = $db->query("SELECT NOW()");
echo $stmt->fetchColumn();
