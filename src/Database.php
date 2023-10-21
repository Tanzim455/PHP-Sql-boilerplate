<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

class Database
{
    public $server = "localhost";
    public $username = "root";
    private $password = "";
    public $conn = "";

    public function checkDatabaseExists(string $dbname): bool
    {
        try {
            $pdo = new PDO("mysql:host=localhost", "root", "");

            $stmt = $pdo->prepare("SHOW DATABASES LIKE '$dbname'");
            //var_dump($stmt);
            $stmt->execute(); // Execute the query
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (is_array($result)) {
                return true;
            }
            if (!is_array($result)) {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function createDataBaseIfNotExists(string $dbname): void
    {
        $result = $this->checkDatabaseExists($dbname);
        if (!$result) {
            $pdo = new PDO("mysql:host", "root", "");
            $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS $dbname");

            $stmt->execute();
            echo "Database have been created successfully";
        }
        if ($result) {
            echo "The database already exists";
        }
    }

    public  function run()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=crudpractice", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function searchTables($searchTerm): bool
    {
        $sql = "SHOW TABLES LIKE :searchTerm";

        $pdo = $this->run();
        $stmt = $pdo->prepare($sql);

        // Bind the search term using a named parameter
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

        $stmt->execute();

        // Fetch the results
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($results)) {
            return true;
        }
        return false;
    }


    public static function dropTables(string $tablename): void
    {
        $db = new self();


        $searchTableExists = $db->searchTables(searchTerm: $tablename);
        if (!$searchTableExists) {
            echo "There is no such table here";
        }
        if ($searchTableExists) {
            $pdo = $db->run();
            $dropTable = "DROP TABLE $tablename";
            $pdo->exec($dropTable);
            echo "Your table has been successully deleted";
        }
    }

    public static function makeTable(string $tablename, array $array): void
    {

        //Find out array key of all users
        $user_array_keys = array_keys($array);
        //get count of all arrays 
        $count = count($user_array_keys);
        $last_user_array_key = $user_array_keys[$count - 1];
        $concatenatedStrings = '';
        foreach ($array as $key => $value) {
            if ($key == $last_user_array_key) {
                $concatenatedStrings .= "$key $value" . PHP_EOL;
            }
            if ($key !== $last_user_array_key) {
                $concatenatedStrings .= "$key $value," . PHP_EOL;
            }
        }
        // echo $concatenatedStrings;
        $table = "CREATE TABLE $tablename($concatenatedStrings);";
        // var_dump($table);

        $db = new self();
        $pdo = $db->run();
        $checkTableExists = $db->searchTables(searchTerm: $tablename);

        if (!$checkTableExists) {
            // $pdo->exec($table);
            $pdo->exec($table);
            echo "Table has been succesfully added to database";
        }
        if ($checkTableExists) {
            echo "The table already exists";
        }
    }
}
