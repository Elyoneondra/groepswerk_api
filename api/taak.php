<?php

$requestMethod = $_SERVER["REQUEST_METHOD"];
require_once "../lib/autoload.php";

$api = $Container->getTaskLoader();

switch($requestMethod) {
    case 'GET':
        $id = '';
        if($_GET['id']) {
            $id = $_GET['id'];
        }
        $api->getOneTask($id);
        break;
    case 'POST':
        $api->addTask();
        break;
    case 'PUT':
        $api->updateTask();
        break;
    case 'DELETE':
        $id = '';
        if($_GET['id']) {
            $id = $_GET['id'];
        }
        $api->deleteTask($id);
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;

}

