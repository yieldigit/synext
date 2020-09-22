<?php
namespace App\Controllers;

use App\Database;
use App\Models\Users;
use PDO;
class User{
    private $db;
    private $table = 'users';
    public function __construct()
    {
        $this->db = new Database();
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