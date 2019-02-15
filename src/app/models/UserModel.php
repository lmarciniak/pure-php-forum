<?php
namespace Forum\Models;

use Forum\Utilities\Session;

class UserModel extends \Forum\Libs\Model 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * @param string $login Username typed in form
     * @param string $password Password typed in form
     * @return bool
     */
    public function add(string $login, string $password): bool 
    {
        $data = ['login' => $login, 'password' => password_hash($password, PASSWORD_DEFAULT), 'today' => date("Y-m-d"), 'role' => 'user'];
        return $this->db->insert('user', $data);
    }

    /**
     * @param string $login Username typed in the login form
     * @param string $password Password typed in the login form
     * @return bool
     */
    public function login(string $login, string $password): bool
    {
        $query = "SELECT * FROM user WHERE name=:login";
        $result = $this->db->select($query, ['login' => $login]);
        if (empty($result)) {
            return false;
        } else {
            if (password_verify($password, $result[0]['password'])) {
                Session::set('logged', true);
                Session::set('userInfo', $result[0]);
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param string $userName Name of user
     * @return array
     */
    public function getUserInfo(string $userName): array 
    {
        $query = "SELECT id, name, registration_date FROM user WHERE name = :name";
        return $this->db->select($query, ['name' => $userName])[0];
    }

    /**
     * @param string $password New password
     * @return bool
     */
    public function changePassword(string $password): bool 
    {
        return $this->db->update("user", "password", password_hash($password, PASSWORD_DEFAULT), 
        "id=" . Session::get('userInfo')['id']);
    }
}