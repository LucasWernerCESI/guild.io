<?php

namespace Classes;

use DateTime;
use PDO;
use Classes\Database;

class User {


    // Connection
    private $conn;

    // Table
    private $db_table = "guild";

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
    public function __construct(Database $connection, string $pseudo, string $email, string $creationDate, string $hashedPassword, string $birthday, int $guildId, int $gameId, int $roleId, int $languageId ) {
        $this->connection = $connection;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->creationDate = new DateTime( $creationDate );
        $this->hashedPassword = $hashedPassword;
        $this->birthday = new DateTime( $birthday );
        $this->roleId = $roleId;
        $this->guildId = $guildId;
        $this->gameId = $gameId;
        $this->languageId = $languageId;
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

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->pseudo = htmlspecialchars(strip_tags($this->pseudo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->hashedPassword = htmlspecialchars(strip_tags($this->hashedPassword));
        $this->roleId = htmlspecialchars(strip_tags($this->roleId));
        $this->guildId = htmlspecialchars(strip_tags($this->guildId));
        $this->gameId = htmlspecialchars(strip_tags($this->gameId));
        $this->languageId = htmlspecialchars(strip_tags($this->languageId));

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

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // READ single
    public function getSingleEmployee()
    {
        $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->age = $dataRow['age'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];
    }

    // UPDATE
    public function updateEmployee()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
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
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
