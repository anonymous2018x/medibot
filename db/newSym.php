<?PHP 
require_once('conn.php');
$type=$_POST['type'];
$sth = $conn->prepare("INSERT INTO symptoms(`text`)
VALUES (:type)");
$sth->bindParam(':type', $type);
if($sth->execute()){
echo json_encode("[{'send':true}]");
}
$conn = null;
?>
