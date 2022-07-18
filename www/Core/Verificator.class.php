<?php

namespace App\Core;


class Verificator
{

    public static function checkForm($config, $data, $files=""): array
    {
        $result = [];
        //Le nb de inputs envoyés ?

        if (!empty($_POST['csrf'])) {
            if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
                  //
            } else {
                die("Tentative de hack CSRF  (pas le même csrf)!!!!");
            }
        }else{
            die("Tentative de hack CSRF  (pas de csrf) !!!!");
        }

        if( count($data) != count($config['inputs'])+1){
            exit("Tentative de hack !!!!");
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

                if(in_array($input["type"], ["number", "radio", "select"]) && !self::checkNumber($data[$name])){
                    $result[] = $input["error"];
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

    public static function checkNumber($value): bool
    {
        return preg_match("/(\d)+/", $value, $match);
    }

    public static function checkHiddenFieldInt($hidden): bool
    {
        //
    }

    public static function secureString($string)
    {
            //htmlspecialchars && addslashes
            $string = htmlspecialchars($string);
            return addslashes($string);
    }
    
    public static function checkIfInt($int)
    {
        // is numeric && is int
        if(is_numeric($int) && !empty($int)){
            preg_match('/[0-9]*/', $int, $output_array);
            return $output_array[0];
        }else{
            return false;
        }

    }

    public static function checkIfOnlyLetters($name): bool
    {

        return preg_match("/^([a-zA-Z]+)$/", $name, $match);
        
    }

}
