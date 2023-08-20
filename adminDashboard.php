<?php
require_once './connection.php';
require_once './logic.php';
require_once './middleware.php';
// Check for the role before granting access to the dashboard
RoleMiddleware::checkRole('admin'); // Use 'user' for user role
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php
    echo "Welcome to the admin dashboard, $username!";
    ?>
</body>

</html>