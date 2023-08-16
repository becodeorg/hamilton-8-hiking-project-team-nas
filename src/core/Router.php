<?php
namespace core;

use controllers\ProductController;
use controllers\AuthController;

class Router
{
    public function route(string $uri_path): void
    {
        switch ($uri_path) {
            case "/":
            case "/index":
            case "/login":
                $authController = new AuthController();
                if (empty($_POST)){
                    $authController->showLoginForm();
                }else {
                    $authController->loginVerification($_POST);
                    }
                break;
            case "/register":
                $authController = new AuthController();
                if (empty($_POST)){
                    $authController->showRegisterForm();
                }else {
                    $authController->registerVerification($_POST);
                    }
                break;
            case "/register":
                echo "";
                break;
             case "/logout":
                $authController = new AuthController();
                $authController->logout();
                break;
        }
    }
}