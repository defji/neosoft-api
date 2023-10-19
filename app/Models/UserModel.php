<?php

namespace NeosoftApi\Models;


use NeosoftApi\Database\Database;
use PDO;

const PW_SALT = 'neosoft';

class UserModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUser()
    {
        $query = "select * from users";
        return $this->db->query($query, []);
    }


    public function authUser($username, $password): ?string
    {
        $encryptedPassword = sha1(PW_SALT.$password);
        $query = "select * from users where username='{$username}' and password='{$encryptedPassword}'";
        $user = $this->db->query($query, [])[0] ?? null;
        if ($user) {
            return $this->saveToken($user, $this->generateToken());
        }
        return null;
    }

    /**
     * Check token is valid
     * @param $token
     * @return bool
     */
    public function getUserByToken($token): bool
    {
        $query = "select * from users where auth_token='{$token}'";
        $user = $this->db->query($query, [])[0] ?? null;
        return is_array($user);
    }

    private function saveToken(array $user, string $token)
    {
        $id = $user['id'];
        $query = "update users set auth_token='{$token}'  where id={$id}";
        $statement = $this->db->query($query);
        return $token;
    }


    public function getUserById($id)
    {

        $query = "SELECT * FROM users where id =:id";
        $user = $this->db->query($query, ['id' => $id])[0];
        var_dump($user);

    }


    /**
     * Generate auth token
     * @return string
     * @throws \Exception
     */
    private function generateToken()
    {
        return bin2hex(random_bytes(64));
    }

    /**
     * Removing sensitive data from user
     * @param $user
     * @return array
     */
    public static function outputFormatter($user): array
    {
        unset($user['password']);
        unset($user['auth_token']);
        return $user;
    }


}

