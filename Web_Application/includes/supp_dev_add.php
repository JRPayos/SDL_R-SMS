<?php

if (isset($_POST["submit"])) {
    
    $supid = $_POST["supplier_id"];
    $pid = $_POST["product_id"];
    $devqua = $_POST["delivery_quantity"];

    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputSuppDev($supid, $pid, $devqua) !==false) {
        header("location: ../pages/supplier_deliveries.php?error=emptyinput");
        exit();
    }


    createSuppDev($conn, $supid, $pid, $devqua);

   // addSupply($conn, $pid, $devqua);

}   
else {
    header("location: ../pages/supplier_deliveries.php");
}