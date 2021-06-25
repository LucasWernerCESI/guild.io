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
    public $name;
    public $userId ;
    public $raceId ;
    public $race;
    public $level;
    public $professionId ;
    public $profession;
    public $classId ;
    public $class;
    public $factionId  ;
    public $faction;

    // Db connection

    /**
     * @throws \Exception
     * @var \Classes\Database
     */


    public function __construct(Database $connection, ?string $name = null, ?int $id = null, ?int $userId = null, ?int $raceId = null, ?int $level = null, ?int $professionId = null, ?int $classId = null, ?int $factionId = null)
    {
        $this->connection = $connection;
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
        $this->raceId = $raceId;
        $this->level = $level;
        $this->professionId = $professionId;
        $this->classId = $classId;
        $this->factionId = $factionId;
    }


    // GET ALL
    public function getAllCharacters( $guildId ){
        $sqlQuery = "SELECT id, name, userId, raceId, level, professionId, classId, factionId FROM " . $this->db_table . " WHERE guildId = :guildId";
        $stmt = $this->connection->prepare($sqlQuery);
        // bind data
        $stmt->bindParam(":guildId", $guildId);

        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createCharacter()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET 
                        userId = :userId,
                        raceId = :raceId, 
                        name = :name,
                        level = :level, 
                        professionId = :professionId, 
                        classId = :classId,
                        factionId = :factionId
                        ";

        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->raceId = htmlspecialchars(strip_tags($this->raceId));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->professionId = htmlspecialchars(strip_tags($this->professionId));
        $this->classId = htmlspecialchars(strip_tags($this->classId));
        $this->factionId = htmlspecialchars(strip_tags($this->factionId));


        // bind data
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":name", $this->name);
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
                        characters.id as id,
                        characters.name as name,
                        races.name as race, 
                        characters.level as lvl, 
                        professions.name as profession, 
                        classes.name as class,
                        factions.name as faction
                      FROM
                        " . $this->db_table . "
                        JOIN races
                            ON characters.raceId = races.id
                        JOIN professions
                            ON characters.professionId = professions.id
                        JOIN classes
                            ON characters.classId = classes.id
                        JOIN factions
                            ON characters.factionId = factions.id
                    WHERE 
                       characters.userId = ?
                    LIMIT 0,1";

        $stmt = $this->connection->prepare($sqlQuery);

        $stmt->bindParam(1, $this->userId);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $dataRow['id'];
        $this->name = $dataRow['name'];
        $this->race = $dataRow['race'];
        $this->level = $dataRow['lvl'];
        $this->profession = $dataRow['profession'];
        $this->class = $dataRow['class'];
        $this->faction = $dataRow['faction'];

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