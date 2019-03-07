<?PHP 
require_once('conn.php');
$inf=$_POST(inf);

$sth = $conn->prepare("SELECT `sym`FROM infsym WHERE inf=:inf ORDER BY sym");
$sth->bindParam(':inf', $inf);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
$conn = null;
?>