<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';

// Instantiate DB & connect
$database = new Database;
$db = $database->conx();

// Instantiate Etudiant object

$User  = new Rendez($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$Rendez->Date_Rend = $data->Date_Rend;
$Rendez->ID_Journee = $data->F_Name;
$Rendez->description = $data->description;
$Rendez->ID_USER = $data->ID_USER;


// Create post
if ($Rendez->Insert_Rendez()) {
    echo json_encode(
        array('message' => 'Rendez Created')
    );
} else {
    echo json_encode(
        array('message' => 'Rendez Not Created')
    );
}
