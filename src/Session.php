<?php

namespace App;

class Session
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function login($user)
    {
        $_SESSION['user'] = $user;
        $_SESSION['is_logged_in'] = true;
        $_SESSION['time_logged_in'] = time();
    }

    public function logout()
    {
        unset($_SESSION['is_logged_in'], $_SESSION['user'], $_SESSION['time_logged_in']);
        session_destroy();
    }

    public function isUserLoggedIn()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['is_logged_in'])) {
            return false;
        }

        return true;
    }
}
