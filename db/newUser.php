<?PHP 
require_once('conn.php');
$id=$_POST['id'];
$type=$_POST['type'];
$pass=$_POST['pass'];
$sth = $conn->prepare("INSERT INTO account(owner, id, pass)
VALUES (:type, :id, :pass)");
$sth->bindParam(':id', $id);
$sth->bindParam(':type', $type);
$sth->bindParam(':pass', $pass);
if($sth->execute()){
echo json_encode("[{'send':true}]");
}
$conn = null;
?>
