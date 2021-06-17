<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

$User->Ref = $data->Ref;

if ($User->Delete_User()) {
    echo json_encode(
        array('message' => 'User Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Deleted')
    );
}
