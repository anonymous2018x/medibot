<?PHP 
require_once('conn.php');

$pres=$_POST['pres'];
$amount=$_POST['amount'];
$drug=$_POST['drug'];
$des=$_POST['des'];
$id=$_POST['id'];
$doc=$_POST['doc'];

if($des){
    $sth = $conn->prepare("INSERT INTO `pres-description`(id, des)
    VALUES (:id, :des)");
    $sth->bindParam(':id', $id);
    $sth->bindParam(':des', $des);
    if($sth->execute()){
    echo json_encode("[{'send':true}]");
    }
    $conn = null; 
}
$sth = $conn->prepare("INSERT INTO pres(id, drug, amount, pres, doc)
VALUES (:id, :drug, :amount, :pres, :doc)");
$sth->bindParam(':id', $id);
$sth->bindParam(':drug', $drug);
$sth->bindParam(':amount', $amount);
$sth->bindParam(':pres', $pres);
$sth->bindParam(':doc', $doc);
if($sth->execute()){
echo json_encode("[{'send':true}]");
}
$conn = null;
?>
