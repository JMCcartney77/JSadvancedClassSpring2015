<?php

    $status_codes = array(
        200 => 'OK',
        500 => 'Internal Server Error',
    );

    $response = array(
        "status_code" => 200,
        "status_message" => 'OK',
        "message" => NULL,
        "errors" => NULL,
        "data" => NULL
    );

    $dbConfig = array(
        "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=JSadvClassSpring2015',
        "DB_USER" => 'root',
        "DB_PASSWORD" => ''
    );


    $binds = filter_input_array(INPUT_POST);
    $status = 200;


    $db = new PDO($dbConfig['DB_DNS'], $dbConfig['DB_USER'], $dbConfig['DB_PASSWORD']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $db->prepare("INSERT INTO users SET username = :username, password = :password");

    $binds[':password'] = sha1($binds[':password']);


    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $response['message'] = 'User Added';
    } else {
        $response['message'] = 'User was not added';
        $response['errors'] = $db->errorInfo();
        $status = 500;
    }


    $response['status_code'] = $status;
    $response['status_message'] = $status_codes[$status];
    $response['data'] = $binds;


    header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");

    header("Content-Type: application/json");
    header("HTTP/1.1 " . $status . " " . $status_codes[$status]);
    echo json_encode($response, JSON_PRETTY_PRINT);
