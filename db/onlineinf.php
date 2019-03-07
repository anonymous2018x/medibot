<?PHP 
require_once('conn.php');

$type=$_POST['type'];
$id=$_POST['id'];
$inf=$_POST['inf'];
$sth = $conn->prepare("INSERT INTO onlineinf(id, inf, type)
VALUES (:id, :inf, :type)");
$sth->bindParam(':id', $id);
$sth->bindParam(':inf', $inf);
$sth->bindParam(':type', $type);
$result=$sth->execute();
echo json_encode($result);
$conn = null;
?>
