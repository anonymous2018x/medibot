<?php
require_once('conn.php');
$pid=$_POST["pid"];

$sth = $conn->prepare("SELECT * FROM pres WHERE id=:pid");
$sth->bindParam(':pid', $pid);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
$conn = null;
?>