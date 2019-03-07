<?PHP 
require_once('conn.php');

$type=$_POST['type'];
$id=$_POST['id'];
$nme=$_POST['nme'];
$state="inActive";
$sth = $conn->prepare("DELETE FROM `online` WHERE `online`.`id` = :id");
$sth->bindParam(':id', $id);
$sth->execute();
$sth = $conn->prepare("INSERT INTO online(id, name, type, dt, state)
VALUES (:id, :nme, :type, NOW(), :state)");
$sth->bindParam(':type', $type);
$sth->bindParam(':id', $id);
$sth->bindParam(':nme', $nme);
$sth->bindParam(':state', $state);
// $sth->bindParam(':d', $datetime);
$sth->execute();
echo json_encode($result);
$conn = null;
?>
