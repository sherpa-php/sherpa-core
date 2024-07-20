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

    public static function getDatabase(): PDO
    {
        return self::connect($_ENV["DB_DBMS"],
                      $_ENV["DB_HOST"],
                      $_ENV["DB_PORT"],
                      $_ENV["DB_DATABASE"],
                      $_ENV["DB_USER"],
                      $_ENV["DB_PASSWORD"]);
    }

}