<?php

namespace Classes;

use DateTime;
use DateTimeZone;
use PDO;

class Application
{

    // Connection
    private $connection;

    // Table
    private $db_table = "applications";

    // Columns
    public $id;
    public $userId ;
    public $guildId ;
    public $motivation;
    public $PVP_or_PVE ;
    public $creationDate ;

    // Db connection

    /**
     * @throws \Exception
     * @var \Classes\Database
     */


    public function __construct(Database $connection, ?int $id = null, ?int $userId = null, ?int $guildId = null, string $motivation = "", string $PVP_or_PVE = "", string $creationDate = "")
    {
        $this->connection = $connection;
        $this->id = $id;
        $this->userId = $userId;
        $this->guildId = $guildId;
        $this->motivation = $motivation;
        $this->PVP_or_PVE = $PVP_or_PVE;
        $this->creationDate = new DateTime($creationDate, new DateTimeZone('Europe/Paris'));
    }


    // GET ALL
    public function getAllApplications(){
        $sqlQuery = "SELECT id, userId, guildId, motivation, PVP_or_PVE, creationDate FROM " . $this->db_table ;
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createApplication()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET 
                        userId = :userId,
                        guildId = :guildId, 
                        motivation = :motivation, 
                        PVP_or_PVE = :PVP_or_PVE, 
                        creationDate = :creationDate
                        ";

        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->guildId = htmlspecialchars(strip_tags($this->guildId));
        $this->motivation = htmlspecialchars(strip_tags($this->motivation));
        $this->PVP_or_PVE = htmlspecialchars(strip_tags($this->PVP_or_PVE));

        $dateCreationDate = $this->creationDate->format('Y-m-d H:i:s');

        // bind data
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":guildId", $this->guildId);
        $stmt->bindParam(":motivation", $this->motivation);
        $stmt->bindParam(":PVP_or_PVE", $this->PVP_or_PVE);
        $stmt->bindParam(":creationDate", $dateCreationDate);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single
    public function getSingleApplication()
    {
        $sqlQuery = "SELECT
                        id,
                        userId, 
                        guildId, 
                        motivation, 
                        PVP_or_PVE, 
                        creationDate
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->connection->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $dataRow['id'];
        $this->userId = $dataRow['userId'];
        $this->guildId = $dataRow['guildId'];
        $this->motivation = $dataRow['motivation'];
        $this->PVP_or_PVE = $dataRow['PVP_or_PVE'];
        $this->creationDate = $dataRow['creationDate'];
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
        $this->hashedPassword = htmlspecialchars(strip_tags($this->hashedPassword));
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