<?php

namespace App\Controller;

class BaseController
{

    public function index()
    {
        $this->render('home', ['title' => 'CaseStudy']);
    }

    protected function render($view, array $data = [])
    {
        extract($data);
        $filePathHeader = __DIR__ . "/../View/partials/header.php";
        if (file_exists($filePathHeader)) {
            include_once $filePathHeader;
        }

        $filePath = __DIR__ . "/../View/" . $view . '.php';
        if (file_exists($filePath)) {
            include_once $filePath;
        } else {
            echo "Error: View existiert nicht.";
        }

        $filePathFooter = __DIR__ . "/../View/partials/footer.php";
        if (file_exists($filePathFooter)) {
            include_once $filePathFooter;
        }
    }
}
