<?php

namespace App\Controller;

use App\Core\Slug;
use App\Model\Page;
use App\Core\View;
use App\Core\Verificator;
use App\Core\Context;
use App\Core\ConcreteStrategyNew;
use App\Model\Comment as CommentModel;
use App\Model\Log;
use App\Security\UserSecurity;



class PageController {

    public function displayAllPages() {
        $cequetuveux = new Page();

        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = intval(strip_tags(htmlspecialchars($_GET['page'])));
            
            if($currentPage == 0){
                $currentPage = 1;
            }
        }else{
            $currentPage = 1;
        }

        $quantity = intval($cequetuveux->getAmountRows()['quantity']);
        $interval = 5;
        $pages = $cequetuveux->getAllLimit(($currentPage * $interval) - $interval, $interval);

        $view = new View('page/list');
        $view->assign('pages', $pages);
        $view->assign("currentPage", $currentPage);
        $view->assign("pages_amount", ceil($quantity/$interval));
    }

    public function newPage() 
    {   
        $page = new Page();
        
        if( !empty($_POST)){

            $result = Verificator::checkForm($page->getCreationForm(), $_POST);
            if(!empty($result)){
                return ("Error");
            }
            $page->setTitle($_POST["title"]);
            $page->setName($_POST["name"]);
            $page->setContent($_POST["content"]);
            $page->setSlug(Slug::slugify($_POST["title"]));
            
            echo $page->getSlug();
            $page->save();

            $context = new Context(new ConcreteStrategyNew());
            $context->executeStrategy('page', $_SESSION['email'], $page->getName());
        }
        $view = new View("Page/new", "back");
        $view->assign("page", $page);

        
        
    }

    public function readPage()
    {

        $page = new Page();
        $userSecurity = new UserSecurity();
        $page = $page->selectBySlug($_GET["slug"]);
        if($page){
            $comment = new CommentModel();
            $comments = $comment->getAllCommentByPageId($page->getId());

            $view = new View("Page/read", "front");
            $view->assign("page", $page);          
            $view->assign("comment", $comment);
            $view->assign("comments", $comments);
            $view->assign('userSecurity',$userSecurity);

        }else{
            die('error 404');
        }
    

    }

    public function editPage()
    {
        $page = new Page();
        $page = $page->selectBySlug($_GET["slug"]);
        if( !empty($_POST)){

            $result = Verificator::checkForm($page->getEditForm(), $_POST);
            if(!empty($result)){
                return ("Error");
            }
            $page->setTitle($_POST["title"]);
            $page->setName($_POST["name"]);
            $page->setContent($_POST["content"]);
            $page->setSlug(Slug::slugify($_POST["title"]));
            
            $page->save();
            header("Location: /list");
            }
        $view = new View("Page/edit", "back");
        $view->assign("page", $page);
    }
    public function deletePage()
    {
        $page = new Page();
        $page = $page->selectBySlug($_GET["slug"]);
        $page->delete();
        header("Location: /list");
    }

}
?>