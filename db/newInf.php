<?PHP 
require_once('conn.php');
$inf=$_POST['inf'];
$type=$_POST['type'];
$des=$_POST['des'];
$sth = $conn->prepare("INSERT INTO infkey (inf, type, text)
VALUES (:inf, :type, :des)");
$sth->bindParam(':inf', $inf);
$sth->bindParam(':type', $type);
$sth->bindParam(':des', $des);
if($sth->execute()){
echo json_encode("[{'send':true}]");
}
$conn = null;
?>
