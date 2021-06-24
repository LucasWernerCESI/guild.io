<?php

include_once('../../vendor/autoload.php');

use Classes\Database;
use Classes\Guild;

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

    $item = new Guild(Database::getConnection(), $receivedData->id);

        $item->getSingleGuild();

// Recherche de la guilde via son id

        if ($item->id != null) {
            // create array
            $guild_arr = array(
                "id" => $item->id,
                "name" => $item->name,
                "text" => $item->text,
                "blazon" => $item->blazon,
                "creationDate" => $item->creationDate,
                "gameId" => $item->gameId,
            );


            http_response_code(200);
            echo json_encode($guild_arr);
        } else {
            http_response_code(404);
            echo json_encode("Guild not found.");
        }

} catch (Exception $e) {
}

?>