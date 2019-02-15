<?php
namespace Forum\Controllers;

use Forum\Utilities\Access;
use Forum\Utilities\Filter;
use Forum\Utilities\Validator;

class TopicController extends \Forum\Controllers\ForumController 
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel('Topic');
    }

    public function addTopic() 
    {
        Access::logged();
        $this->view->title = 'Create new topic';
        $this->view->category = $this->category;
        if (!Validator::emptyArray($_POST)) {
            $error = Validator::length($_POST['topic_name'], 6, 60) ? null : "Topic name has to consist at least 6 characters, at most 60 characters.";
            $error .= Validator::length($_POST['body'], 20, 500) ? null : " The message has to consist at least 20 characters, at most 500 characters.";
            if ($error == null) {
                $topicName = Filter::string(str_replace(" ", "_", trim($_POST['topic_name'])));
                $body = Filter::string($_POST['body']);
                $insertedID = $this->model->addTopic($topicName, $body, $this->category);
                if ($insertedID) {
                    $url = HTTP_SERVER . "forum/$this->category/$insertedID" . "_" . "$topicName";
                    $this->redirect($url);
                } else {
                    $this->view->msg = "An error occurred during creating the topic!";
                }
            } else {
                $this->view->msg = $error;
            }
        }
        $this->view->render('topics/addTopic.php');
    }

    public function getTopic() 
    {
        $this->paginator->setLimit(POSTS_PER_PAGE);
        $this->paginator->setAmount($this->model->getTopicSize($this->ID));
        $this->view->pagination = $this->paginator->getItems();
        $this->view->category = $this->category;
        $this->view->topicInfo = $this->model->getTopicInfo($this->ID, $this->category);
        $this->view->title = str_replace('_', ' ', $this->view->topicInfo['name']);
        $this->view->topicInfo = $this->currentPage == 1 ? $this->view->topicInfo : null;
        $this->view->posts = $this->model->getPostList($this->ID, $this->category, $this->currentPage, $this->paginator->getLimit());
        $this->view->js = ['deletePost.js'];
        $this->view->render('topics/getTopic.php');
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