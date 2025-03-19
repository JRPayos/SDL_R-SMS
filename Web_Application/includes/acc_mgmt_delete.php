<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];

    include_once 'db_inc.php';

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM `admin` WHERE admin_id = ?");
    $stmt->bind_param("i", $admin_id);

    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: ../pages/account_manager.php"); // Redirect back to the account manager
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>