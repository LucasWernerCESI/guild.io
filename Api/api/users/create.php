<?php

include_once(dirname(__DIR__) . '../vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// guild.io/Api/api/users/create.php

use Classes\Database;
use Classes\User;

// $db = Database::getConnection();

$item = new User(Database::getConnection());

$data = json_decode(file_get_contents("php://input"));

$item->pseudo = $data->pseudo;
$item->email = $data->email;
$item->birthday = date('Y-m-d H:i:s');
$item->hashedPassword = $data->hashedPassword;
$item->creationDate = date('Y-m-d H:i:s');
$item->roleId = $data->roleId;
$item->guildId = $data->guildId;
$item->gameId = $data->gameId;
$item->languageId = $data->languageId;


if($item->createUser()){
    echo "Utilisateur créé avec succès.";
} else{
    echo "La création de l'utilisateur a échoué.";
}
?>