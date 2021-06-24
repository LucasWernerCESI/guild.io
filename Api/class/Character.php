<?php

namespace Classes;

use PDO;

class Character
{

    // Connection
    private $connection;

    // Table
    private $db_table = "characters";

    // Columns
    public $id;
    public $userId ;
    public $raceId ;
    public $level;
    public $professionId ;
    public $classId ;
    public $factionId  ;


    // Db connection

    /**
     * @throws \Exception
     * @var \Classes\Database
     */


    public function __construct(Database $connection, ?int $id = null, ?int $userId = null, ?int $raceId = null, ?int $level = null, ?int $professionId = null, ?int $classId = null, ?int $factionId = null)
    {
        $this->connection = $connection;
        $this->id = $id;
        $this->userId = $userId;
        $this->raceId = $raceId;
        $this->level = $level;
        $this->professionId = $professionId;
        $this->classId = $classId;
        $this->factionId = $factionId;
    }


    // CREATE
    public function createCharacter()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET 
                        userId = :userId,
                        raceId = :raceId, 
                        level = :level, 
                        professionId = :professionId, 
                        classId = :classId,
                        factionId = :factionId
                        ";

        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->raceId = htmlspecialchars(strip_tags($this->raceId));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->professionId = htmlspecialchars(strip_tags($this->professionId));
        $this->classId = htmlspecialchars(strip_tags($this->classId));
        $this->factionId = htmlspecialchars(strip_tags($this->factionId));


        // bind data
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":raceId", $this->raceId);
        $stmt->bindParam(":level", $this->level);
        $stmt->bindParam(":professionId", $this->professionId);
        $stmt->bindParam(":classId", $this->classId);
        $stmt->bindParam(":factionId", $this->factionId);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single
    public function getSingleCharacter()
    {
        $sqlQuery = "SELECT
                        id,
                        userId, 
                        raceId, 
                        level, 
                        professionId, 
                        classId,
                        factionId
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
        $this->raceId = $dataRow['raceId'];
        $this->level = $dataRow['level'];
        $this->professionId = $dataRow['professionId'];
        $this->classId = $dataRow['classId'];
        $this->factionId = $dataRow['factionId'];
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