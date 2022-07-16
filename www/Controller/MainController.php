<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Auth;
use App\Model\Comment as CommentModel;
use App\Model\Page as PageModel;


class MainController {

    public function __construct()
    {
       
    }

    public function home()
    {
        echo "Page d'accueil";
        if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])){
            echo "<br>";
            echo "Bienvenue ".$_SESSION['email'];
            echo "<br>";
            echo " Role actuel : ".$_SESSION['role'];
            echo "<br>";
            echo "<a href='/shoppingCart'><button>Panier</button></a>";
        }
    }


    public function contact()
    {
        $view = new View("contact");
    }

    public function samplepage()
    {
        //C'est une route de test
        $comment = new CommentModel();
        // $page = new PageModel();
        // $page->setId(1);
        $page = new \stdClass();
        $page->id = 1;

        //je simule le fait que ça soit la page avec l'id 2
        $comments = $comment->getAllCommentByPageId($page->id);
        $view = new View("sample");

        $view->assign("comment", $comment);
        $view->assign("page", $page);
        $view->assign("comments", $comments);

    }

}