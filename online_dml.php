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
        
        case 'getonline':
            $dt=date("y-m-d H:i:s");
            $data = $database->select("online","*",[
                "category" => $tag,
                "status" => "waiting",
                "LIMIT" => 1
            ]);
            $database->update("online",["status" => "connected", "doctor" => $doctor],["patient" => $data[0]['patient']]);
            echo json_encode($data);
        break;
        case 'sendchat':
            if(isset($_POST['receiver'])){
                $receiver=$_POST['receiver'];
            }
            if(isset($_POST['sender'])){
                $sender=$_POST['sender'];
            }

            $datas=$database->insert("chats",[
                "chat"=>$tag,
                "sender"=>$sender,
                "reciever"=>$receiver
            ]);
            if($datas){
                echo json_encode($datas);
            }
        break;
        case 'postPres':
            if(isset($_POST['prescription'])){
                $prescription=$_POST['prescription'];
            }
            if(isset($_POST['amount'])){
                $amount=$_POST['amount'];
            }
            if(isset($_POST['drug'])){
                $drug=$_POST['drug'];
            }
            if(isset($_POST['docdes'])){

                $docdes=$_POST['docdes'];
                $datas=$database->insert("docdes",[
                    "description"=>$docdes,
                    "id"=>$patient
                ]);
                if($datas){
                    echo json_encode($datas);
                }
            }

            $datas=$database->insert("prescriptions",[
                "prescription"=>$prescription,
                "amount"=>$amount,
                "patient"=>$patient,
                "drug"=>$drug,
                "doctor"=>$doctor
            ]);
            if($datas){
                echo json_encode($datas);
            }
        break;
        case 'getSym':
            $selections = array();
            $symptoms = $database->select("selections","selection",["patient" => $tag]);

            for ($i = 0; $i < sizeof($symptoms); $i++)
            {
                $sym=$database->select("descriptions","description",["id" => $symptoms[$i]]);
                array_push($selections,$sym[0]);
                $del = $database->delete("selections", ["AND" => ["patient" => $tag]]);
            }
            echo json_encode( $selections);
        break;
        case 'getChat':
            $datas = $database->select("chats","*",["sender" => $tag]);
            echo json_encode($datas);
            $del = $database->delete("chats", ["AND" => ["sender" => $tag]]);
        break;
        case 'isonline':
            $dt= (new \DateTime())->format("y-m-d H:i:s");
        break;
    }
    
?>