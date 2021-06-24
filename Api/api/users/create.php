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

    $item = new User(Database::getConnection(), $receivedData->pseudo,$receivedData->email, "now", password_hash($receivedData->password, PASSWORD_DEFAULT), $receivedData->birthday,$receivedData->guildId,  $receivedData->gameId, $receivedData->roleId, $receivedData->languageId);

    //var_dump($data);



    if($item->createUser()){
        echo "Utilisateur créé avec succès.";
    } else{
        echo "La création de l'utilisateur a échoué.";
    }
} catch (Exception $e) {
}



?>