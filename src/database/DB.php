<?php

namespace Sherpa\Core\database;

use PDO;
use PDOException;

class DB
{
    /**
     * Create a database query and execute it.
     *
     * @param string $query SQL query
     * @param mixed ...$arguments SQL query arguments array
     * @return Query Query object
     */
    public static function query(string $query, mixed ...$arguments): Query
    {
        return new Query($query, $arguments);
    }

    /**
     * Create a PDO object with given credentials.
     *
     * @param string $dbms
     * @param string $host
     * @param int $port
     * @param string $db
     * @param string $user
     * @param string $password
     * @return PDO
     */
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

    /**
     * @return PDO PDO object using current $_ENV database credentials
     */
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