<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$db_host = 'srv1934.hstgr.io';
$db_user = 'u719432153_Faheem';
$db_pass = '$Bf1Yl=QAYZb';
$db_name = 'u719432153_Faheem';

try {
    // MySQLi ko hata kar Vercel native PDO driver connection set kiya hai
    $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Baaki components ke global usage ke liye
    $GLOBALS['con'] = $con;

} catch (PDOException $e) {
    die('Connection Not Established: ' . $e->getMessage());
}

try {
    $company_sql = "SELECT * FROM company_info WHERE status = '1' AND close = '1'";
    $stmt = $con->query($company_sql);

    // Dynamic data fetch assignments
    while ($key = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['com_name']    = $key['com_name'];
        $_SESSION['com_phone']   = $key['com_phone'];
        $_SESSION['com_email']   = $key['com_email'];
        $_SESSION['com_logo']    = $key['com_logo'];
        $_SESSION['com_address'] = $key['com_address'];
    }
} catch (Exception $e) {
    // Database exceptions handler
}
?>
