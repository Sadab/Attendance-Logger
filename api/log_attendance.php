<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../config/Database.php';
    include_once '../models/Record.php';

    $database = new Database();
    $db  = $database->connect();

    $record = new Record($db);

    $data = json_decode(file_get_contents("php://input"));

    $record->id = $data->id;
    $record->time = $data->time;

    if($record->logAttendance()) {
        echo json_encode(
          array('result' => 'true', 'message' => 'Logged')
        );
    } else {
        echo json_encode(
            array('result' => 'false' , 'message' => 'Invalid UID')
        );
    }
