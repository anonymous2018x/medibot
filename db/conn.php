<?PHP
$user='root';
$pass='';

// creates a db connection
try{
$conn= new PDO('mysql:host=localhost;dbname=bot',$user,$pass);
// echo "con was success";
}catch(PDOExemption $e){
    print "Error!:" . $e->getMessage() . "<br/>";
    die();
}
?>