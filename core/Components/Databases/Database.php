<?php

namespace Synext\Components\Databases;

use PDO;

/**
 * [Description Database] manipulate the database
 */
class Database
{


    public function __construct()
    {
        $dsn = getenv('DB_CONNECTION') . ":host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_NAME') . ";";
        try {
            $this->db = new PDO(
                $dsn . 'charset=utf8',
                getenv('DB_USER'),
                getenv('DB_PASS'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
        } catch (\PDOException $e) {
            die('Unable to connect to the database ' . $e->getMessage() . '<br>');
        }
    }

    public  function pdo(): PDO
    {
        return $this->db;
    }

    public function select(string $query, bool $fetchAll = true, array $value = null, int $fetchmod = null, string $classname = null)
    {
        if (isset($value)) {
            $query = $this->db->prepare($query);
            $query->execute($value);
            if (!$fetchAll) {
                if (isset($fetchmod)) {
                    $query->setFetchMode($fetchmod, $classname);

                    return $query->fetch();
                } else {
                    return $query->fetch();
                }
            } else {
                if (isset($fetchmod)) {
                    return $query->fetchAll($fetchmod, $classname);
                }

                return $query->fetchAll();
            }
        }
        $query = $this->db->query($query);
        if (!$fetchAll) {
            if (isset($fetchmod)) {
                $query->setFetchMode($fetchmod, $classname);

                return $query->fetch();
            } else {
                return $query->fetch();
            }
        } else {
            if (isset($fetchmod)) {
                return $query->fetchAll($fetchmod, $classname);
            }

            return $query->fetchAll();
        }
    }

    public function insert(string $query, array $value, bool $lastInsertId = false)
    {
        $toBd = $this->db->prepare($query);
        if ($toBd->execute($value)) {
            if ($lastInsertId) {
                return  (int) $this->db->lastInsertId();
            }

            return true;
        } else {
            return false;
        }
    }

    public function delete(string $query, array $value): bool
    {
        $delect = $this->db->prepare($query)->execute($value);
        if ($delect) {
            return true;
        }

        return false;
    }

    public function update(string $query, array $value)
    {
        $update = $this->db->prepare($query);
        if ($update->execute($value)) {
            return true;
        }
        return false;
    }
}
