<?PHP 
require_once('conn.php');
$id=$_POST["id"];

$sth = $conn->prepare("SELECT * FROM chat WHERE sender=:id");
$sth->bindParam(':id', $id);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);

$sth = $conn->prepare("DELETE FROM chat WHERE sender=:id");
$sth->bindParam(':id', $id);
$sth->execute();
$conn = null;
?>