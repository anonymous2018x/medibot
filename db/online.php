<?PHP 
require_once('conn.php');
$type=$_POST['type'];

$sth = $conn->prepare("SELECT * FROM online WHERE type LIKE :type and DATEDIFF(NOW(),dt)>=0 and TIME_TO_SEC(TIMEDIFF(NOW(),dt))<=20 and state LIKE'inActive' LIMIT 3");
$sth->bindParam(':type', $type);
$sth->execute();
$result = $sth->fetchAll();
echo json_encode($result);
for($i=0;$i<sizeof($result);$i++){
    $id=$result[$i][0];
    $sth = $conn->prepare("UPDATE `online` SET `state` = 'Active' WHERE `online`.`id` = :id");
    $sth->bindParam(':id', $id);
    $sth->execute();
}
$conn = null;
?>
