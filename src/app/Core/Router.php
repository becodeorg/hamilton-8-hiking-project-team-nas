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
                case "/addhike":
                    $hikeController = new HikeController();
                    if ($method === "GET") $hikeController->showAddHikeForm();

                    if ($method === "POST") $hikeController->addHike($_SESSION['user']['id'],$_POST['hikename'],$_POST['distance'],$_POST['duration'],$_POST['elevation_gain'], $_POST['description']);
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
