<?php

include_once('../../vendor/autoload.php');

use Classes\Application;
use Classes\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



try {
    $receivedData = json_decode(file_get_contents("php://input"));

    $item = new Application(Database::getConnection(), $receivedData->id);

    $item->getSingleApplication();

// Recherche d'une candidature via son id

    if ($item->id != null) {
        // create array
        $character_arr = array(
            "id" => $item->id,
            "userId" => $item->userId,
            "guildId" => $item->guildId,
            "motivation" => $item->motivation,
            "PVP_or_PVE" => $item->PVP_or_PVE,
            "creationDate" => $item->creationDate
        );


        http_response_code(200);
        echo json_encode($character_arr);
    } else {
        http_response_code(404);
        echo json_encode("Character not found.");
    }

} catch (Exception $e) {
}

?>