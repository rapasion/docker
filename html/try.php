try {
    $db = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "<strong>Connected to PostgreSQL!</strong><br>";

    $stmt = $db->query("SELECT NOW() AS server_time");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Server time: " . $row['server_time'];

} catch (PDOException $e) {
    echo "<strong style='color:red;'>Database connection failed:</strong><br>";
    echo $e->getMessage();
}
