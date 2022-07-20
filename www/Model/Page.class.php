<?php
namespace App\Model;


use App\Core\Sql;

class Page extends Sql
{
    protected $id;
    protected $name;
    protected $title;
    protected $content = null;
    protected $slug;

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
    
    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = trim($name);
    }

    /**
     * @return null|string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    /**
     * @param string $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
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

    public function getAllPages()
    {
        $sql = "SELECT * FROM ".DBPREFIXE."page";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $pages = $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $pages;
    }
    public function selectBySlug($slug)
    { 
            $sql = "SELECT * FROM ".DBPREFIXE."page WHERE slug = :slug";
            $query = $this->pdo->prepare($sql);
            $query->execute(['slug' => $slug]);
            $page = $query->fetchObject(get_called_class());
            return $page;
    }
    public function deleteBySlug()
    {
         $sql = "DELETE FROM esgi_page WHERE slug = :slug";
         $queryPrepared = $this->pdo->prepare($sql);
        $passed = $queryPrepared->execute( ['slug' => $this->slug] );
        return $passed; 
    }
    
    public function findById(int $id)
    {
       $result = $this->findByCustom("id",$id);
      
        return $result;
    }

    public function getCreationForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "create"=>"Crée une page"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"nom de la page ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                ],
                "title"=>[
                    "type"=>"title",
                    "placeholder"=>"titre : ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"titleForm",
                    "error"=>"Votre titre est bizarre",
                    ],
                "content"=>[
                    "type"=>"text",
                    "placeholder"=>"Contenu ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"contentForm",
                    "error"=>"Ton contenue est bizarre",
                ],
            ]
        ];
    }

    public function getEditForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "create"=>"Edit une page"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"nom de la page ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "value"=>$this->getName(),
                    "error"=>"Nom incorrect",
                ],
                "title"=>[
                    "type"=>"title",
                    "placeholder"=>"titre : ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"titleForm",
                    "value" => $this->getTitle(),
                    "error"=>"Votre titre est bizarre",
                    ],
                "content"=>[
                    "type"=>"text",
                    "placeholder"=>"Contenu ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"contentForm",
                    "value" => $this->getContent(),
                    "error"=>"Ton contenue est bizarre",
                ],
            ]
        ];
    }
 

}