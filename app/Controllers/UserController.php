<?php

namespace NeosoftApi\Controllers;

use NeosoftApi\Models\UserModel;


class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function getUsers()
    {
        var_dump($this->userModel->getUserById(1));
    }

    public function login($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && $user['password'] === $password) {
            // Sikeres bejelentkezés, például szerepkör ellenőrzése és munkamenetkezelés
            session_start();
            $_SESSION['user'] = $user;
            // További műveletek, például átirányítás
        } else {
            // Sikertelen bejelentkezés, hibaüzenet és visszatérés a bejelentkező oldalra
            echo "Sikertelen bejelentkezés";
            // További műveletek, például átirányítás
        }
    }

    public function logout()
    {
        // Kijelentkezés, például a munkamenet törlése és átirányítás
        session_start();
        session_unset();
        session_destroy();
        // További műveletek, például átirányítás
    }

    // További metódusok, például felhasználó regisztráció, jelszóváltoztatás, stb.
}

