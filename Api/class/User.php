<?php

namespace Classes;


use Classes\Database;
use DateTime;
use DateTimeZone;
use PDO;

class User
{


    // Connection
    private $connection;

    // Table
    private $db_table = "users";

    // Columns
    public $id;
    public $pseudo;
    public $email;
    public $hashedPassword;
    public $birthday;
    public $creationDate;
    public $roleId;
    public $guildId;
    public $gameId;
    public $languageId;

    // Db connection

    /**
     * @throws \Exception
     * @var \Classes\Database
     */


    public function __construct(Database $connection, string $pseudo = "", string $email = "", string $creationDate = "", string $hashedPassword = "", string $birthday = "", ?int $guildId = null, ?int $gameId = null, ?int $roleId = null, ?int $languageId = null)
    {
        $this->connection = $connection;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->creationDate = new DateTime($creationDate, new DateTimeZone('Europe/Paris'));
        $this->hashedPassword = $hashedPassword;
        $this->birthday = new DateTime($birthday, new DateTimeZone('Europe/Paris'));
        $this->roleId = $roleId;
        $this->guildId = $guildId;
        $this->gameId = $gameId;
        $this->languageId = $languageId;
    }

    //AUTHENTIFICATION USER

    public function verifyUser()
    {
        // requête SQL paramétrée = requête dynamique (on connait le corps mais pas les valeurs de la requête)

        $sqlQuery = "SELECT
                        id,
                        hashedPassword
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       pseudo = ?  
                    LIMIT 0,1";

        //    pseudo = ? --> lors de l'execution, est replacé par le pseudo de l'utilisateur

        $stmt = $this->connection->prepare($sqlQuery);

        // remplace mes paramètres
        $stmt->bindParam(1, $this->pseudo);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($this->hashedPassword, $dataRow["hashedPassword"])) {

            return $dataRow["id"];
        } else {
            return null ;
        }

    }

    // CREATE
    public function createUser()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET 
                        pseudo = :pseudo, 
                        email = :email, 
                        birthday = :birthday, 
                        hashedPassword = :hashedPassword, 
                        creationDate = :creationDate,
                        roleId = :roleId,
                        guildId = :guildId,
                        gameId =:gameId,
                        languageId = :languageId
                        ";

        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->pseudo = htmlspecialchars(strip_tags($this->pseudo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->roleId = htmlspecialchars(strip_tags($this->roleId));
        $this->guildId = htmlspecialchars(strip_tags($this->guildId));
        $this->gameId = htmlspecialchars(strip_tags($this->gameId));
        $this->languageId = htmlspecialchars(strip_tags($this->languageId));

        $dateBirthday = $this->birthday->format('Y-m-d H:i:s');
        $dateCreationDate = $this->creationDate->format('Y-m-d H:i:s');

        // bind data
        $stmt->bindParam(":pseudo", $this->pseudo);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":birthday", $dateBirthday);
        $stmt->bindParam(":creationDate", $dateCreationDate);
        $stmt->bindParam(":hashedPassword", $this->hashedPassword);
        $stmt->bindParam(":roleId", $this->roleId);
        $stmt->bindParam(":guildId", $this->guildId);
        $stmt->bindParam(":gameId", $this->gameId);
        $stmt->bindParam(":languageId", $this->languageId);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single
    public function getSingleUser($id)
    {
        $sqlQuery = "SELECT
                        id, 
                        pseudo, 
                        email, 
                        birthday, 
                        hashedPassword, 
                        creationDate,
                        roleId,
                        guildId,
                        gameId,
                        languageId
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->connection->prepare($sqlQuery);

        $stmt->bindParam(1, $id);


        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $dataRow['id'];
        $this->pseudo = $dataRow['pseudo'];
        $this->email = $dataRow['email'];
        $this->birthday = $dataRow['birthday'];
        $this->hashedPassword = $dataRow['hashedPassword'];
        $this->creationDate = $dataRow['creationDate'];
        $this->roleId = $dataRow['roleId'];
        $this->guildId = $dataRow['guildId'];
        $this->gameId = $dataRow['gameId'];
        $this->languageId = $dataRow['languageId'];
    }

    // UPDATE
    public function updateUser()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        pseudo = :pseudo, 
                        email = :email, 
                        birthday = :birthday, 
                        hashedPassword = :hashedPassword, 
                        creationDate = :creationDate,
                        roleId = :roleId,
                        guildId = :guildId,
                        gameId =:gameId,
                        languageId =:languageId
                    WHERE 
                        id = :id";

        $stmt = $this->connection->prepare($sqlQuery);

        $this->pseudo = htmlspecialchars(strip_tags($this->pseudo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->roleId = htmlspecialchars(strip_tags($this->roleId));
        $this->guildId = htmlspecialchars(strip_tags($this->guildId));
        $this->gameId = htmlspecialchars(strip_tags($this->gameId));
        $this->languageId = htmlspecialchars(strip_tags($this->languageId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":pseudo", $this->pseudo);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":hashedPassword", $this->hashedPassword);
        $stmt->bindParam(":creationDate", $this->creationDate);
        $stmt->bindParam(":roleId", $this->roleId);
        $stmt->bindParam(":guildId", $this->guildId);
        $stmt->bindParam(":gameId", $this->gameId);
        $stmt->bindParam(":languageId", $this->languageId);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->connection->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
