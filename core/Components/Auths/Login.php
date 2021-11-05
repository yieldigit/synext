<?php
namespace Synext\Components\Auths;

use PDO;
use Synext\Models\Users;
use Synext\Sessions\Flash;
use Synext\Sessions\Session;
use Synext\Requests\Redirect;
use Synext\Components\Databases\Database;

class Login {

    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
}