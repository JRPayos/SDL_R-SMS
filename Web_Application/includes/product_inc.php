<?php

if (isset($_POST["submit"])) {
    
    $pbrand = $_POST["brand_id"];
    $pname = $_POST["product_name"];
    $pcat = $_POST["product_category_id"];
    $ptype = $_POST["product_type_id"];
    $pstock = $_POST["product_stock"];
    $psuppname = $_POST["supplier_name"];
    $psellprice = $_POST["selling_price"];
    $psuppprice = $_POST["supplier_price"];

    require_once 'db_inc.php';
    require_once 'functions_inc.php';

    if (emptyInputProduct($pbrand, $pname, $pcat, $ptype, $pstock, $psuppname, $psellprice, $psuppprice) !==false) {
        header("location: ../pages/product_inv.php?error=emptyinput");
        exit();
    }

    if (usernameExists($conn, $pname) !==false) {
        header("location: ../pages/product_inv.php?error=productexists");
        exit();
    }

    addProduct($conn, $pbrand, $pname, $pcat, $ptype, $pstock, $psuppname, $psellprice, $psuppprice);

}   
else {
    header("location: ../pages/product_inv.php");
}