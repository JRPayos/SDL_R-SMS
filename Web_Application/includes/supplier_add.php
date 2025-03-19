<?php

if (isset($_POST["submit"])) {
    
    $supname = $_POST["supplier_name"];
    $supadd = $_POST["supplier_address"];

    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputSupplier($supname, $supadd) !==false) {
        header("location: ../pages/supplier_master.php?error=emptyinput");
        exit();
    }

    if (supplierExists($conn, $supname) !==false) {
        header("location: ../pages/supplier_master.php?error=supplierexists");
        exit();
    }

    createSupplier($conn, $supname, $supadd);

}   
else {
    header("location: ../pages/supplier_master.php");
}