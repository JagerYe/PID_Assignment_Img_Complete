<?php
session_start();
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/core/api.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment_Img_Complete/core/Controller.php";

try {
    $api = new Api();
} catch (Exception $err) {
    return false;
}
