<?php

namespace App\Core;


class Verificator
{

    public static function checkForm($config, $data, $files=""): array
    {
        $result = [];
        //Le nb de inputs envoyés ?
        if( count($data) != count($config['inputs'])){
            die("Tentative de hack !!!!");
        }

        foreach ($config['inputs'] as $name=>$input){
            
            if($input["type"] == "file"){
                if(!empty($files) && $files[$name]["error"] != 4){
                    if (!self::checkFile($files, $name)) {
                        $result[] = "Le fichier ".$name." doit être au format JPEG, JPG ou PNG.";
                    }

                    if ($files[$name]["size"] > 2097152) {
                        $result[] = "La taille du fichier ". $name . " ne doit pas dépasser 2 Mo";  
                    }
                } 

                if (empty($files) && !empty($input["required"])) {
                    $result[] = "Le champs ".$name." n'existe pas";
                }
            } else {        
                if(!isset($data[$name]) ){
                    $result[] = "Le champs ".$name." n'existe pas";
                }
       

                if(empty($data[$name]) && !empty($input["required"]) ){
                    $result[] = "Le champs ".$name." ne peut pas être vide";
                }

                if($input["type"] == "email" && !self::checkEmail($data[$name]) ){
                    $result[] = $input["error"];
                }

                if($input["type"] == "color" && !self::checkHexaColor($data[$name])){
                    $result[] = $input["error"];
                }

                if(isset($input["confirm"])){
                    if($input["type"] == "password" && empty($input["confirm"]) && !self::checkPassword($data[$name]) ){
                        $result[] = $input["error"];
                    }
                }
               

                if(!empty($input["confirm"]) && $data[$name] != $data[$input["confirm"]]){
                    $result[] = $input["error"];
                }

               // if($input["type"] == "string" && empty($input["confirm"]) && !self::checkPassword($data[$name]) ){
            //    $result[] = $input["error"];
               // }
            }


//pas sur de ça
            //if(!empty($input["email"]) == $data[$name]){
                //$result[] = $input["error"];
            //}

          
    
        }


        return $result;

    }

    public static function checkEmail($email): bool
    {
       return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function checkPassword($password): bool
    {

        return strlen($password)>=8
            && preg_match("/[0-9]/", $password, $match)
            && preg_match("/[a-z]/", $password, $match)
            && preg_match("/[A-Z]/", $password, $match)
            ;
    }

    public static function checkFile($file, $name): bool
    {

        return mime_content_type($file[$name]["tmp_name"]) == "image/jpeg"
            || mime_content_type($file[$name]["tmp_name"]) == "image/png";
    }

    public static function checkHexaColor($color): bool
    {

        return (count(explode("#", $color)) == 1
            || count(explode("#", $color)) == 2)
            &&(strlen(str_replace("#", "", $color)) == 6
            || strlen(str_replace("#", "", $color)) == 3)
            && (preg_match("/([a-fA-F0-9]){6}/", $color, $match)
            || preg_match("/([a-fA-F0-9]){3}/", $color, $match));
    }

    public static function checkHiddenFieldInt($hidden): bool
    {
        //
    }




}
