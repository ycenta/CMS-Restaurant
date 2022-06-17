<?php

namespace App\Controller;

use App\Model\Page;
use App\Core\View;

class PageController {

    public function newPage()
    {
        $page = new Page();
        $view = new View("Page/new", "back");
        
    }
    

}

?>