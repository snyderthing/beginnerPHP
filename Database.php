<?php

class Database
{
    public $connection;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;port=3306;dbname=laracastsapp;user=root;password=Fl13gen$tein;charset=utf8mb4';
        // PDO = PHP Data Object

        $this->connection = new PDO($dsn);
    }

    public function query($query)
    {


        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
}