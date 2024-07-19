<?php

namespace Sherpa\Core\database;

use PDO;
use PDOException;

class DB
{

    public static function query(string $query, mixed ...$arguments): Query
    {
        return new Query($query, $arguments);
    }

    public static function connect(
        string $dbms,
        string $host,
        int $port,
        string $db,
        string $user,
        string $password): PDO
    {

        return new PDO("$dbms:host=$host;port=$port;dbname=$db", $user, $password);

    }

}