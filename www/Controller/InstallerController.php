<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;
use App\Model\User as UserModel;
use App\Model\Installer as InstallerModel;

use App\Core\Verificator;


class InstallerController {

    protected $pdo;
    
    public function __construct()
    {
       
    }

    public function initproject(){
        $installer = new InstallerModel();
        
        $view = new View("installer/init");
        $view->assign("installer", $installer);

        if( !empty($_POST)){

            $result = Verificator::checkForm($installer->getInstallerForm(), $_POST);
            if (empty($result)) {
                // print_r($_POST);
                InstallerController::createDatabase($_POST);
            }
        }    
    }

    public static function createDatabase($data){

        $array = [];
        $array[] = $db_name =  htmlspecialchars($data['db_name']);
        $array[] = $db_host =  htmlspecialchars($data['db_host']);
        $array[] = $db_port = $data['db_port']; //Verificator checkIfInt peut-etre?
        $array[] = $db_driver =  'mysql'; 
        $array[] = $db_user =  htmlspecialchars($data['db_user']) ;
        $array[] = $db_password =  htmlspecialchars($data['db_password']) ;
        $array[] = $db_prefix =  htmlspecialchars($data['db_prefix']);

        $hostmail = $data['hostmail'];
        $mailusername =  $data['mailusername'];
        $mailpassword =  $data['mailpassword'];
        $setmail =  $data['setmail'];
        $sitename =  $data['sitename'];


        $db_prefix =  htmlspecialchars($data['db_prefix']);

        $rootuser_db = 'root';
        $rootpwd_db = 'password';

            try{
                //changer le host et le port par les variables du formulaire 
                $pdo = new \PDO("mysql:host=database;port=3306", $rootuser_db, $rootpwd_db);
                echo "insertion de  la table $db_name V<br>";
                $requestsql=  "CREATE DATABASE `$db_name`;";

                $response = $pdo->exec($requestsql);
                if ($response === false) {
                    header("Location: /installer?error=createdatabase");
                    exit();
                }
                // $usersql = "CREATE USER '$db_user'@'%' IDENTIFIED BY '$db_password';
                // GRANT ALL PRIVILEGES ON $db_name.* TO '$db_user'@'%';";  

              $usersql = "CREATE USER '$db_user'@'%' IDENTIFIED WITH mysql_native_password BY '$db_password' ; GRANT USAGE ON *.* TO '$db_user'@'%'; GRANT ALL PRIVILEGES ON `$db_name`.* TO '$db_user'@'%';";

              $responseuser = $pdo->exec($usersql);
              if ($responseuser === false) {
                header("Location: /installer?error=createuser");
                exit();
            }
              echo "insertion user:".$responseuser;
              echo "<br>";


                $pdofortables = new \PDO("mysql:host=database;port=3306;dbname=".$db_name, $rootuser_db, $rootpwd_db);

                $tablesql = "
                
                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8 */;
                /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
                /*!40103 SET TIME_ZONE='+00:00' */;
                /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
                /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
                /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
                /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
                
                DROP TABLE IF EXISTS  `".$db_prefix."category`;
                CREATE TABLE  `".$db_prefix."category` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(50) NOT NULL,
                  `color` varchar(6) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."category` WRITE;
                
                UNLOCK TABLES;
                
                DROP TABLE IF EXISTS  `".$db_prefix."checkout`;
                
                CREATE TABLE  `".$db_prefix."checkout` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_user` int(11) NOT NULL,
                  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  KEY `id_user` (`id_user`),
                  CONSTRAINT  `".$db_prefix."checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES  `".$db_prefix."user` (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."checkout` WRITE;
                
                UNLOCK TABLES;
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."checkout_product`;
                
                CREATE TABLE  `".$db_prefix."checkout_product` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_checkout` int(11) NOT NULL,
                  `id_product` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_checkout` (`id_checkout`),
                  CONSTRAINT  `".$db_prefix."checkout_product_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES  `".$db_prefix."checkout` (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."checkout_product` WRITE;
                
                UNLOCK TABLES;
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."comment`;
                
                CREATE TABLE  `".$db_prefix."comment` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `id_page` int(11) NOT NULL,
                  `id_user` int(11) NOT NULL,
                  `content` mediumtext NOT NULL,
                  `verified` tinyint(4) NOT NULL,
                  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                  `reported` tinyint(4) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `id_page` (`id_page`),
                  KEY `id_user` (`id_user`),
                  CONSTRAINT  `".$db_prefix."comment_ibfk_1` FOREIGN KEY (`id_page`) REFERENCES  `".$db_prefix."page` (`id`),
                  CONSTRAINT  `".$db_prefix."comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES  `".$db_prefix."user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."comment` WRITE;
                
                UNLOCK TABLES;
                
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."page`;
                
                CREATE TABLE  `".$db_prefix."page` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
                  `title` varchar(255) NOT NULL,
                  `content` text NOT NULL,
                  `slug` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."page` WRITE;
                
                UNLOCK TABLES;
                
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."product`;
                
                CREATE TABLE  `".$db_prefix."product` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) NOT NULL,
                  `picture` varchar(255) NOT NULL,
                  `description` varchar(500) NOT NULL,
                  `price` float NOT NULL,
                  `stock` int(11) NOT NULL,
                  `id_category` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."product` WRITE;
                
                UNLOCK TABLES;
                
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."role`;
                
                CREATE TABLE  `".$db_prefix."role` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(20) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
                
                
                LOCK TABLES  `".$db_prefix."role` WRITE;
                INSERT INTO  `".$db_prefix."role` VALUES (1,'user'),(2,'editor'),(3,'admin');
                UNLOCK TABLES;
                
                
                DROP TABLE IF EXISTS  `".$db_prefix."user`;
                
                CREATE TABLE  `".$db_prefix."user` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `email` varchar(320) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `firstname` varchar(50) DEFAULT NULL,
                  `lastname` varchar(100) DEFAULT NULL,
                  `status` tinyint(4) NOT NULL DEFAULT '0',
                  `is_superadmin` tinyint(4) NOT NULL DEFAULT '0',
                  `id_role` int(11) DEFAULT NULL,
                  `token` char(255) DEFAULT NULL,
                  `reset_token` char(255) DEFAULT NULL,
                  `auth_token` char(255) DEFAULT NULL,
                  `reset_token_expiration` timestamp NULL DEFAULT NULL,
                  `token_expiration` timestamp NULL DEFAULT NULL,
                  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `email` (`email`),
                  KEY `id_role` (`id_role`),
                  CONSTRAINT  `".$db_prefix."user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES  `".$db_prefix."role` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                
                LOCK TABLES  `".$db_prefix."user` WRITE;
                
                UNLOCK TABLES;
            ";

            $responsecreatetable = $pdofortables->exec($tablesql);

                if ($responsecreatetable === false) {
                    header("Location: /installer?error=createtables");
                    exit();
                }
            echo "<br>resultat création tables :".$responsecreatetable; 
   
            echo "<br><br><br><br><br><br><br><br><br><br><br>";
            // echo $tablesql;

            $fileContent = '
            <?php
                  define("DBUSER", "'.$db_user.'");
                  define("DBPWD", "'.$db_password.'");
                  define("DBHOST", "'.$db_host.'");
                  define("DBNAME", "'.$db_name.'");
                  define("DBPORT", "'.$db_port.'");
                  define("DBDRIVER", "'.$db_driver.'");
                  define("DBPREFIXE", "'.$db_prefix.'");

                  define("HOSTMAIL", "'.$hostmail.'");
                  define("MAILUSERNAME", "'.$mailusername.'");
                  define("MAILPWD", "'.$mailpassword.'");
                  define("SETMAIL", "'.$setmail.'");
                  define("SITENAME", "'.$sitename.'");

                  ';
            file_put_contents('conf.inc.php',$fileContent);

            }catch (\Exception $e){
                die("Erreur SQL : ".$e->getMessage());
            }

        // $pdo

        
    }

}