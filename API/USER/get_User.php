<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

$User = new User($db);

// $User->Ref = isset($_GET['Ref']) ? $_GET['Ref'] : die();

$data = json_decode(file_get_contents("php://input"));
$User->Ref = $data->Ref;

// die(print_r($_GET['Ref']));
$User->get_User();

$User_item = array(
    'ID_USER' => $User->ID_USER,
    'NAME' => $User->NAME,
    'F_Name' => $User->F_Name,
    'EMAIL' => $User->EMAIL,
    'Ref' => $User->Ref
);
echo json_encode($User_item);
