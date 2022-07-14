<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Category extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $color = null;

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
        $this->name = ucwords(strtolower(trim($name)));
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(?string $color): void
    {
        $this->color = trim($color);
    }

    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Créer la catégorie"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de la catégorie...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                ],
                "color"=>[
                    "type"=>"color",
                    "placeholder"=>"Couleur de la catégorie",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"colorForm",
                    "error"=>"La couleur doit être une valeur hexadécimale (3 ou 6 caractères, préfixés ou non du \"#\".",
                ],
            ]
        ];
    }


    public function getEditCategoryForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour la catégorie"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de la catégorie...",
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                    "value" => $this->getName()
                ],
                "color"=>[
                    "type"=>"color",
                    "placeholder"=>"Couleur de la catégorie...",
                    "class"=>"inputForm",
                    "id"=>"colorForm",
                    "error"=>"La couleur doit être une valeur hexadécimale (3 ou 6 caractères, préfixés ou non du \"#\".",
                    "value"=>"#" . $this->getColor()
                ],
            ]
        ];
    }

    public function getRemoveCategoryForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"category-remove",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "category_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setCategory(){

        $this->setName($_POST["name"]) ;
        $this->setColor(str_replace("#", "", $_POST["color"]));

        return true;

    }

    public function getAllCategories()
    {
        $categories = $this->getAll(['id','name','color']);

        return $categories;
    }

    public function getCategoriesInArray()
    {
        $categories = $this->getAll(['id','name']);

        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList += [$category->getName()=>$category->getId()];
        }

        return $categoriesList;
    }
 

}
