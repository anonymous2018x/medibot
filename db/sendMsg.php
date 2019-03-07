<?PHP 
require_once('conn.php');

$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$msg=$_POST['msg'];

$sth = $conn->prepare("INSERT INTO chat(receiver, sender, msg)
VALUES (:receiver, :sender, :msg)");
$sth->bindParam(':receiver', $receiver);
$sth->bindParam(':sender', $sender);
$sth->bindParam(':msg', $msg);
if($sth->execute()){
echo json_encode("[{'send':true}]");
}
$conn = null;
?>
