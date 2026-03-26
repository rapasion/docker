<?php
require 'db.php';
$contacts = db()->query("SELECT * FROM contacts ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contacts</title>
</head>
<body>

<h1>Contacts</h1>
<a href="add_contact.php">Add New Contact</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Created</th>
    </tr>

    <?php foreach ($contacts as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['first_name'] . " " . $c['last_name'] ?></td>
            <td><?= $c['email'] ?></td>
            <td><?= $c['phone'] ?></td>
            <td><?= $c['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
