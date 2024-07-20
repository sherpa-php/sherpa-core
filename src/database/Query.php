<?php

namespace Sherpa\Core\database;

use PDOStatement;

class Query
{

    private string $query;
    private array $arguments;

    private false|PDOStatement $statement;
    private bool $executeState;

    public function __construct(string $query, array $arguments)
    {
        $this->query = $query;
        $this->arguments = $arguments;

        $this->execute();
    }

    /**
     * @return string Query SQL expression
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return array Query arguments
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return false|PDOStatement Query PDO statement
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * @return int Query execution state
     */
    public function getExecuteState(): int
    {
        return $this->executeState;
    }

    /**
     * Execute current query, store statement and execution state.
     */
    private function execute(): void
    {
        $database = DB::getDatabase();

        $this->statement = $database
            ->prepare($this->getQuery());

        $this->executeState = $this
            ->getStatement()
            ->execute($this->getArguments());
    }

    /**
     * @return mixed `$statement->fetch()` method value.
     */
    public function get(): mixed
    {
        return $this
            ->getStatement()
            ->fetch();
    }

    /**
     * @return array `$statement->fetchAll()` method value.
     */
    public function getAll(): array
    {
        return $this
            ->getStatement()
            ->fetchAll();
    }

}