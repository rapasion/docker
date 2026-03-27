<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare("
        INSERT INTO contacts (first_name, last_name, email, phone)
        VALUES (:first_name, :last_name, :email, :phone)
    ");

    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name'  => $_POST['last_name'],
        ':email'      => $_POST['email'],
        ':phone'      => $_POST['phone']
    ]);

    header("Location: contacts.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
</head>
<body>

<h1>Add Contact</h1>

<form method="POST">
    <label>First Name</label><br>
    <input type="text" name="first_name" required><br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
