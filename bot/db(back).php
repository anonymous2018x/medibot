<?php
     include("../config.php");
    require  'src/Medoo.php';
    use Medoo\Medoo;

    $pdo = new PDO("mysql:dbname=$dbDatabase;host=$dbServer", $dbUsername, $dbPassword);

    $database = new Medoo([
	// Initialized and connected PDO object
	'pdo' => $pdo,
 
	// [optional] Medoo will have different handle method according to different database type
	'database_type' => 'mysql'
    ]);
    $dt=date("y-m-d H:i:s");
    $data=$database->insert("online",[
        "category"=>"doctor",
        "patient"=>"12345678",
        "doctor"=>0,
        "date"=>$dt,
        "status"=>"waiting",
        "name"=>"Denno"
    ]);
    if(isset($_POST['table'])){
        $table=$_POST['table'];
    }
    if(isset($_POST['tag'])){
        $tag=$_POST['tag'];
    }
    if(isset($_POST['patient'])){
        $patient=$_POST['patient'];
    }
    if(isset($_POST['p_name'])){
        $p_name=$_POST['p_name'];
    }
    switch($table){
        case 'infections':
            $datas = $database->select("infections","*");
            $mapping_array  = array('id' => 'value', 'name' => 'text');
            $tmp_arr =  array_map(function($k){ return '/\b'.$k.'\b/u'; }, array_keys($mapping_array));
            $new_json =  preg_replace($tmp_arr, array_values($mapping_array), json_encode($datas));
            echo $new_json;
        break;
        case 'descriptions':
            $datas = $database->select("descriptions","*",["infection" => $tag]);
            $mapping_array  = array('id' => 'value', 'description' => 'text');
            $tmp_arr =  array_map(function($k){ return '/\b'.$k.'\b/u'; }, array_keys($mapping_array));
            $new_json =  preg_replace($tmp_arr, array_values($mapping_array), json_encode($datas));
            echo $new_json;
        break;
        case 'descriptions':
            $datas = $database->select("descriptions","*",["entry" => $tag]);
            echo json_encode($datas);
        break;
        case 'getsym':
            $datas = $database->select("infections","*",["id" => $tag]);
            echo json_encode($datas);
        break;
        case 'selections':
            $infection = $database->select("descriptions","infection",["id" => $tag]);
            $symptom = $database->select("descriptions","symptom",["id" => $tag]);
            $data=$database->insert("selections",[
                "selection"=>$tag,
                "patient"=>$patient,
                "symptom"=>$symptom[0],
                "infection"=>$infection[0]
            ]);
            if(!data){
                echo false;
            }
        break;
        case 'mkonline':
            $dt=date("y-m-d H:i:s");
            $pt = $database->select("online","patient",["patient" => $patient]);
            if($pt>0){
                $datas = $database->update("online",["date" => $dt],["patient" => $patient]);
                if(!data){
                    echo false;
                }
            }else{
                 $data=$database->insert("online",[
                    "category"=>$tag,
                    "patient"=>"$patient",
                    "doctor"=>0,
                    "date"=>$dt,
                    "status"=>"waiting",
                    "name"=>$p_name
                ]);
                if(!data){
                    echo false;
                }
            }
        break;
    }
    

    
?>
