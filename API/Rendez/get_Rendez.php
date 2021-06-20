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

$result = $Rendez->get_Rendez();

$num = $result->rowCount();

if ($num > 0) {
    $Rendez_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $Rendez_item = array(
            'ID_Rend' => $ID_Rend,
            'Date_Rend' => $Date_Rend,
            'Time_IN' => $Time_IN,
            'Time_TO' => $Time_TO,
            'description' => $description,
            'ID_USER' => $ID_USER
        );

        array_push($Rendez_arr, $Rendez_item);
    }
    echo json_encode($Rendez_arr);
} else {
    echo json_encode(
        array('message' => 'No Rendez-Vous Found')
    );
}
