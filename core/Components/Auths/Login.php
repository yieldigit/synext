<?php
namespace Synext\Components\Auths;

use Synext\Components\Databases\Database;
use Synext\Helpers\FlashMessage;
use Synext\Helpers\Redirect;
use Synext\Helpers\Session;
use Synext\Models\Users;
use PDO;
class Login {

    private $db;
    private $data;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    /**
     * Function using to check all user information before connect them [connect_user].
     *
     * @param string $email user email
     *
     * @return Users|bool : content data of user
     */
    public function checkUser(string $email)
    {
        $query = 'SELECT * FROM users WHERE email = ?';
        $this->data = $this->db->select($query,false,[$email],PDO::FETCH_CLASS,Users::class);
        return $this->data;
        //false ou Users null
    }

    /**
     * connect user
     *
     * @param integer $userId
     * @param string $url
     * @return void
     */
    public function connectUser(int $userId,string $url = '/'){
        Session::checkSession();
        $_SESSION['Auth'] = $userId;
        $_SESSION['flash']['succes'] = true;
        FlashMessage::success('Bienvenu '.$this->data->getUsername());
        Redirect::To($url);
    }
}