<?PHP 
require_once('conn.php');
$id=$_POST['id'];
    $sth = $conn->prepare("DELETE FROM `online` WHERE `online`.`id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
$conn = null;
?>
