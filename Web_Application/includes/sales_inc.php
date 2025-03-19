<?php

if (isset($_POST["submit"])) {
    
    $scname = $_POST["customer_name"];
    $spitemid = $_POST["product_item_id"];
    $sitemqty = $_POST["item_quantity"];
    $stprice = $_POST["total_price"];
   

    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputSales($scname, $sitemqty, $stprice) !==false) {
        header("location: ../pages/sales.php?error=emptyinput");
        exit();
    }

    addSales($conn, $scname, $spitemid, $sitemqty, $stprice);

    //$sql = "UPDATE `product` SET product_stock = product_stock - ? WHERE product_id = ?";
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("ii", $sitemqty, $spitemid);
    //$stmt->execute();
}   
else {
    header("location: ../pages/sales.php");
}