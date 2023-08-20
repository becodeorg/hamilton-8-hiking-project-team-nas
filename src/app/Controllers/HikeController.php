<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\HikeDatabase;
use App\Models\TagDatabase;
use Exception;

class HikeController
{
    public function showHikeList()
    {
        try {
            $hikeDatabase = new HikeDatabase();

            $hikes = $hikeDatabase->findAll(10);

            // 3 - Affichage de la liste des produits
            include 'app/views/layout/header.view.php';
            include 'app/views/hikes.view.php';
            include 'app/views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function showOneHike(string $hikeId)
    {
        try {
            // 1- Get hike
            $hike = (new HikeDatabase())->find($hikeId);

            // 2- if no hike, exit
            if (empty($hike)) {
                (new PageController())->page_404();
                die;
            }

            //3- get tags
            $tags = (new TagDatabase())->findAll($hikeId);
            // 4 - Afficher la page
            include 'app/views/layout/header.view.php';
            include 'app/views/hike.view.php';
            include 'app/views/layout/footer.view.php';
        } catch (Exception $e) {
            (new PageController())->page_500($e->getMessage());
        }
    }

    public function addHike(int $user_id,string $hikenameInput, string $distanceInput, string $durationInput, string $elevation_gainInput, string $descriptionInput)
    {
        if (empty($hikenameInput) ||empty($distanceInput) || empty($durationInput) || empty($elevation_gainInput) || empty($descriptionInput)) {
            throw new Exception('Formulaire non complet');
        }

        $hikename = htmlspecialchars($hikenameInput);
        $distance = htmlspecialchars($distanceInput);
        $duration = htmlspecialchars($durationInput);
        $elevation_gain =htmlspecialchars($elevation_gainInput);
        $description =htmlspecialchars($descriptionInput);

        $this->db->query(
            "
            INSERT INTO Hikes (user_id,name,distance,duration, elevation_gain, description) 
            VALUES (?, ?, ?, ?, ?,?)
        ",
            [$user_id,$hikename, $distance, $duration, $elevation_gain, $description]
        );

        $_SESSION['user'] = [
            'id' => $this->db->lastInsertId(),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'nickname' => $nickname,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /');
    }

    public function showAddHikeForm()
    {
        include 'views/layout/header.view.php';
        include 'views/addhike.view.php';
        include 'views/layout/footer.view.php';
    }
}
