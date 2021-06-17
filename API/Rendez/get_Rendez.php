<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Model/Rendez.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate Rendez object

$Rendez = new Rendez($db);

$result = $User->get_Rendez();

$num = $result->rowCount();

if ($num > 0) {
    $Rendez_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $Rendez_item = array(
            'ID_Rend' => $ID_Rend,
            'Date_Rend' => $Date_Rend,
            'ID_Journee' => $ID_Journee,
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
