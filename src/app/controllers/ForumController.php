<?php
namespace Forum\Controllers;

use Forum\Utilities\Filter;

class ForumController extends \Forum\Libs\Controller 
{
    protected function __construct() 
    {
        parent::__construct();
        $this->loadModel('Forum');
        $this->ID = isset($_GET['topic']) ? Filter::int(explode('_', $_GET['topic'])[0]) : null;
        $this->category = isset($_GET['category']) ? Filter::string(explode('_', $_GET['category'])[0]) : null;
        $this->currentPage = isset($_GET['page']) ? Filter::int($_GET['page']) : 1;
        $this->paginator = new \Forum\Utilities\Paginator($this->currentPage);
        if (!$this->topicExists() && !empty($this->ID) || !$this->categoryExists() && !empty($this->category)) {
            $this->view->render('error/index.php');
            exit;
        } else if ($this->ID === 0) {
            $this->view->render('error/notopic.php');
            exit;
        }
    }

    public function topicExists() 
    {
        return $this->model->topicExists($this->ID, $this->category);
    }

    public function categoryExists() 
    {
        return $this->model->categoryExists($this->category);
    }
}