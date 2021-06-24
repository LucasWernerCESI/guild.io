<?php

include_once('../../vendor/autoload.php');

use Classes\Database;
use Classes\User;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// guild.io/Api/api/users/create.php

try {

    $receivedData = json_decode(file_get_contents("php://input"));  //input de php qui vient dur font en tant que json, $data récupère les infos du front en json qui représentent les infos nécessaires pour créer un utlisateur

    $item = new User(Database::getConnection(), $receivedData->username,$receivedData->mail, "now", password_hash($receivedData->password, PASSWORD_DEFAULT), $receivedData->birthday, 1,  $receivedData->game, 1, $receivedData->lang);

    //var_dump($data);

    if( $item->createUser() ){
        echo json_encode( [
            "message" => "Utilisateur créé avec succès.",
            "code" => 200
        ] );
    } else {
        echo json_encode( [
            "message" => "La création de l'utilisateur a échoué.",
            "code" => 200
        ] );
    }
} catch (Exception $e) {
    echo json_encode( [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ] );
}



?>