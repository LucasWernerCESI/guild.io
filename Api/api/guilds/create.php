<?php

include_once('../../vendor/autoload.php');

use Classes\Database;
use Classes\Guild;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// guild.io/Api/api/users/create.php

try {

    $receivedData = json_decode(file_get_contents("php://input"));  //input de php qui vient dur font en tant que json, $data récupère les infos du front en json qui représentent les infos nécessaires pour créer un utlisateur

    $item = new Guild(Database::getConnection(),null, $receivedData->name, $receivedData->text,$receivedData->blazon,"now", $receivedData->gameId);

    //var_dump($data);


    if($item->createGuild()){
        echo "Guilde créé avec succès.";
    } else{
        echo "La création de la guilde a échoué.";
    }
} catch (Exception $e) {
}



?>