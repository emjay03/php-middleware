<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use a prepared statement to check if the user exists and get their role
    $sql = "SELECT role FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($userRole);

    if ($stmt->fetch()) {
        // User exists, set user data in the session
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $userRole,
        ];

        if ($userRole === 'admin') {
            // Redirect to the dashboard
            header("Location: adminDashboard.php");
            exit;
        } else if ($userRole === 'user') {
            header("Location: userDashboard.php");
            exit;
        }
    } else {
        // Invalid credentials, handle accordingly
        echo "Invalid credentials. Please try again.";
    }

  
    $stmt->close();
}

$username = $_SESSION['user']['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
