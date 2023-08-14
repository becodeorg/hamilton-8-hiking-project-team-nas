<?php

declare(strict_types=1);

session_start();

use App\Controllers\HikeController;
use App\Controllers\PageController;

try {
    $url_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    $method = $_SERVER['REQUEST_METHOD']; // GET -- POST

    switch ($url_path) {
        case "":
        case "/index.php":
            $hikeController = new HikeController();
            $hikeController->showHikeList();
            break;
        case "hike":
            if (empty($_GET['hikeId'])) throw new Exception("Please provide a hike ID");
            $hikeController = new HikeController();
            $hikeController->showOneHike($_GET['hikeId']);
            break;
        default:
            $pageController = new PageController();
            $pageController->page_404();
    }
} catch (Exception $e) {
    $pageController = new PageController();
    $pageController->page_500($e->getMessage());
}
