<?php

namespace Sherpa\Core\database;

class Query
{

    private string $query;
    private array $arguments;

    public function __construct(string $query, array $arguments)
    {
        $this->query = $query;
        $this->arguments = $arguments;
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

}