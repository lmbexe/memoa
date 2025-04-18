<?php

require_once __DIR__ . '/../config/db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

$donnees = json_decode(file_get_contents("php://input"), true);
$login = $donnees['login'] ?? '';
$password = $donnees['password'] ?? '';
$db = new Database();

if (!empty($login) && !empty($password)) {
    $user = $db->userExist($login, $password);
    if ($user) {
        echo json_encode([
            "success" => true,
            "message" => "Connexion réussie",
            "userId" => $user['id']
        ]);
        exit();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Identifiants incorrects"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Veuillez remplir tous les champs"
    ]);
}


