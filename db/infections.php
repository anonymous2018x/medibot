<?PHP 
require_once('conn.php');
$inf=$_POST['inf'];
$sth = $conn->prepare("SELECT * FROM infkey WHERE inf LIKE :inf");
$sth->bindParam(':inf', $inf);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
$conn = null;
?>