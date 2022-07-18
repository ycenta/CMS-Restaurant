<?php

namespace App\Controller;

use App\Model\Comment as CommentModel;
use App\Core\View;
use App\Core\Verificator;
use App\Model\Page as PageModel;



class CommentController
{
    public function __construct()
    {
       
    }

    public function comments()
    {
        
        echo "Page crud comment back office";
        $comment = new CommentModel();
        // $comments = $comment->getAllComment();
        $comments = $comment->getAllCommentVerified();

        $commentsUnverified = $comment->getAllCommentUnverified();

        $commentsReported = $comment->getAllCommentReported();
    
        // print_r($comments);
        //Lister les commentaires à valider et ceux non validé, à faire dans la vue?
        $view = new View("Comment/list",'back');
        $view->assign("comments", $comments);
        $view->assign("commentsUnverified",$commentsUnverified);
        $view->assign("commentsReported",$commentsReported);
     
        
    }

 
    public function activateComment()
    {
        echo "page activate comment <br>";
        $comment = new CommentModel();
        if(!empty($_POST)){
            $result = Verificator::checkForm($comment->getActivateCommentForm(), $_POST);
            if(empty($result)){
                echo "formulaire validé <br>";

                if(is_numeric($_POST['comment_id'])){
                    // $roleSecurity = new RoleSecurity();
                    echo "comment to be actived :".$_POST['comment_id'];

                    $comment = $comment->findById($_POST['comment_id']); //On récupère le commentaire par son ID
                    if($comment){

                        if($comment->getVerified() === 1){ //si l'utilisateur est déja verifié
                            header('Location: /comments?fail');
                        }else{
                            $comment->setVerified();
                            $comment->save();
                            header('Location: /comments?sucess');
                        }
                    }                   
                }

            }
        }
    }


    public function removeComment()
    {
        echo "page remove comment<br>";
        $comment = new CommentModel();
        if(!empty($_POST)){
            $result = Verificator::checkForm($comment->getRemoveCommentForm(), $_POST);
            if(empty($result)){
                echo "formulaire validé <br>";

                if(is_numeric($_POST['comment_id'])){
                    echo "comment to be deleted :".$_POST['comment_id'];

                    $comment = $comment->findById($_POST['comment_id']); //On récupère le commentaire par son ID
                    if($comment){
                        //Si l'utilisateur n'est pas un admin, alors on accepte la suppression
                            echo "sera supprimé car utilisateur";
                             if($comment->delete($_POST['comment_id'])){
                                header('Location: /comments?sucess');
                            }else{
                                echo "erreur lors de la suppression";
                                header('Location: /comments?fail');
                            }
                    }                   
                }

            }
        }
    }


    public function addComment()
    {
        $comment = new CommentModel();

        if(!empty($_POST) && !empty($_POST['page_id'])){
           
            if(Verificator::checkIfInt($_POST['page_id'])){

                $page =  new PageModel();
                $page =  $page->findById($_POST['page_id']);

                $result = Verificator::checkForm($comment->getAddCommentForm($_POST['page_id']), $_POST);
                if(!empty($result)){
                    
                    if($page){ 
                        $redirectUrl = $page->getSlug();
                        header('Location: /readpage?slug='.$redirectUrl);
                    }else{
                        header('Location: /');
                    }
                }

                if(!empty($_POST['content'])){

    
                    if($page){   //Verifier si la page existe avant

                        $comment->setIdPage($_POST['page_id']);
                        $comment->setIdUser($_SESSION['auth']);
                        //Rajouter verif si vide    
                        $comment->setContent(Verificator::secureString($_POST['content']));
                        $comment->setVerified(0);
                        $comment->setReported(0);
                        $comment->save();
                        $redirectUrl = $page->getSlug();
                        header('Location: /readpage?slug='.$redirectUrl);
                    }else{
                        header('Location: /');
                        echo "redirige vers /";
                    }

                }else{

                    if($page){
                        $redirectUrl = $page->getSlug();
                        header('Location: /readpage?slug='.$redirectUrl);
                    }else{
                        header('Location: /');
                    }
                }

            }else{ //Si l'id n'est pas un chiffre
                header('Location: /');
            }
    
        }else{
            header('Location: /');
        }

        
    }


    public function reportComment()
    {
        $comment = new CommentModel();

        if(!empty($_POST)){
            $result = Verificator::checkForm($comment->getReportCommentForm(), $_POST);
            if(empty($result)){

                if(Verificator::checkIfInt($_POST['comment_id'])){
                    // $roleSecurity = new RoleSecurity();
                    echo "comment to be reported :".$_POST['comment_id'];

                    $comment = $comment->findById($_POST['comment_id']); //On récupère le commentaire par son ID
                    if($comment){

                        //On récupère la page du commentaire pour rediriger dessus
                        $page =  new PageModel();
                        $page =  $page->findById($comment->getIdPage());

                        if($page){
                            $redirectUrl = $page->getSlug();
                            $redirectUrl = ('Location: /readpage?slug='.$redirectUrl);
                        }else{
                             $redirectUrl = 'Location: /';
                        }

                        if($comment->getReported() === 1){ //si l'utilisateur a déja report
                            //On redirige juste
                            header($redirectUrl.'&?report=fail');
                        }else{
                            $comment->setReported();
                            $comment->save();
                            header($redirectUrl.'&?report=sucess');
                        }
                    }else{
                        header('Location: /');
                    }                   
                }else{
                    header('Location: /');
                }

            }
        }
    }

}