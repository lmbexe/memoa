<?php
header("Access-Control-Allow-Origin: *");

require_once '../config/db.php';

try {
    $db = new Database();
    echo "yes";
} catch (Exception $e) {
    echo "no";
}
?>