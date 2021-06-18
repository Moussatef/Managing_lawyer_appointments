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
$Rendez->Date_Rend = isset($_GET['date']) ? $_GET['date'] : die();

$date1 = new DateTime($Rendez->Date_Rend);
$date2 =  Date("Y-m-d");

// Compare the dates
if ($date1->format("Y-m-d") >= $date2) {
    $result = $Rendez->getDateRendezDispo();

    $num = $result->rowCount();

    if ($num > 0) {
        $Rendez_arr = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $Rendez_item = array(
                'ID_Rend' => $ID_Journee,
                'Time_IN' => $Time_IN,
                'Time_TO' => $Time_TO,
            );
            array_push($Rendez_arr, $Rendez_item);
        }
        echo json_encode($Rendez_arr);
    } else {
        echo json_encode(
            array('message' => ' No Rendez-Vous Found ')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Date is olde than now ')
    );
}
