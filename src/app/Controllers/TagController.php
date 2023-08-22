<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\HikeDatabase;
use App\Models\TagDatabase;
use Exception;

class TagController
{
    public function showHikesPerTag(string $tagId)
    {
        try {
            $tag = (new TagDatabase())->find($tagId);
            if (empty($tag)) {
                (new PageController())->page_404();
                die;
            }
            $hikeDatabase = new HikeDatabase();


            $hikes = $hikeDatabase->findHikesForTag($tagId);

            include 'app/views/layout/header.view.php';
            include 'app/views/tag.view.php';
            include 'app/views/layout/footer.view.php';
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
