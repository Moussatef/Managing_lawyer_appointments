<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate User object

$Rendez  = new Rendez($db);
$User  = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$Rendez->Date_Rend = $data->Date_Rend;
$Rendez->ID_Journee = $data->ID_Journee;
$Rendez->description = $data->description;
$Rendez->ID_Rend = $data->ID_Rend;
// $User->Ref = $data->Ref;
$date1 = new DateTime($Rendez->Date_Rend);
$date2 =  Date("Y-m-d");

// Compare the dates
if ($date1->format("Y-m-d") >= $date2) {
    if ($Rendez->UpdateRendez()) {
        echo json_encode(
            array('message date 1' =>   "  Rendez  Updated  " . $date2)
        );
    } else {
        echo json_encode(
            array('message' => 'Rendez Not Updated')
        );
    }
} else {
    echo json_encode(
        array('message date must be  future than now' => $date1->format("Y-m-d") . " is older than "
            . $date2)
    );
}
