<?PHP 
require_once('conn.php');
$id=$_POST['id'];
    $sth = $conn->prepare("UPDATE `online` SET `state` = 'Connected' WHERE `online`.`id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
$conn = null;
?>
