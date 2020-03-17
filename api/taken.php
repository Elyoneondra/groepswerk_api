<?php

require_once "../lib/autoload.php";
$taskLoader = $Container->getTaskLoader();
$requestMethod = $_SERVER["REQUEST_METHOD"];

$url_parts = explode("/",$_SERVER['REQUEST_URI']);
$count = count($url_parts);
$last_part = $url_parts[$count-1];
$previous_part = $url_parts[$count-2];

//Het opvragen van alle taken en het aanmaken van een nieuwe taak
if($url_parts[5] === 'taken') {
    switch ($requestMethod) {
        case 'GET':
            echo $taskLoader->getTasks();
            echo "get";
            break;
        case 'POST':
            echo  $taskLoader->addTask();
            echo "post";
            break;
        default:
            echo 'ERROR';
            break;

    }
}
//Het opvragen van 1 taak, een taak updaten en een taak verwijderen
elseif ($url_parts[5]==="taak" && $count === 7) {
    switch ($requestMethod) {
        case 'GET':
            $data = $taskLoader->getOneTask($last_part);
            echo $data;
            break;
        case 'PUT':
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            echo $taskLoader->updateTask($last_part, $data);
            break;
        case 'DELETE':
            $data = $taskLoader->deleteTask($last_part);
            echo json_encode($data);
            break;
        default:
            echo 'ERROR';
            break;
    }
} else {
    echo "ERROR";
}





?>