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
// $Rendez->Date_Rend = isset($_GET['date']) ? $_GET['date'] : die();
$data = json_decode(file_get_contents("php://input"));
$Rendez->Date_Rend = $data->Date_Rend;
$Rendez->ID_USER = $data->ID_USER;


$date1 = new DateTime($Rendez->Date_Rend);
$date2 =  Date("Y-m-d");

// Compare the dates
if ($date1->format("Y-m-d") >= $date2) {
    $result = $Rendez->getDateRendezDispo();
    if ($result != false) {


        $num = $result->rowCount();

        if ($num > 0) {
            $Rendez_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $Rendez_item = array(
                    'ID_Journee' => $ID_Journee,
                    'creneau' => 'créneau de ' . $Time_IN . 'h à ' . $Time_TO . 'h'
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
            array('message' => 'You already taken a meeting this date')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Date is olde than now ')
    );
}
