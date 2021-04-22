<?php
namespace Synext\APP;

use Synext\Components\Databases\Database;

class Produits{
    private $db ;
    private $table = "produits";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function add($sql ,$data){
        return $this->db->insert($sql,$data,true);
    }

    public function get(){
        return $this->db->select("SELECT * from $this->table");
    }
}