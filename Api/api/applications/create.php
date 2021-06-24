<?php

include_once('../../vendor/autoload.php');

use Classes\Application;
use Classes\Database;


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// guild.io/Api/api/users/create.php

try {

    $receivedData = json_decode(file_get_contents("php://input"));  //input de php qui vient dur font en tant que json, $data récupère les infos du front en json qui représentent les infos nécessaires pour créer un utlisateur

    $item = new Application(Database::getConnection(),null, $receivedData->userId, $receivedData->guildId,$receivedData->motivation, $receivedData->PVP_or_PVE, "now");

    // var_dump($item);


    if($item->createApplication()){
        echo "Candidature créé avec succès.";
    } else{
        echo "La candidature a échoué.";
    }
} catch (Exception $e) {
}



?>