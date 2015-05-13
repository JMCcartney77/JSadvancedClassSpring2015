<?php

$verb = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

$data = array();

 if ( $verb == 'POST' ) {
     $data = filter_input_array(INPUT_POST);
 }
 
  if ( $verb == 'GET' ) {
     $data = filter_input_array(INPUT_GET);
 }
 
 
 $dbConfig = array(
        "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=JSadvClassSpring2015',
        "DB_USER" => 'root',
        "DB_PASSWORD" => ''
    );

  $db = new PDO($dbConfig['DB_DNS'], $dbConfig['DB_USER'], $dbConfig['DB_PASSWORD']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $db->prepare("INSERT INTO stuff SET fname = :fname, colors = :colors, ranges = :ranges, dob = :dob");


    if ($stmt->execute($data) && $stmt->rowCount() > 0) {
        $data['message'] = 'User Added';
    } else {
        $data['message'] = 'User was not added';      
    }
 
 
 $data['verb'] = $verb;
 
 
 
 
echo json_encode($data, JSON_PRETTY_PRINT);
