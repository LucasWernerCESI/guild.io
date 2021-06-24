<?php

include_once('../../vendor/autoload.php');

use Classes\Database;
use Classes\User;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//MVC = controller ? Modele View Controller, première architecture pour séparer le front du backend. Lien entre les 2 : le controller -- > Choix d'architecture
//DAO = Requête SQL Data Access Object -- > Choix d'architecture

// Front envoie des données au backend, le backend reçoit les infos et travaille avec
//READ.PHP PERMET AU USER DE S'AUTHENTIFIER (service d'authentification)


try {

    $receivedData = json_decode(file_get_contents("php://input"));

    $item = new User(Database::getConnection(), $receivedData->pseudo, "", "now", $receivedData->password);

// Si les mdp ne correspondent pas alors verifyUser renvoie null s'ils correspondent alors verifyUser renvoie l'id de l'utilisateur a qui correspondond le mdp
// !=   =  différent de null
    if (($varId=$item->verifyUser() )!= null) {

        $item->getSingleUser($varId);

        if ($item->pseudo != null) {
            // create array
            $user_arr = array(
                "id" => $item->id,
                "pseudo" => $item->pseudo,
                "email" => $item->email,
                "creationDate" => $item->creationDate,
                "birthday" => $item->birthday,
                "guildId" => $item->guildId,
                "gameId" => $item->gameId,
                "roleId" => $item->roleId,
                "languageId" => $item->languageId
            );


            http_response_code(200);
            echo json_encode($user_arr);
        } else {
            http_response_code(404);
            echo json_encode("User not found.");
        }
    }

} catch (Exception $e) {
}

?>