<?php

use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new App\Controller\UserController();

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        ORM::configure('mysql:host=' . $_ENV['MYSQL_HOST'] . ';dbname=' . $_ENV['MYSQL_DATABASE']);
        ORM::configure('username', $_ENV['MYSQL_USER']);
        ORM::configure('password', $_ENV['MYSQL_PASSWORD']);

        $db = ORM::get_db();
        $db->beginTransaction();

    }

    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        $_SERVER = [];
        ORM::get_db()->rollBack();

        parent::tearDown();
    }

    public function testRegisterGetRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->controller->register();
        $this->expectOutputRegex('/Registrieren/');

    }

    private function registerSuccessfully()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'newUser';
        $_POST['password'] = 'Password1!';
        $_POST['address'] = '123 Example St';
        $_POST['phone'] = '1234567890';
        $this->controller->register();
    }

    public function testRegisterPostRequest()
    {

        $this->registerSuccessfully();
        $this->expectOutputRegex('/Welcome to the Case Study Project!/');
        $this->assertTrue($_SESSION['user_logged_in']);
        $this->assertEquals('newUser', $_SESSION['username']);
    }

    public function testRegisterPostRequestWithInvalidPassword()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'testuser';
        $_POST['password'] = '23423';
        $_POST['address'] = '123 Test Str';
        $_POST['phone'] = '1234567890';
        $this->controller->register();
        $this->expectOutputRegex('/Ungültiges Passwort/');
    }


    //Mehr tests kann geschrieben werden
}
