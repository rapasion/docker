<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid ID");
}

// Fetch existing contact
$stmt = db()->prepare("SELECT * FROM contacts WHERE id = :id");
$stmt->execute([':id' => $id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    die("Contact not found");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare("
        UPDATE contacts
        SET first_name = :first_name,
            last_name = :last_name,
            email = :email,
            phone = :phone
        WHERE id = :id
    ");

    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name'  => $_POST['last_name'],
        ':email'      => $_POST['email'],
        ':phone'      => $_POST['phone'],
        ':id'         => $id
    ]);

    header("Location: contacts.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
</head>
<body>

<h1>Edit Contact</h1>

<form method="POST">
    <label>First Name</label><br>
    <input type="text" name="first_name" value="<?= $contact['first_name'] ?>" required><br><br>

    <label>Last Name</label><br>
    <input type="text" name="last_name" value="<?= $contact['last_name'] ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= $contact['email'] ?>" required><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone" value="<?= $contact['phone'] ?>"><br><br>

    <button type="submit">Save Changes</button>
</form>

</body>
</html>
