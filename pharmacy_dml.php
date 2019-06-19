<?php
    include("config.php");
    require  'bot/src/Medoo.php';
    use Medoo\Medoo;

    $pdo = new PDO("mysql:dbname=$dbDatabase;host=$dbServer", $dbUsername, $dbPassword);
 
    $database = new Medoo([
	// Initialized and connected PDO object
	'pdo' => $pdo,
 
	// [optional] Medoo will have different handle method according to different database type
	'database_type' => 'mysql'
    ]);

    if(isset($_POST['table'])){
        $table=$_POST['table'];
    }
    if(isset($_POST['tag'])){
        $tag=$_POST['tag'];
    }
    if(isset($_POST['doctor'])){
        $doctor=$_POST['doctor'];
    }
    if(isset($_POST['patient'])){
        $patient=$_POST['patient'];
    }
 
    switch($table){
        case 'getPres':
            $datas = $database->select("prescriptions","*",["patient" => $tag]);
            echo json_encode($datas);
            $del = $database->delete("prescriptions", ["AND" => ["patient" => $tag]]);
        break;
        case 'getDes':
            $datas = $database->select("docdes","*",["id" => $tag]);
            echo json_encode($datas);
            $del = $database->delete("docdes", ["AND" => ["id" => $tag]]);
        break;
    }