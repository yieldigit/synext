<?php

namespace Synext\Models;

use Synext\Components\Databases\Database;
use PDO;

/**
 * [Description Model] Use to interact with Database table
 */
class Model extends Database
{

    /**
     * [Descrciption save data to the database]
     * 
     * @param array $data
     * 
     * @return [int|bool]
     */
    public function save(array $data)
    {

        $query = "INSERT INTO $this->table (" . (implode(',', array_keys($data))) . ") VALUES (" . implode(",", array_map(function ($key) {
            return ":" . $key;
        }, array_keys($data))) . ")";
        return $this->insert($query, $data);
    }

    /**
     * @param int $id
     * 
     * @return [bool]
     */
    public function unsave(int $id)
    {
        return $this->delete("DELETE FROM $this->table WHERE id=:id", ["id" => $id]);
    }

    /**
     * @param array $data
     * 
     * @return [bool]
     */
    public function modifed(array $data)
    {

        $query = "UPDATE $this->table SET " . implode(",", array_map(function ($key) {
            return $key . "=" . ":" . $key;
        }, array_keys($data))) . ",update_at = NOW() WHERE $this->table.id=:id";
        return $this->update($query, $data);
    }

    /**
     * @param string $table
     * 
     * @return [mixed]
     */
    public function  findAll(string $table)
    {
        return $this->select("SELECT * from {$table}");
    }

    /**
     * @param string $table
     * 
     * @return [mixed]
     */
    public function  findAllOrderByDesc(string $table)
    {
        return $this->select("SELECT * from {$table} ORDER BY id DESC");
    }

    /**
     * @param string $table
     * @param int $id
     * 
     * @return [mixed]
     */
    public function findWhereId(string $table, int $id)
    {
        return $this->select("SELECT * FROM {$table} WHERE id = :id", true, ['id' => $id]);
    }

    /**
     * @param string $table
     * @param mixed $field
     * @param int $equal
     * 
     * @return [mixed]
     */
    public function findWhereEqual(string $table, $field, int $equal)
    {
        return $this->select("SELECT * FROM {$table} WHERE $field=:$field", true, [$field => $equal]);
    }

    /**
     * @param string $table
     * @param int $id
     * @param mixed $slug
     * 
     * @return [mixed]
     */
    public function findWhereIdAndSlug(string $table, int $id, $slug)
    {
        return $this->select("SELECT * FROM {$table} WHERE id =:id AND slug = :slug", false, ['id' => $id, 'slug' => $slug]);
    }

    /**
     * @param string $table
     * 
     * @return [mixed]
     */
    public function  findId(string $table)
    {
        return $this->select("SELECT id from {$table}");
    }
}
