<?PHP 
require_once('conn.php');
$id=$_POST['id'];

$sth = $conn->prepare("SELECT * FROM onlineinf WHERE id=:id ORDER BY id");
$sth->bindParam(':id', $id);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
// $sth = $conn->prepare("DELETE FROM `onlineinf` WHERE `onlineinf`.`id` = :id");
// $sth->bindParam(':id', $id);
// $sth->execute();
$conn = null;
?>