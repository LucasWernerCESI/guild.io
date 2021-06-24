<?php

use Classes\Character;
use Classes\Database;


include_once('../../vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


try {

    $item = new Character(Database::getConnection());


    $stmt = $item->getAllCharacters();
    $itemCount = $stmt->rowCount();

    var_dump($itemCount);

    echo json_encode($itemCount);

    if($itemCount > 0){

        $charactersArray = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  //fetch --> créer le tableau, récupère ligne par ligne

            $e = array(
                "id" => $row["id"],  //[liste]
                "userId" => $row["userId"],
                "raceId" => $row["raceId"],
                "level" => $row["level"],
                "professionId" => $row["professionId"],
                "classId" => $row["classId"],
                "factionId" => $row["factionId"]
            );

            array_push($charactersArray, $e); // stock les résultats dans un tableau
        }

        echo json_encode($charactersArray);  //renvoie les données en json
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Guilde inexistante.")
        );
    }

} catch (Exception $e) {
}

?>