<?php

namespace App\Controllers;

use Exception;
use App\Models\User;

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
    public function showRegisterForm()
    {
        if (isset($_GET['error_value'])) {
            $error_value = htmlspecialchars($_GET['error_value']);
        }
        include_once "app/views/layout/header.view.php";
        include_once "app/views/register.view.php";
        include_once "app/views/layout/footer.view.php";
    }
    public function logout(): void
    {
        unset($_SESSION['hamilton-8-NAS_user']);
        header('Location: /');
    }
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
}
