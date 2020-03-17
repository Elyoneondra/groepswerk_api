<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
require_once "../lib/autoload.php";

$api = $Container->getTaskLoader();

switch($requestMethod) {
    case 'GET':
        $api->getTasks();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>