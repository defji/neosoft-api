<?php

namespace NeosoftApi\Models;


use NeosoftApi\Database\Database;
use PDO;

const PW_SALT = 'neosoft';

class UserModel
{


    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function authUser($username, $password): array
    {
        $encryptedPassword = sha1(PW_SALT.$password);
        $query = "SELECT * FROM users where username=:username and password=:password";

        $user = $this->db->query($query, [
            'username' => $username,
            'password' => $encryptedPassword,
        ]);
        var_dump($user);
//        $this->saveToken($user, $this->generateToken());


        return $user;
    }

    private function saveToken(array $user, string $token)
    {
//        $query = "update users set token='{$token}'  where id={$user['id']}"";
//        $statement = $this->db->query($query);

    }


    public function getUserById($id)
    {

        $query = "SELECT * FROM users where id =:id";
        $user = $this->db->query($query, ['id' => $id])[0];
        var_dump($user);

    }


    private function generateToken()
    {
        return bin2hex(random_bytes(64));
    }

}

