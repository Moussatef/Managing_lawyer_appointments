<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once '../../Config/Database.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

$User = new User($db);

$User->Ref = isset($_GET['Ref']) ? $_GET['Ref'] : die();

$User->get_User();



$User_item = array(
    'ID_USER' => $User->ID_USER,
    'NAME' => $User->NAME,
    'F_Name' => $User->F_Name,
    'EMAIL' => $User->EMAIL,
    'Ref' => $User->Ref
);
echo json_encode($User_item);
