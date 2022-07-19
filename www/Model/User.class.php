<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $password;
    protected $status = 0;
    protected $id_role = 1;
    protected $token = null;
    protected $reset_token = null;
    protected $auth_token = null;
    protected $reset_token_expiration = null;
    protected $token_expiration = null;

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
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null|string
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

     /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->id_role;
    }

    /**
     * @param int $id_role
     */
    public function setRoleId(int $id_role): void
    {
        $this->id_role = $id_role;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return null|string
     */
    public function getTokenExpiration(): ?string
    {
        return $this->token_expiration;
    }
    
     /**
     * @return null|string
     */
    public function getAuthToken(): ?string
    {
        return $this->auth_token;
    }

    /**
     * @return null|string
     */
    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    /**
     * length : 255
     */
    public function generateToken(): void
    {
        $this->token = substr(bin2hex(random_bytes(128)), 0, 255);
        $expiration_date = time()+3600;
        $this->token_expiration = date("Y-m-d H:i:s", $expiration_date);
        
    }

    /**
     * length : 255
     */
    public function generateAuthToken(): void
    {
        $this->auth_token = substr(bin2hex(random_bytes(128)), 0, 255);        
    }

    /**
     * length : 255
     */
    public function generateResetToken(): void
    {
        $this->reset_token = substr(bin2hex(random_bytes(128)), 0, 255);   
        $expiration_date = time()+3600;
        $this->reset_token_expiration = date("Y-m-d H:i:s", $expiration_date);     
    }

    public function emptyResetToken(): void
    {
        $this->reset_token = NULL;
        $this->reset_token_expiration = NULL;
    }

    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"S'inscrire"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect",
                    "unicity"=>"true",
                    "errorUnicity"=>"Email déjà en bdd",
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect"
                ],
            ]
        ];
    }

    public function getLoginForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Se connecter"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect"
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm"
                ]
            ]
        ];
    }

    public function getForgetPasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Envoyer un lien pour changer mon mot de passe"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect"
                ]
            ]
        ];
    }


    public function getResetPasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Changer mon mot de passe"
            ],
            'inputs'=>[
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ]
            ]
        ];
    }

    public function getChangePasswordForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Changer mon mot de passe"
            ],
            'inputs'=>[
                "currentPassword"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Nouveau mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ]
            ]
        ];
    }

    public function getProfileForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour son profil"
            ],
            'inputs'=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect",
                    "unicity"=>"true",
                    "errorUnicity"=>"Email déjà en bdd",
                    "value" => $this->getEmail()
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect",
                    "value" => $this->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect",
                    "value" => $this->getLastname()
                ]
            ]
        ];
    }

    public function getEditUserForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "submit"=>"Mettre à jour son profil"
            ],
            'inputs'=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "label"=>'Prenom',
                    "min"=>2,
                    "max"=>50,
                    "error"=>"Prénom incorrect",
                    "value" => $this->getFirstname()
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "label"=>"Nom",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Nom incorrect",
                    "value" => $this->getLastname()
                ],
                "role"=>[
                    "type"=>"radio",
                    "class"=>"inputForm",
                    "id"=>"roleForm",
                    "label"=>"Role",
                    "error"=>"Role incorrect",
                    "radiolist"=> ['user' => 1 ,'editor'=> 2,'admin' => 3],
                    "radioChecked"=>$this->getRoleId()
                ]
            ]
        ];
    }

    public function getRemoveUserForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"user-remove",
                "buttonClass" =>"button button--white",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "user_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function setUser(){

        $this->setFirstname($_POST["firstname"]) ;
        $this->setLastname($_POST["lastname"]) ;
        $this->setEmail($_POST["email"]) ;
        $this->setPassword($_POST["password"]) ;
        $this->setStatus(0);
        $this->setRoleId(1);
        $this->generateToken() ;
        

        if (password_verify($_POST["passwordConfirm"] , $this->password)) {
            return true;
        }
        else {
            echo "mots de passe differents";
            return false;
        }

    }

    public function findById(string $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function getInstallerForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "buttonClass" =>"",
                "submit"=>"Initialisation du projet"
            ],
            'inputs'=>[
                "db_name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom base de donnée",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "mvcdocker2",
                    "error"=>"error db_user"
                ],
                "db_host"=>[
                    "type"=>"text",
                    "placeholder"=>"db host",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "database",
                    "error"=>"Nom d'utilisateur base de donnée"
                ],
                "db_port"=>[
                    "type"=>"text",
                    "placeholder"=>"db port",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "3306",
                    "error"=>"Nom d'utilisateur base de donnée"
                ],
                "db_driver"=>[
                    "type"=>"text",
                    "placeholder"=>"db driver",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "mysql",
                    "error"=>"driver base de donnée"
                ],
                "db_user"=>[
                    "type"=>"text",
                    "placeholder"=>"Utilisateur base de donnée",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "yohan",
                    "error"=>"error db_user"
                ],
                "db_password"=>[
                    "type"=>"password",
                    "placeholder"=>"Password base de donnée",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "password",
                    "error"=>"error db_password"
                ],
                "db_prefix"=>[
                    "type"=>"text",
                    "placeholder"=>"Prefix des tables",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "projet_",
                    "error"=>"error db_user"
                ],
                "sitename"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du site",
                    "class"=>"inputForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "ecommerce",
                    "error"=>"error db_user"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"emailForm",
                    "error"=>"Email incorrect",
                    "unicity"=>"true",
                    "value"=> "yohan@centa.fr",
                    "errorUnicity"=>"Email déjà en bdd",
                ],
                "password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdForm",
                    "value"=> "yohan1",
                    "error"=>"Votre mot de passe doit faire au min 8 caractères avec majuscule, minuscules et des chiffres",
                    ],
                "passwordConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"pwdConfirmForm",
                    "value"=> "yohan1",
                    "confirm"=>"password",
                    "error"=>"Votre mot de passe de confirmation ne correspond pas",
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom ...",
                    "class"=>"inputForm",
                    "id"=>"firstnameForm",
                    "min"=>2,
                    "max"=>50,
                    "value"=> "yohan",
                    "error"=>"Prénom incorrect"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom ...",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "value"=> "centa",
                    "error"=>"Nom incorrect"
                ],
                "hostmail"=>[
                    "type"=>"text",
                    "placeholder"=>"Hostmail",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "value"=> "hostmail",
                    "error"=>"Nom incorrect"
                ],
                "mailusername"=>[
                    "type"=>"text",
                    "placeholder"=>"Mail username",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "value"=> "mailusername",
                    "error"=>"Nom incorrect"
                ],
                "mailpassword"=>[
                    "type"=>"password",
                    "placeholder"=>"Mail password",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "value"=> "mailpassword",
                    "error"=>"Nom incorrect"
                ],
                "setmail"=>[
                    "type"=>"text",
                    "placeholder"=>"Adresse mail site",
                    "class"=>"inputForm",
                    "id"=>"lastnameForm",
                    "min"=>2,
                    "max"=>100,
                    "value"=> "adressemaildusite",
                    "error"=>"Nom incorrect"
                ]
            ]
        ];
    }
 

}
