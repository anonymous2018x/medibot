<?php
require_once('conn.php');
$id=$_POST["id"];

$sth = $conn->prepare("SELECT * FROM account WHERE id=:id");
$sth->bindParam(':id', $id);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
?>