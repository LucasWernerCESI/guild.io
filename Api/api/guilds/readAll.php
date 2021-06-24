<?php

use Classes\Database;
use Classes\Guild;

include_once('../../vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


try {

    $item = new Guild(Database::getConnection());


    $stmt = $item->getAllGuilds();
    $itemCount = $stmt->rowCount();

    var_dump($itemCount);

    echo json_encode($itemCount);

    if($itemCount > 0){

        $guildsArray = array();
        // $guildsArray["body"] = array();
       // $guildsArray["itemCount"] = $itemCount;

        // 1 statement = ensemble de données de mon mon résultat de ma requête SQL --> marqueur qui se met dans la mémoire du pc -> le statement c'est un pointeur --> ensemble de cases
        // BDD = 1 enregistrement = plusieurs champs

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  //fetch --> créer le tableau, récupère ligne par ligne
       // extract($row); // extract --> créer une variable par champs
        $e = array(
            "id" => $row["id"],  //[liste]
            "name" => $row["name"],
            "text" => $row["text"],
            "email" => $row["blazon"],
            "creationDate" => $row["creationDate"],
            "age" => $row["gameId"]
        );

        array_push($guildsArray, $e); // stock les résultats dans un tableau
    }

    echo json_encode($guildsArray);  //renvoie les données en json
    } else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Guilde inexistante.")
    );
}

} catch (Exception $e) {
}

?>