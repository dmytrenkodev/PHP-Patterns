<?php

// Separate the construction of a complex object from its representation, allowing step-by-step creation.
//
// Use when:
// Object creation is complex and requires multiple steps.
// + Produces readable and maintainable code (fluent).
// - Adds extra classes when not needed.

class Query
{
    public string $select = '*';
    public string $from;
    public array $where = [];
}

class QueryBuilder
{
    private Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function select(string $fields): self
    {
        $this->query->select = $fields;
        return $this;
    }

    public function from(string $table): self
    {
        $this->query->from = $table;
        return $this;
    }

    public function where(string $condition): self
    {
        $this->query->where[] = $condition;
        return $this;
    }

    public function getQuery(): Query
    {
        return $this->query;
    }
}

$query = (new QueryBuilder())
    ->select('id, name')
    ->from('users')
    ->where('id = 1')
    ->getQuery();
