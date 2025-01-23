<?php
session_start();

// Database connection configuration
$serverName = "HUUKHA04"; // SQL Server hostname
$database = "PlaneEdu"; // Database name
$uid = ""; // SQL Server username
$pass = ""; // SQL Server password

// Connection options
$connectionOptions = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
];

// Establish connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check connection
if ($conn === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}

$error = ""; // Biến lưu lỗi để hiển thị trong form

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_name = $_POST['account_name'];
    $password = $_POST['password'];

    // Validate input
    if (empty($account_name) || empty($password)) {
        $error = "Account name and password are required.";
    } else {
        // Query to verify user
        $sql = "SELECT * FROM users WHERE account_name = ? AND password = ?";
        $params = [$account_name, $password];
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die("Error in query: " . print_r(sqlsrv_errors(), true));
        }

        // Check if a matching user was found
        if (sqlsrv_has_rows($stmt)) {
            $_SESSION['user'] = $account_name; // Store user information in session
            header("Location: ../PlaneEdu.html");
            exit;
        } else {
            $error = "Invalid account name or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <!-- Form đăng nhập -->
    <form method="POST" action="">
        <label for="account_name">Account Name:</label>
        <input type="text" id="account_name" name="account_name" value="<?= htmlspecialchars($_POST['account_name'] ?? '') ?>">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <button type="submit">Login</button>
    </form>

    <!-- Hiển thị lỗi (nếu có) -->
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</body>
</html>
