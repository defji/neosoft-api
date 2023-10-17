<?php

namespace NeosoftApi\Models;

class UserModel
{
    private $users = [
        ['id' => 1, 'username' => 'user1', 'password' => 'password1'],
        ['id' => 2, 'username' => 'user2', 'password' => 'password2'],
    ];

    public function getUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByUsername($username)
    {
        foreach ($this->users as $user) {
            if ($user['username'] == $username) {
                return $user;
            }
        }
        return null;
    }
}

