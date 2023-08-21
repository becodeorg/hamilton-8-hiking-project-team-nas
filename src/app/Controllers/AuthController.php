<?php

namespace App\Controllers;

use Exception;
use App\Models\User;
use App\Controllers\HikeController;

class AuthController extends User
{
    /**
     * @return void
     */
    public function showLoginForm(): void
    {
        if (!empty($_GET['error_value'])) {
            $error_value = $_GET['error_value'];
        }
        include_once "app/views/layout/header.view.php";
        include_once "app/views/login.view.php";
        include_once "app/views/layout/footer.view.php";
    }
    /**
     * @param array $post
     * 
     * @return void
     */
    public function registerVerification(array $post): void
    {
        try {
            // check l'inscription d'un utilisateur
            // check si les champs ne sont pas vide
            // 101 => si les champs son vide
            // 102 => si l'utilisateur existe dans la DB
            // 201 => si l'email n'est aps valide
            // 500 => erreur serveur
            if (empty($post['firstname']) || empty($post['lastname']) || empty($post['nickname']) || empty($post['email']) || empty($post['password'])) {
                throw new Exception("101");
            }
            $firstname = htmlspecialchars($post['firstname']);
            $lastname = htmlspecialchars($post['lastname']);
            $nickname = htmlspecialchars($post['nickname']);

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("201");
            }
            $password_hash = password_hash($post['password'], PASSWORD_DEFAULT);

            $user = User::getUserByUsernameAndEmail(
                [
                    "nickname" => $nickname,
                    "email" => $email
                ]
            );
            if (!empty($user)) {
                throw new Exception("102");
            }

            $result = User::insertNewUser(
                [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "nickname" => $nickname,
                    "email" => $email,
                    "password" => $password_hash
                ]
            );
            if (!$result["bool"]) {
                throw new Exception("500");
            }

            unset($_SESSION['hamilton-8-NAS_user']);
            $_SESSION['hamilton-8-NAS_user'] = array(
                "id" => $result["id"],
                "firstname" => $firstname,
                "lastname" => $lastname,
                "nickname" => $nickname,
                "email" => $email
            );

            header('Location: /');
        } catch (Exception $e) {
            header('Location: /register?error_value=' . $e->getMessage());
        }
    }
    /**
     * @return [type]
     */
    public function showRegisterForm()
    {
        if (isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        include_once "app/views/layout/header.view.php";
        include_once "app/views/register.view.php";
        include_once "app/views/layout/footer.view.php";
    }
    /**
     * @return void
     */
    public function logout(): void
    {
        unset($_SESSION['hamilton-8-NAS_user']);
        header('Location: /');
    }
    /**
     * @param array $post
     * 
     * @return void
     */
    public function loginVerification(array $post): void
    {
        try {
            // check la connexion d'un utilisateur
            // check si les champs ne sont pas vide
            // 101 => si les champs son vide
            // 102 => si l'utilisateur n'existe pas dans la DB
            // 201 => si l'email n'est aps valide
            // 202 => si le mot de passe n'est pas valide

            if (empty($_POST['email']) || empty($post['password'])) {
                throw new Exception("101");
            }
            //on filtre l'email
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('201');
            }
            // on cherche l'user associé à l'email
            $user = User::getUserByEmail($email);
            if (empty($user)) {
                throw new Exception("102");
            }

            if (!password_verify($post['password'], $user['password'])) {
                throw new exception("202");
            }
            unset($_SESSION['hamilton-8-NAS_user']);
            $_SESSION['hamilton-8-NAS_user'] = array(
                "id" => $user['id'],
                "nickname" => $user['nickname'],
                "email" => $email
            );

            header('Location: /');
        } catch (Exception $e) {
            $location = 'Location: /login?error_value=';
            $msg = $e->getMessage();

            switch ($msg) {
                case "101":
                    $location .= 'nodata';
                    break;
                case "102":
                    $location .= "nodb";
                    break;
                case "201":
                    $location .= "email";
                    break;
                case "202":
                    $location .= "pwd";
                    break;
                default:
                    header('Location: /error');
            }
            // $location => 'Location: /login?error_value={:nodata | :nodb | :email | :pwd}
            header($location);
        }
    }
    public function showUserProfile(string|int $id): void
    {
        $user = User::getUserById($id);
        if ($_SESSION['hamilton-8-NAS_user']['id'] == '1' && !isset($_GET['id'])) {
            $hikes = (new Hike())->getAllHike();
        } else {
            $hikes = User::getHikeByUserId($id);
        }

        include_once "app/views/layout/header.view.php";
        include_once "app/views/profile.view.php";
        include_once "app/views/layout/footer.view.php";
    }
    public function showUpdateProfile(): void
    {
        if(isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        if (isset($_GET['modify'])) {
            $modify = htmlspecialchars($_GET['modify']);
        }
        include_once "app/views/layout/header.view.php";
        include_once "app/views/modifyProfile.view.php";
        include_once "app/views/layout/footer.view.php";
    }

    public function updateProfileVerification(array $post): void
    {
        try {
            if (
                empty($post['firstname']) ||
                empty($post['lastname']) ||
                empty($post['password'])
                ) {
                throw new Exception("101");
            }

            $firstname = htmlspecialchars($post['firstname']);
            $lastname = htmlspecialchars($post['lastname']);

            $user = User::getUserById($_SESSION['hamilton-8-NAS_user']['id']);
            if (!$user) {
                throw new Exception("500");
            }
            if ($firstname != $user['firstname']) {
                if ($lastname != $user['lastname']) {
                    $result = User::updateUserFirstnameAndLastname(
                        [
                            "firstname" => $firstname,
                            "lastname" => $lastname,
                            "id" => $_SESSION['hamilton-8-NAS_user']['id']
                        ]
                    );
                } 
            } else {
                if ($lastname != $user['lastname']) {
                    $result = User::updateUserLastname(
                        [
                            "lastname" => $lastname,
                            "id" => $_SESSION['hamilton-8-NAS_user']['id']
                        ]
                    );
                } else {
                    throw new Exception("301");
                }
            }

            if (!password_verify($post['password'], $user['password'])) {
                throw new Exception("202");
            }
            if (!$result) {
                throw new Exception("500");
            }

            unset($_SESSION['hamilton-8-NAS_user']);
            $_SESSION['hamilton-8-NAS_user'] = array(
                "id" => $user['ID'],
                "nickname" => $user['nickname'],
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $user['email']
            );

            header('Location: /modify?value=account&modify=true');
        } catch (Exception $e) {
            header('Location: /modify?value=account&error_value=' . $e->getMessage());
        }
    }
}
