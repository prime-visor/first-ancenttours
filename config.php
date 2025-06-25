<?php
// === Database Configuration ===
$host = 'localhost';
$db   = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// === Function to Fetch Data ===
function getdata($pdo) {
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll();
}

// === Display the Data ===
$users = getdata($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
    <h2>Users</h2>
    <?php if (count($users) > 0): ?>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?php echo htmlspecialchars($user['name'] ?? 'No Name'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
