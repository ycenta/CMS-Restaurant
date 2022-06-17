<?php
namespace App\Model;

use App\Core\Sql;

class Page extends Sql
{
    protected $id = ;
    protected $name = ;
    protected $title = ;
    protected $content = null ;

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
    public function getname(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setname(?string $name): void
    {
        $this->name = trim($name);
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string
     */
    public function setTitle(?string $title): void
    {
        $this->title = trim($title);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = strtolower(trim($content));
    }

}