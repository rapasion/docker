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
        Your Apache + PHP-FPM environment is now running smoothly.  
        Feel free to modify this page and build out your site structure.
    </p>
</main>

<footer>
    &copy; <?php echo date("Y"); ?> Richard Pasion. All rights reserved.
</footer>

</body>
</html>
