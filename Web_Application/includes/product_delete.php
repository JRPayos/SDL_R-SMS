<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    include_once 'db_inc.php';

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM `product` WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: ../pages/product_inv.php"); // Redirect back to the product list
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>