<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Record.php';

    $database = new Database();
    $db  = $database->connect();

    $record = new Record($db);

    $result = $record->getAllData();
    $num = $result->rowCount();

    if($num > 0){
        $record_arr = array();
        $record_arr['data'] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $record_item = array(
                'id' => $id,
                'time' => $time
            );
            array_push($record_arr['data'], $record_item);
        }
        echo  json_encode($record_arr);
    } else {
        echo json_encode(
            array('message' => 'ID not found')
        );
    }

