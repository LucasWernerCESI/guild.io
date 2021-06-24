<?php

namespace Classes;

use DateTime;
use DateTimeZone;
use PDO;

class Guild
{

    // Connection
    private $connection;

    // Table
    private $db_table = "guilds";

    // Columns
    public $id;
    public $gameId;
    public $name;
    public $text;
    public $blazon;
    public $creationDate;


    // Db connection

    /**
     * @throws \Exception
     * @var \Classes\Database
     */


    public function __construct(Database $connection, ?int $id = null, string $name = "", string $text = "", string $blazon = "", string $creationDate = "", ?int $gameId = null)
    {
        $this->connection = $connection;
        $this->id = $id;
        $this->gameId = $gameId;
        $this->name = $name;
        $this->text = $text;
        $this->blazon = $blazon;
        $this->creationDate = new DateTime($creationDate, new DateTimeZone('Europe/Paris'));
    }


    // GET ALL
    public function getAllGuilds(){
        $sqlQuery = "SELECT id, gameId, name, text, blazon, creationDate FROM " . $this->db_table ;
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createGuild()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET 
                        gameId = :gameId,
                        name = :name, 
                        text = :text, 
                        blazon = :blazon, 
                        creationDate = :creationDate
                        ";

        $stmt = $this->connection->prepare($sqlQuery);

        // sanitize
        $this->gameId = htmlspecialchars(strip_tags($this->gameId));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->blazon = htmlspecialchars(strip_tags($this->blazon));

        $dateCreationDate = $this->creationDate->format('Y-m-d H:i:s');

        // bind data
        $stmt->bindParam(":gameId", $this->gameId);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":text", $this->text);
        $stmt->bindParam(":blazon", $this->blazon);
        $stmt->bindParam(":creationDate", $dateCreationDate);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single
    public function getSingleGuild()
    {
        $sqlQuery = "SELECT
                        id,
                        gameId, 
                        name, 
                        text, 
                        blazon, 
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
        $this->gameId = $dataRow['gameId'];
        $this->name = $dataRow['name'];
        $this->text = $dataRow['text'];
        $this->blazon = $dataRow['blazon'];
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