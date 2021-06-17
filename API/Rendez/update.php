<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate User object

$User  = new Rendez($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));



$Rendez->Date_Rend = $data->Date_Rend;
$Rendez->ID_Journee = $data->ID_Journee;
$Rendez->descreption = $data->descreption;

$Rendez->Ref = $data->Ref;
if ($Rendez->Update_Rendez()) {
    echo json_encode(
        array('message' => 'Rendez Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Rendez Not Updated')
    );
}
