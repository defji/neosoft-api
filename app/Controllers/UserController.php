<?php

namespace NeosoftApi\Controllers;

use NeosoftApi\Models\UserModel;


class UserController
{

    private $userModel;
    private $postParams;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postParams = json_decode(file_get_contents('php://input'), true);

    }


    public function authUser()
    {
        $username = isset($this->postParams['username']) ? $this->postParams['username'] : null;
        $password = isset($this->postParams['password']) ? $this->postParams['password'] : null;

        if ($username && $password) {
            $user = $this->userModel->authUser($username, $password);
            var_dump($user);

        } else {
            http_send_status(422);
            print "Unprocasseble login credentials.";
        }
    }


    public
    function getUsers()
    {
        var_dump($this->userModel->getUserById(1));
    }

    public
    function login(
        $username,
        $password
    ) {
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


}

