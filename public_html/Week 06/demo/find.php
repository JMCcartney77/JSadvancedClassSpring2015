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


    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $password = sha1($password);

    $response['data'] = array(
        "username" => $username,
        "password" => $password
    );
    
    $db = new PDO($dbConfig['DB_DNS'], $dbConfig['DB_USER'], $dbConfig['DB_PASSWORD']);

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    $status = 200;
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $response['data'] = $results;
    } else {
        $status = 500;
        $response['message'] = 'User was not found';
        $response['errors'] = $db->errorInfo();       
    }


    $response['status_code'] = $status;
    $response['status_message'] = $status_codes[$status];


    header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");

    header("Content-Type: application/json");
    header("HTTP/1.1 " . $status . " " . $status_codes[$status]);
    echo json_encode($response, JSON_PRETTY_PRINT);
