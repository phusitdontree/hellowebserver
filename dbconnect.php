<?php 

include ("configs/connectstring.php");
//mysql_connect ($host,$user,$pass) or die ("ติดต่อเครื่อง Database Server ไม่สำเร็จ");
//mysql_select_db($db) or die ("ติดต่อฐานข้อมูลไม่สำเร็จ");
//mysql_query("SET NAMES utf8")
// Create connection
$conn = new mysqli($host, $user, $pass,$db);
$conn->query("SET NAMES UTF8");

//$conn->query("SET NAMES TIS-620");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//else echo "connected";

?>