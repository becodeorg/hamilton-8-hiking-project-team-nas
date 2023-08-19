<?php

namespace Core;

use App\Controllers\AuthController;
use App\Controllers\HikeController;
use App\Controllers\PageController;
use Exception;

class Router
{
    public function route(string $uri_path): void
    {
        try {
            switch ($uri_path) {
                case "/":
                case "/index":
                case "/home":
                case "/index.php":
                    $hikeController = new HikeController();
                    $hikeController->showHikeList();
                    break;
                case "/login":
                    $authController = new AuthController();
                    if (empty($_POST)) {
                        $authController->showLoginForm();
                    } else {
                        $authController->loginVerification($_POST);
                    }
                    break;
                case "/register":
                    $authController = new AuthController();
                    if (empty($_POST)) {
                        $authController->showRegisterForm();
                    } else {
                        $authController->registerVerification($_POST);
                    }
                    break;
                case "/logout":
                    $authController = new AuthController();
                    $authController->logout();
                    break;
                case "/hike":
                    if (empty($_GET['hikeId'])) throw new Exception("Please provide a hike ID");
                    $hikeController = new HikeController();
                    $hikeController->showOneHike($_GET['hikeId']);
                    break;
                case "/profile":
                    $authController = new AuthController();
                    if (isset($_SESSION['hamilton-8-NAS_user'])) {
                        if (empty($_GET)) {
                            $authController->showUserProfile($_SESSION['hamilton-8-NAS_user']['id']);
                        } else {
                            $authController->showUserProfile(htmlspecialchars($_GET['id']));
                            }
                    } else {
                        header('Location: /login?error_value=601');
                        }
                    break;
                default:
                    $pageController = new PageController();
                    $pageController->page_404();
                    break;
            }
        } catch (Exception $e) {
            $pageController = new PageController();
            $pageController->page_500($e->getMessage());
        }
    }
}
