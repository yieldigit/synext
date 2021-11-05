<?php
namespace Synext\Controllers;

use Synext\Components\Databases\Database;
use Valitron\Validator;
use Synext\Models\Users;
use Synext\Sessions\Session;
use Synext\Requests\Redirect;
use Synext\Components\Htmls\Form;
use Synext\Components\Auths\Login;
use Synext\Components\Auths\Register;
use PDO;


class User{
    private $db;
    private $table = 'users';
    public function __construct()
    {
        $this->db = new Database();
    }

    private function is_alredy_login($router)
    {
        Session::check();
        if (Session::checkSessionVariable('Auth')) {
            return Redirect::to($router->url('Admin#Home'));
        }
    }
    public function is_login($router){
        Session::check();
        if(!Session::checkSessionVariable('Auth')){
            return Redirect::to($router->url('Admin#Login'));
        }
    }
    public function login($router, array $post)
    {
        $data = [];
        $errors = [];
        $errors_login = false;
        $message = '';
        $this->is_alredy_login($router);
        if (!empty($post)) {
            $validate = new Validator($post);
            $validate->rule('required', 'email')
                ->rule('required', 'password')
                ->rule('email', 'email');
            if ($validate->validate()) {
                $email = htmlspecialchars($post['email']);
                $password = htmlspecialchars($post['password']);
                $DB = (new Login($this->db));
                $user = $DB->checkUser($email);
                if ($user === false) {
                    $errors_login = true;
                    $message .= 'Login error';
                } else {
                    if (!is_null($user->getToken())) {
                        $errors_login = true;
                        $message .= 'Please confirm your account !';
                    } elseif (is_null($user->getPassword())) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $this->db->update("UPDATE users SET password=:password WHERE id=:id", ['password' => $password, 'id' => $user->getId()]);
                        $DB->connectUser($user->getId(), $router->url('Admin#Home'));
                    } else {
                        if (!password_verify($password, $user->getPassword())) {
                            $errors_login = true;
                        } else {
                            $DB->connectUser($user->getId(), $router->url('Admin#Home'));
                        }
                    }
                }
            } else {
                $errors = $validate->errors();
            }
            $data = $post;
        }
        $form = new Form($data, $errors);
        return [$errors_login, $form, $message];
    }
    public function register($router)
    {
        $data = [];
        $errors = [];
        $errors_register = false;
        $create_account = false;
        $message = '';
        $this->is_alredy_login($router);
        if (!empty($_POST)) {
            $validate = new Validator($_POST);
            $validate->rule('required', 'username')
                ->rule('required', 'email')
                ->rule('required', 'password')
                ->rule('accepted', 'terms-conditions')
                ->rule('email', 'email')
                ->rule('required', 'username')
                ->rule("lengthMin", 'username', 8);
            if ($validate->validate()) {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                if (!in_array(explode('@', $email)[1], ['gmail.com', 'yahoo.com', 'hotmail.com', 'protonmail.com'])) {
                    $errors_register = true;
                    $message .= 'Use valide email !';
                } else {
                    $user = (new Login($this->db))->checkUser($email);
                    if ($user === false) {
                        $user = (new Users);
                        $user->setUsername($username)
                            ->setEmail($email)
                            ->setPassword(password_hash($password, PASSWORD_BCRYPT));
                        $newUser = (new Register)->newuser($user);
                        //sendConfirmeMessage
                        $create_account = true;
                    } else {
                        $errors_register = true;
                        $message .= 'User already exist';
                    }
                }
            } else {
                $errors = $validate->errors();
            }

            $data = $_POST;
        }
        $form = new Form($data, $errors);
        return [$errors_register, $create_account, $form, $message];
    }

    public function countUser(){
        $query = 'SELECT COUNT(id) as allusers FROM users ';
        return (int)$this->db->select($query,false)->allusers;
    }

    public function getUsers():array
    {
        $query = "SELECT * FROM $this->table";
        return $this->db->select($query,true,null,PDO::FETCH_CLASS,Users::class);
    }

    public function getUserById(int $id){
        $query = "SELECT * FROM $this->table WHERE id = :id";
        return $this->db->select($query,false,['id'=>$id],PDO::FETCH_CLASS,Users::class);
    }

    public function getRoleById(int $id){
        $query = "SELECT * FROM roles WHERE id = :id";
        return $this->db->select($query,false,['id'=>$id]);
    }
}