<?php
namespace Forum\Controllers;

use Forum\Utilities\Session;
use Forum\Utilities\UserUtilities;
use Forum\Utilities\Access;
use Forum\Utilities\Validator;
use Forum\Utilities\Filter;

class UserController extends \Forum\Libs\Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->loadModel('User');
        $this->userName = isset($_GET['name']) ? Filter::string($_GET['name']) : null;
        $this->currentUser = Session::get('logged') ? Session::get('userInfo')['name'] : null;
        $this->utilities = new UserUtilities();
    }

    public function add() 
    {
        Access::unlogged();
        $this->view->title = "Register";
        if (!Validator::emptyArray($_POST)) {
            $login = Filter::string($_POST['login']);
            $password1 = Filter::string($_POST['password1']);
            $password2 = Filter::string($_POST['password2']);
            $error['login'] = !$this->utilities->checkUserName($login) ?
                'This account name is incorrect!' : '';
            $error['password'] = !$this->utilities->checkPassword($password1) ?
                'Your password is incorrect' : '';
            $error['password'] .= $password1 != $password2 ?
                '<br />Typed passwords does not match' : '';
            if ($error['login'] == $error['password']) {
                if ($this->model->add($login, $password1)) {
                    $this->view->msg = "Hello " . $login . "! Your account has been created. <a href=" . HTTP_SERVER . "login>Now you can log in </a>";
                } else {
                    $this->view->msg = "Typed account name is already used";
                }
            } else {
                $this->view->error = $error;
                $this->view->login = $login;
            }
        }
        $this->view->render('user/addUser.php');
    }

    public function login() 
    {
        Access::unlogged();
        $this->view->title = "Log in";
        if (!Validator::emptyArray($_POST)) {
            $login = Filter::string($_POST['login']);
            $password = Filter::string($_POST['password']);
            if ($this->model->login($login, $password)) {
                $this->redirect(HTTP_SERVER);
            } else {
                $this->view->error = "Wrong password or username";
            }
        }
        $this->view->render ('user/login.php');
    }

    public function logout() 
    {
        Session::set('logged', false);
        Session::destroy();
        $this->redirect(HTTP_SERVER);
    }

    public function getUserInfo() 
    {
        Access::logged();
        $this->view->userInfo = $this->model->getUserInfo($this->userName);
        $diff = date_diff(date_create($this->view->userInfo['registration_date']), date_create('now'));
        $years = $diff->y > 1 ? $diff->y . " years" : null;
        $months = $diff->m > 1 ? $diff->m . " months" : null;
        $days = $diff->d > 1 ? $diff->d . " days" : " 1 day";
        $this->view->userInfo['diff'] = "$years $months $days";
        $this->view->title = "user: $this->userName";
        $this->view->render('user/userInfo.php');
    }

    public function userDashboard() 
    {
        Access::logged();
        $this->view->title = 'Dashboard';
        $this->view->render('user/dashboard.php');
    }

    public function changePassword() 
    {
        Access::logged();
        if (!Validator::emptyArray($_POST)) {
            $oldPassword = Filter::string($_POST['old_password']);
            $password1 = Filter::string($_POST['new_password']);
            $password2 = Filter::string($_POST['password_confirmation']);
           
            $error['password'] = password_verify($oldPassword, Session::get('userInfo')['password']) ? '' : 'You entered invalid current password.';
            $error['password'] .= !$this->utilities->checkPassword($password1) ? ' New password is incorrect' : '';
            $error['password'] .= $password1 != $password2 ?
                '<br />Typed passwords does not match' : '';
            if (Validator::emptyArray($error)) {
                if ($this->model->changePassword($password1)) {
                    $this->view->msg = ["Your password has been changed"];
                } else {
                    $this->view->msg = ["An error occurred, try later"];
                }
            } else 
                $this->view->msg = $error;      
        }
        $this->view->render('user/changePassword.php');
    }
}