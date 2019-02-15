<?php
namespace Forum\Controllers;

use Forum\Utilities\Access;
use Forum\Utilities\Filter;
use Forum\Utilities\Validator;

class PostController extends \Forum\Controllers\ForumController 
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel('Post');
    }

    public function add() 
    {
        Access::logged();
        if (!Validator::emptyArray($_POST) && Validator::length($_POST['body'], 10, 500)) 
        {
            $body = Filter::string(trim($_POST['body']));
            if ($this->model->add($this->ID, $body)) {
                $lastPage = ceil($this->model->getTopicSize($this->ID) / POSTS_PER_PAGE);
                $this->redirect(str_replace("/addPost", '', $_SERVER['REQUEST_URI'] . "?page=$lastPage"));
            } else
                return false;
        }
        $this->view->render('topics/addPost.php');
    }

    public function delete() 
    {
        Access::privileges();
        if (!Validator::emptyArray($_GET)) {
            $result = $this->model->delete(Filter::int($_GET['id']));
            echo json_encode(['result' => $result]);
        }
    }
}