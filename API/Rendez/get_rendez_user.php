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

$result = $Rendez->get_Rendez_User();

$num = $result->rowCount();
if ($num) {
    $Rendez_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $Rendez_item = array(
            'ID_Rend' => $ID_Rend,
            'Date_Rend' => $Date_Rend,
            'Time_IN' => $Time_IN,
            'Time_TO' => $Time_TO,
            'description' => $description
        );

        array_push($Rendez_arr, $Rendez_item);
    }
    echo json_encode($Rendez_arr);
} else {
    echo json_encode(
        array('ID_Rend' => 0)
    );
}
