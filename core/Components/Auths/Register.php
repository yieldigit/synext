<?php
namespace Synext\Components\Auths;

use Synext\Components\Databases\Database;
use Synext\Components\Emails\SendMail;
use Synext\Components\Htmls\HtmlTemplate;
use Synext\Models\Users;

class Register{
    public function __construct(Database $db = null)
    {
        $this->db = $db;
    }

}