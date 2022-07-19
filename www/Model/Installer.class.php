<?php
namespace App\Model;


class Installer 
{

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
                            "value"=> "smtp-mail.outlook.com",
                            "error"=>"Nom incorrect"
                        ],
                        "mailusername"=>[
                            "type"=>"text",
                            "placeholder"=>"Mail username",
                            "class"=>"inputForm",
                            "id"=>"lastnameForm",
                            "min"=>2,
                            "max"=>100,
                            "value"=> "ne.pas.repondre.cms.esgi@outlook.fr",
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
                            "value"=> "ne.pas.repondre.cms.esgi@outlook.fr",
                            "error"=>"Nom incorrect"
                        ]
                    ]
                ];
            }
}