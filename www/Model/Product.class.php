<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Product extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $picture = null;
    protected $description = null;
    protected $price = null;
    protected $stock = null;
    protected $id_category = null;

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
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = trim($picture);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = trim($description);
    }

    /**
     * @return int
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = trim($price);
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = trim($stock);
    }

     /**
     * @return int
     */
    public function getIdCategory(): int
    {
        return $this->id_category;
    }

    /**
     * @param int $id_category
     */
    public function setIdCategory(int $id_category): void
    {
        $this->id_category = $id_category;
    }


    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Créer le produit"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du produit...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                ],
                "picture"=>[
                    "type"=>"file",
                    "placeholder"=>"Image du produit",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pictureForm",
                    "error"=>"Image incorrecte.",
                    ],
                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Description du produit...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"descriptionForm",
                    "max"=>500,
                    "error"=>"Description incorrect.",
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"Prix du produit...",
                    "class"=>"inputForm",
                    "id"=>"priceForm",
                    "min"=>0,
                    "step"=>0.5,
                    "error"=>"Prix incorrect."
                ],
            ]
        ];
    }


    public function getEditProductForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour le produit"
            ],
            'inputs'=>[
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du produit...",
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Nom incorrect",
                    "value" => $this->getName()
                ],
                "picture"=>[
                    "type"=>"file",
                    "placeholder"=>"Image du produit",
                    "class"=>"inputForm",
                    "id"=>"pictureForm",
                    "error"=>"Image incorrecte",
                ],
                "description"=>[
                    "type"=>"textarea",
                    "placeholder"=>"Description du produit...",
                    "class"=>"inputForm",
                    "id"=>"descriptionForm",
                    "max"=>500,
                    "error"=>"Description incorrect.",
                    "value"=>$this->getDescription()
                ],
                "price"=>[
                    "type"=>"number",
                    "placeholder"=>"Prix du produit...",
                    "class"=>"inputForm",
                    "id"=>"priceForm",
                    "min"=>0,
                    "step"=>0.5,
                    "error"=>"Prix incorrect.",
                    "value"=>$this->getPrice()
                ],
                "stock"=>[
                    "type"=>"number",
                    "placeholder"=>"Quantité en stock...",
                    "class"=>"inputForm",
                    "id"=>"stockForm",
                    "min"=>0,
                    "step"=>1,
                    "error"=>"Quantité incorrecte.",
                    "value"=>$this->getStock()
                ],
                "idCategory"=>[
                    "type"=>"number",
                    "placeholder"=>"Catégorie du produit...",
                    "class"=>"inputForm",
                    "id"=>"idCategoryForm",
                    "min"=>0,
                    "step"=>1,
                    "error"=>"Catégorie incorrecte.",
                    "value"=>$this->getIdCategory()
                ]
            ],
            'images'=>[
                "oldPicture"=>[
                    "type"=>"img",
                    "from"=>"Public/img/product/",
                    "input"=>"picture",
                    "class"=>"inputForm",
                    "id"=>"oldPictureForm",
                    "value" => $this->getPicture()
                ],
            ]
        ];
    }

    public function getRemoveProductForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"product-remove",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "product_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setProduct($actual_product=''){

        $this->setName($_POST["name"]) ;
        $this->setDescription($_POST["description"]) ;
        $this->setPrice($_POST["price"]) ;
        isset($_POST["stock"]) ? $this->setStock($_POST["stock"]) : $this->setStock(0);
        isset($_POST["idCategory"]) ? $this->setIdCategory($_POST["idCategory"]) : $this->setIdCategory(1);  

        if(isset($_FILES["picture"]) && $_FILES["picture"]['error'] != 4){
            if(is_uploaded_file($_FILES["picture"]["tmp_name"])){
                $fileName = uniqid("product_", true) . "_" . $_FILES["picture"]["name"];
                $tmp_name = "Public/img/product/" . $fileName;
                move_uploaded_file($_FILES["picture"]["tmp_name"], $tmp_name);

                if (!empty($actual_product)) {
                    if(file_exists("Public/img/product/" . $actual_product->getPicture())){
                        unlink("Public/img/product/" . $actual_product->getPicture());
                    }
                }

                $this->setPicture($fileName);
            }
        }
        return true;

    }

    public function getAllProducts()
    {
        $products = $this->getAll(['id','name','picture','description','price','stock']);

        return $products;
    }
 

}
