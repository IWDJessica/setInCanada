<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
    //https://stackoverflow.com/questions/40497399/http-request-from-angular-sent-as-options-instead-of-post
    //https://stackoverflow.com/a/58052524
}
?>