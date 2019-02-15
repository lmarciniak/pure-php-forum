<?php
namespace Forum\Libs;

use Forum\Utilities\Session;

class Controller 
{
    protected function __construct() 
    {
        $this->view = new View;
        $this->view->userName = Session::get('logged') ? Session::get('userInfo')['name'] : null;
    }

    /**
     * @param string $name Name of the model
     * @return bool
     */
    public function loadModel(string $name): bool
    {
        $file = DIR_MODELS . $name . 'Model.php';
        if (file_exists($file)) {
            require_once $file;
            $modelName = '\Forum\models\\' . $name . 'Model';
            $this->model = new $modelName();
            return true;
        } else {
            echo "Model cannot be loaded";
            exit;
        }
    }

    /**
     * @param string $url Destination
     */
    public function redirect(string $url) 
    {
        header("location: $url");
    }
}