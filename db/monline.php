<?PHP 
require_once('conn.php');

$id=$_POST['id'];
$dt=date("y-m-d H:i:s");

$sth = $conn->prepare("UPDATE `online` SET `dt` = :dt WHERE `id` = :id");
$sth->bindParam(':id', $id);
$sth->bindParam(':dt', $dt);
$sth->execute();
echo json_encode($result);
$conn = null;
?>
