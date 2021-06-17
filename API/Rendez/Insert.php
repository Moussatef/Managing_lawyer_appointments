<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database;
$db = $database->conx();

// Instantiate Rendez object
$User = new User($db);
$Rendez  = new Rendez($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$Rendez->Date_Rend = $data->Date_Rend;
$Rendez->ID_Journee = $data->ID_Journee;
$Rendez->description = $data->description;
$Rendez->ID_USER = $data->ID_USER;
$User->Ref = $data->Ref;


//chack referance
$num =  $User->get_User();
if ($num)
    // Create post
    if ($Rendez->InsertRendez()) {
        echo json_encode(
            array('message' => 'Rendez Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Rendez Not Created')
        );
    }
else
    echo json_encode(
        array(
            'message' => 'Referance Not Fonde',
            'numRow ' => $num
        )
    );
