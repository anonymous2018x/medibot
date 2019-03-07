<?PHP 
require_once('conn.php');

$sth = $conn->prepare("SELECT `text`, `value` FROM symptoms ORDER BY value");
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
$conn = null;
?>