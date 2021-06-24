<?php

use Classes\Application;
use Classes\Database;


include_once('../../vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


try {

    $item = new Application(Database::getConnection());


    $stmt = $item->getAllApplications();
    $itemCount = $stmt->rowCount();

    var_dump($itemCount);

    echo json_encode($itemCount);

    if($itemCount > 0){

        $applicationsArray = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  //fetch --> créer le tableau, récupère ligne par ligne

            $e = array(
                "id" => $row["id"],  //[liste]
                "userId" => $row["userId"],
                "guildId" => $row["guildId"],
                "motivation" => $row["motivation"],
                "PVP_or_PVE" => $row["PVP_or_PVE"],
                "creationDate" => $row["creationDate"]
            );

            array_push($applicationsArray, $e); // stock les résultats dans un tableau
        }

        echo json_encode($applicationsArray);  //renvoie les données en json
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Candidature inexistante.")
        );
    }

} catch (Exception $e) {
}

?>