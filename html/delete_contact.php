<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = db()->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: contacts.php");
exit;
