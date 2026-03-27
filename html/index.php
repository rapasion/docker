<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richard Pasion | Home</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        header {
            background: #222;
            color: white;
            padding: 15px 20px;
        }
        main {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        footer {
            text-align: center;
            padding: 20px;
            color: #777;
        }
        .db-box {
            background: #eef7ff;
            padding: 15px;
            border-left: 4px solid #0077cc;
            margin-top: 20px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        table th {
            background: #f0f0f0;
        }
        .actions a {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<main>
    <h1>Welcome to Richard Pasion Website</h1>
    <p>
        This is the personal homepage of <strong>Richard Pasion</strong> — a space for projects, ideas,
        and anything he wants to showcase. You can expand this into a portfolio, a blog, or a full
        application as your stack grows.
    </p>

    <p>
        Your Apache + PHP-FPM + PostgreSQL environment is now running smoothly.
    </p>

    <h2>Database Connectivity Test</h2>

    <div class="db-box">
        <?php
        require 'db.php';

        $dsn = "pgsql:host=postgres;port=5432;dbname=postgresdb;";
        $user = "richardp";
        $pass = "Password1!";

        try {
            $db = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            $stmt = $db->query("SELECT NOW() AS server_time");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<strong>Connected to PostgreSQL!</strong><br>";
            echo "Server time: " . $row['server_time'];

        } catch (PDOException $e) {
            echo "<strong style='color:red;'>Database connection failed:</strong><br>";
            echo $e->getMessage();
        }
        ?>
    </div>

    <h2 style="margin-top:40px;">Contacts</h2>
    <a href="add_contact.php">Add New Contact</a>

    <?php
    // Fetch contacts
    $contacts = db()->query("SELECT * FROM contacts ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($contacts as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['first_name'] . " " . $c['last_name'] ?></td>
            <td><?= $c['email'] ?></td>
            <td><?= $c['phone'] ?></td>
            <td><?= $c['created_at'] ?></td>
            <td class="actions">
                <a href="edit_contact.php?id=<?= $c['id'] ?>">Edit</a>
                <a href="delete_contact.php?id=<?= $c['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this contact?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</main>

<footer>
    &copy; <?php echo date("Y"); ?> Richard Pasion. All rights reserved.
</footer>

</body>
</html>
