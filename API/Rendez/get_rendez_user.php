<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate Rendez object

$Rendez = new Rendez($db);

$data = json_decode(file_get_contents("php://input"));
$Rendez->ID_USER = $data->ID_USER;

$num = $Rendez->get_Rendez_User();
if ($num) {
    $Rendez->get_Rendez_User();

    $Rendez_item = array(
        'ID_Rend' => $Rendez->ID_Rend,
        'Date_Rend' => $Rendez->Date_Rend,
        'Time_IN' => $Rendez->Time_IN,
        'Time_TO' => $Rendez->Time_TO,
        'description' => $Rendez->description
    );
    echo json_encode($Rendez_item);
} else {
    echo json_encode(
        array('message' => 'NO Rondez vous existe !!')
    );
}
