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

</main>

<footer>
    &copy; <?php echo date("Y"); ?> Richard Pasion. All rights reserved.
</footer>

</body>
</html>
