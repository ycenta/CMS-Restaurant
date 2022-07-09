<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Role extends Sql
{
    protected $id = null;
    protected $name = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

}