<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../Config/Database.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate User object

$User  = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));



$User->NAME = $data->NAME;
$User->F_Name = $data->F_Name;
$User->EMAIL = $data->EMAIL;

$User->Ref = $data->Ref;
if ($User->Update_User()) {
    echo json_encode(
        array('message' => 'User Updated')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Updated')
    );
}
