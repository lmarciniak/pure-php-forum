<?php
namespace Forum\Controllers;

class CategoryController extends \Forum\Controllers\ForumController 
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel('Category');
    }
    
    public function getCategoryList() 
    {
        $this->view->categories = $this->model->getCategoryList();
        $this->view->title = 'Homepage';
        $this->view->render('categories/categoryList.php');
    }

    public function getTopicList() 
    {
        $this->paginator->setLimit(TOPICS_PER_PAGE);
        $this->paginator->setAmount($this->model->getCategorySize($this->category));
        $this->view->pagination = $this->paginator->getItems();
        $this->view->topics = $this->model->getTopicList($this->category, $this->currentPage, $this->paginator->getLimit());
        $this->view->title = ucFirst($this->category);
        $this->view->render('categories/topicList.php');
    }
}