<?php

function emptyInputRegister($fname, $lname, $email, $username, $password, $passwordRpt) {
    $result;

    if(empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($passwordRpt)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($password, $passwordRpt) {
    $result;
    if ($password !== $passwordRpt) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username) {
    $sql = "SELECT * FROM `admin` WHERE `admin_username` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/account_manager.php?error=stmtfailure");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $lname, $email, $username, $password) {
    $sql = "INSERT INTO `admin` (admin_fname, admin_lname, admin_email, admin_username, admin_password) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/account_manager.php?error=stmtfailure");
        exit();
    }
    //HASH the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/account_manager.php?error=none");
    exit();
}
//LOGIN FUNCTIONS
function emptyInputLogin($username, $password) {
    $result;
    if(empty($username) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password) {
    $usernameExists = usernameExists($conn, $username);

    if ($usernameExists === false) {
        header("location: ../pages/login.php?error=wronglogin");
        exit(); 
    }

    $passwordHashed = $usernameExists["admin_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../pages/login.php?error=wronglogin");
        exit();
    }
    else if ($checkPassword === true) {
        session_start();
        $_SESSION["adminId"] = $usernameExists["admin_id"] ;
        $_SESSION["adminUsername"] = $usernameExists["admin_username"];
        $_SESSION["adminName"] = $usernameExists["admin_fname"];
        header("location: ../pages/home.php");
        exit();
    }
}


// PRODUCTS

function emptyInputProduct($pbrand, $pname, $pcat, $ptype, $pstock, $psuppname, $psellprice, $psuppprice) {
    $result;

    if(empty($pbrand) || empty($pname) || empty($pcat) || empty($ptype) || empty($pstock) || empty($psellprice) || empty($psuppprice)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}


function addProduct($conn, $pbrand, $pname, $pcat, $ptype, $pstock, $psuppname, $psuppprice, $psellprice ) {
    $sql = "INSERT INTO `product` (brand_id, product_name, product_category_id, product_type_id, product_stock, supplier_name, supplier_price, selling_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/product_inv.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssssss", $pbrand, $pname, $pcat, $ptype, $pstock, $psuppname, $psuppprice, $psellprice);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/product_inv.php?error=none");
    exit();
}

//SALES

function emptyInputSales($scname, $sitemqty, $stprice) {
    $result;

    if(empty($scname) || empty($sitemqty) || empty($stprice)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function addSales($conn, $scname, $spitemid, $sitemqty, $stprice) {
    $sql = "INSERT INTO `sale` (customer_name, product_item_id, item_quantity, total_price) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/sales.php?error=stmtfailure");
    }
    mysqli_stmt_bind_param($stmt, "ssss", $scname, $spitemid, $sitemqty, $stprice);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "UPDATE `product` SET product_stock = product_stock -".$sitemqty." WHERE product_id = ".$spitemid."";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_deliveries.php?error=stmtfailure");
    }
    //mysqli_stmt_bind_param($stmt, "ss", $pid, $devqua);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../pages/sales.php?error=none");
}

//SUPPLIER

function emptyInputSupplier($supname, $supadd) {
    $result;

    if(empty($supname) || empty($supadd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function supplierExists($conn, $supname) {
    $sql = "SELECT * FROM `supplier` WHERE `supplier_name` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_master.php?error=stmtfailure");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $supname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createSupplier($conn, $supname, $supadd) {
    $sql = "INSERT INTO `supplier` (supplier_name, supplier_address) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_master.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $supname, $supadd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/supplier_master.php?error=none");
    exit();
}

//SUPPLIER DELIVERY

function createSuppDev($conn, $supid, $pid, $devqua) {
    $sql = "INSERT INTO `supplier_delivery` (supplier_id, product_id, delivery_quantity) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_deliveries.php?error=stmtfailure");
    }
    mysqli_stmt_bind_param($stmt, "sss", $supid, $pid, $devqua);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "UPDATE `product` SET product_stock = product_stock +".$devqua." WHERE product_id =".$pid.";";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_deliveries.php?error=stmtfailure");
    }
    //mysqli_stmt_bind_param($stmt, "ss", $pid, $devqua);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/supplier_deliveries.php?error=none");

}

function addSupply($conn, $pid, $devqua) {
    $sql = "UPDATE `product` SET product_stock = product_stock + ? WHERE product_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../pages/supplier_deliveries.php?error=stmtfailure");
    }
    mysqli_stmt_bind_param($stmt, "ss", $pid, $devqua);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../pages/supplier_deliveries.php?error=none");
}

function emptyInputSuppDev($devqua) {
    $result;

    if(empty($devqua)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}