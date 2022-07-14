<?php

namespace App\Controller;

use App\Core\Slug;
use App\Model\Page;
use App\Core\View;
use App\Core\Verificator;


class PageController {

    public function displayAllPages() {
        $cequetuveux = new Page();
        $pages = $cequetuveux->getAll();
        $view = new View('page/list');
        $view->assign('pages', $pages);
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


        }
        $view = new View("Page/new", "back");
        $view->assign("page", $page);

        
        
    }

    public function readPageBySlug()
    {
        $page = new Page();
        $page = $page->selectBySlug($_GET["slug"]);
        $view = new View("Page/read", "back");
        $view->assign("page", $page);

    }

    public function updatePage()
    {
        $page = new Page();
        $page = $page->selectBySlug();
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

    }
    }

}
?>