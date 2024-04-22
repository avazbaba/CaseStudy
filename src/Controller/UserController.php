<?php

namespace App\Controller;

use App\Model\User;
use Exception;

class UserController extends BaseController
{

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->render('register', ['title' => 'Registrieren']);
            return;
        }

        $username = $this->sanitizeInput($_POST['username']);
        $password = $this->sanitizeInput($_POST['password']);
        $address = $this->sanitizeInput($_POST['address']);
        $phone_number = $this->sanitizeInput($_POST['phone']);

        try {
            if (!$this->validatePassword($password)) {
                $this->renderError('register', 'Ungültiges Passwort. Bitte versuchen Sie es erneut');
                return;
            }

            if (!User::createUser($username, $password, $address, $phone_number)) {
                $this->renderError('register', 'Benutzer konnte nicht registriert werden. Bitte versuchen Sie es erneut');
                return;
            }

            $_SESSION['username'] = $username;
            $_SESSION['user_logged_in'] = true;
            $this->render('home', ['title' => 'CaseStudy']);
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->render('login', ['title' => 'Login']);
            return;
        }

        $username = $this->sanitizeInput($_POST['username']);
        $password = $this->sanitizeInput($_POST['password']);

        try {
            if (!User::authenticateUser($username, $password)) {
                $this->renderError('login', 'Benutzername oder Passwort ist ungültig');
                return;
            }

            $_SESSION['username'] = $username;
            $_SESSION['user_logged_in'] = true;
            header('Location: /', true, 303);
            exit;
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['user_logged_in']);
        $this->render('home', ['title' => 'CaseStudy']);
    }

    private function sanitizeInput($data)
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    private function validatePassword($password)
    {
        return strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) &&
            preg_match('/[^A-Za-z0-9]/', $password);
    }

    private function renderError($view, $message)
    {
        $this->render($view, ['title' => $view, 'errorMessage' => $message]);
    }

    private function handleException($exception)
    {
        error_log($exception->getMessage());
        $this->renderError('register', 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut');
    }
}
