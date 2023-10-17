<?php

namespace NeosoftApi\Models;


use NeosoftApi\Database\Database;
use PDO;

class UserModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getUserById($id)
    {

        $query = "SELECT * FROM users where id={$id}";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

