<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Model/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate User object

$User  = new User($db);

$result = $User->get_Users();

$num = $result->rowCount();

if ($num > 0) {
    $User_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $User_item = array(
            'ID_USER' => $ID_USER,
            'NAME' => $NAME,
            'F_Name' => $F_Name,
            'EMAIL' => $EMAIL,
            'Ref' => $Ref
        );

        array_push($User_arr, $User_item);
    }
    echo json_encode($User_arr);
} else {
    echo json_encode(
        array('message' => 'No User Found')
    );
}
