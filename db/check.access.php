<?php
require_once('conn.php');
$id=$_POST['id'];
$pass=$_POST['pass'];
$utype = $_POST['utype'];
$sth = $conn->prepare("SELECT * FROM account WHERE owner like :utype and id= :id and pass= :pass");
$sth->bindParam(':id', $id);
$sth->bindParam(':utype', $utype);
$sth->bindParam(':pass', $pass);
$sth->execute();
$result = $sth->fetchAll();
if(sizeof($result)>0)
{  
    $_SESSION['login_id']=$id;
    $_SESSION['login_id']=$id; 
    switch($utype){
        case 'Doctor':
        header("Location:../pages/doc.php?login=".$id);
        break;
        case 'Pharmacy':
        header("Location:../pages/phamacy.php?login=".$id);
        break;
        case 'Admin':
        header("Location:../pages/admin.php?login=".$id);
        break;
        default:
        header("index.php?login=false");        
        break;
    }
}else
{
    header("Location:../pages/index.php?login=false");
}
$conn = null;
?>
