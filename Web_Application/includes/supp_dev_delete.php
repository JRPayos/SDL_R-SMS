<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_id = $_POST['supplier_delivery_id'];

    include_once 'db_inc.php';

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM `supplier_delivery` WHERE supplier_delivery_id = ?");
    $stmt->bind_param("i", $supplier_id);

    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: ../pages/supplier_deliveries.php"); // Redirect back
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>