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

    $data = json_decode(file_get_contents("php://input"));

    $item = new User(Database::getConnection(), $data->pseudo,$data->email, "now", $data->password,$data->birthday,$data->guildId,  $data->gameId, $data->roleId, $data->languageId);

    //var_dump($data);

    if($item->createUser()){
        echo "Utilisateur créé avec succès.";
    } else{
        echo "La création de l'utilisateur a échoué.";
    }
} catch (Exception $e) {
}



?>