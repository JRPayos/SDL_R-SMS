<?php

if (isset($_GET["sales_id"])) {
    $id = $_GET["sales_id"];

    //connection
    require_once 'db_inc.php';

    $sql = "DELETE FROM `sale` WHERE sales_id = $id";
    $conn->query($sql);

}
    
header("location: ../pages/sales.php");
exit;
?>