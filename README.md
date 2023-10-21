# PHP-Sql-boilerplate

This is a boilerplate for getting started with php mysql project where you can 

Create Database if It not exists 
Create table with preferred columns and types 
 First from root go to src directory and open Database.php 

 Go to run function and see adjust your database credentials as per your configuration
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

//To create a new database which does not exist

Initialize the Database class from any root file like index.php with help of namespaces
use App\Database;
$database=new Database();
$database->createDataBaseIfNotExists(dbname:'anydatabase');
//Create a table if it not exists 
Here at first please read through the Datatypes.php in src directory there are many data types 
class DataTypes
{
    const INTAUTO = "INT AUTO_INCREMENT PRIMARY KEY";

    const  STRING = "VARCHAR(100)";
    const UNIQUE = "UNIQUE";
    const NULLABLE = "NULLABLE";
    const NULLABLEFLOATINT = "DEFAULT 0";
    const NOTNULL = "NOT NULL";
    const STRINGUNIQUENOTNULL = DataTypes::STRING . ' ' . DataTypes::UNIQUE . ' ' . DataTypes::NOTNULL;
    const STRINGNOTNULL = DataTypes::STRING . ' ' . DataTypes::NOTNULL;
    const FLOATNULLABLE = DataTypes::FLOAT . ' ' . DataTypes::NULLABLEFLOATINT;
    const INTNULLABLE = DataTypes::INT . ' ' . DataTypes::NULLABLEFLOATINT;
    const FLOATNOTNULL = DataTypes::FLOAT . ' ' . DataTypes::NOTNULL;
    const INT = "INT";
    const PRIMARYKEY = "PRIMARY KEY";
    const  FLOAT = "FLOAT";
    const TIMESTAMP = "TIMESTAMP";
    const TIMESTAMPNOTNULLABLE = DataTypes::TIMESTAMP . ' ' . DataTypes::NOTNULL;
}

Here you can easily read and see what data types you need 

Go to migrations.php 
<?php


use App\DataTypes;

require_once 'vendor/autoload.php';


$posts = [
    'id' => DataTypes::INTAUTO,
    'title' => DataTypes::STRINGNOTNULL,
    'description' => DataTypes::STRINGNOTNULL

];

here you can store your migrations in arrays 
Then go to migrate.php from there you can run migrations 
<?php

use App\Database;

require_once './vendor/autoload.php';
include './migrations.php';
Database::makeTable(tablename: 'posts', array: $posts);
if you want to upgrade the migrations just go to migrations.php and it will drop the old migrations

just go to CLI and run php migrate.php

If you want to drop any table 
Database::dropTables(tablename: 'posts');

just go to CLI and run php migrate.php



