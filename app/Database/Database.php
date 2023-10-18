<?php


namespace NeosoftApi\Database;

use PDO;
use PDOException;

//const DB_HOST = 'localhost';
//const DB_NAME = 'neo';
//const DB_PASSWORD = 'plokplok4';
//const DB_USER = 'root';
//

class Database
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error during db connection: '.$e->getMessage());
        }
    }

    public function query($query, $params = [])
    {
        $stmt = $this->db->prepare($query);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        foreach ($params as $param => $value) {
            $type = ($value === intval($value)) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindParam($param, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
