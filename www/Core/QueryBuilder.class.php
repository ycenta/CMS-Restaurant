<?php

    namespace App\Core;

    class QueryBuilder 
    {
        private $query;

            //Utilisation 
        // $queryBuilder = new QueryBuilder();
        // $sql = $queryBuilder
        // ->select('avenger', ['*'])
        // ->where('dead', '1')
        // ->limit(0, 1)
        // ->getQuery();

        private function reset()
        {
            $this->query = new \stdClass();
        }

        public function insert(string $table, array $columns): QueryBuilder
        {
            $this->reset();

            $this->query->base = "INSERT INTO " . $table . " (" . implode(", ", $columns) . ") VALUES (";

            for ($i = 0; $i < count($columns) ; $i++) { 

                if($i == 0) {
                    $this->query->base .= '?';
                } else {
                    $this->query->base .= ', ?';
                }
                
            }

            $this->query->base .= ')';

            return $this;

        }

        public function select(string $table, array $columns): QueryBuilder
        {
            $this->reset();
            $this->query->base = "SELECT " . implode(", ", $columns) . " FROM " . $table;
            return $this;
        }

        public function where(string $column, string $value, string $operator = "="): QueryBuilder
        {
            $this->query->where[] = $column . $operator . $value;
            return $this;
        }

        public function rightJoin(string $table, string $fk, string $pk): QueryBuilder 
        {
            $this->query->join[] = " RIGHT JOIN " . $table . " ON " . $pk . " = " . $fk;
            return $this;
        }

        public function limit(int $from, int $offset): QueryBuilder
        {
            $this->query->limit = " LIMIT " . $from . ", " . $offset;
            return $this;
        }

        public function getQuery(): string
        {
            $query = $this->query;

            $sql = $query->base;

            if (!empty($query->join)) {
                $sql .= implode(' ', $query->join);
            }

            if (!empty($query->where)) {
                $sql .= " WHERE " . implode(' AND ', $query->where);
            }

            if (isset($query->limit)) {
                $sql .= $query->limit;
            }

            $sql .= ";";

            return $sql;
            
        }
    }




?>