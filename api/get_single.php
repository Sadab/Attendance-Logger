<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Record.php';

    $database = new Database();
    $db = $database->connect();

    $record = new Record($db);

    $record->id = isset($_GET['id']) ? $_GET['id'] : die();

    $record->getSingleUserData();

    $record_arr = array(
        'id' => $record->id,
        'time' => $record->time
    );

    print_r(json_encode($record_arr));