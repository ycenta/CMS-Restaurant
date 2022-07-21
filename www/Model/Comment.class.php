<?php
namespace App\Model;

use App\Core\Sql;
use App\Core\QueryBuilder;

class Comment extends Sql
{
    protected $id = null;
    protected $id_page;
    protected $id_user;
    protected $content = null;
    protected $verified;
    protected $createdAt;
    protected $updatedAt;
    protected $reported;
    protected $suscribedAdmins = [];

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
     * @return null|int
     */
    public function getIdPage(): ?int
    {
        return $this->id_page;
    }

    /**
    *
    */
    public function setIdPage($id_page): void
    {
        $this->id_page = $id_page;
    }

    /**
    *
    */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
    *
    */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return null|int
     */
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    /**
     * @return null|int
     */
    public function getVerified(): ?int
    {
        return $this->verified;
    }

    /**
     * @return null|int
     */
    public function getReported(): ?int
    {
        return $this->reported;
    }

    /**
     *
     */
    public function setVerified($verified = 1): void
    {
        $this->verified = $verified;
    }

    /**
     *
     */
    public function setReported($reported = 1): void
    {
        $this->reported = $reported;
    }


    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getAllComment()
    {
        $comments = $this->getAll(['id','id_page','id_user','content','verified','reported']);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $comments;
    }

    public function getAllCommentByPageId($id)
    {
        $comments = $this->getAllWhere(['id','id_page','id_user','content','verified','reported'],['id_page',$id]);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $comments;
    }

    public function getAllCommentUnverified()
    {
        $comments = $this->getAllWhere(['id','id_page','id_user','content','verified','reported'],['verified',0]);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $comments;
    }

    public function getAllCommentVerified()
    {
        $comments = $this->getAllWhere(['id','id_page','id_user','content','verified','reported'],['verified',1]);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $comments;
    }

    public function getAllCommentReported()
    {
        $comments = $this->getAllWhere(['id','id_page','id_user','content','verified','reported'],['reported',1]);
        // $allUsers = [];
        // foreach($users as $user){
        //     $allUsers[$user->getId()] = $user->getFirstname().' - '.$user->getLastname().' - '.$user->getEmail();
        // }
        return $comments;
    }

    public function getRemoveCommentForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"comment-remove",
                "submit"=>"Supprimer"
            ],
            'inputs'=>[
                "comment_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function getActivateCommentForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"comment-activate",
                "submit"=>"Valider"
            ],
            'inputs'=>[
                "comment_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }

    public function getReportCommentForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"comment-report",
                "submit"=>"Signaler"
            ],
            'inputs'=>[
                "comment_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $this->getId()
                ]
            ]
        ];
    }



    public function getAddCommentForm($pageId): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"comment-add",
                "submit"=>"Envoyer"
            ],
            'inputs'=>[
                "page_id"=>[
                    "type"=>"hidden",
                    "required"=>true,
                    "value" => $pageId

                ],
                "content"=>[
                    "type"=>"text",
                    "placeholder"=>"Ajouter un commentaire ...",
                    "required"=>true,
                    "class"=>"inputForm",
                    "id"=>"nameForm",
                    "error"=>"Commentaire invalide",
                ]
            ]
        ];
    }

    public function findById(string $id)
    {
       $result = $this->findByCustom("id",$id);
      
      return $result;
    }

    public function subscribe(UserModel $user)
    {
        $this->suscribedAdmins[ $user->getId() ] = $user;
    }

    public function notify()
    {
        foreach ($this->suscribedAdmins as $user){
            $user->update($this);
        }
    }

}