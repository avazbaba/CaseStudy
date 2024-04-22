<?php
namespace App\Model;

use ORM;


class User extends \ORM
{

    protected static $_table = 'User';

    public static function createUser($username, $password, $address, $phone_number)
    {
        $hashed_password = hash('sha256', $password);

        $user = ORM::forTable(static::$_table)->create();
        $user->username = $username;
        $user->password = $hashed_password;
        $user->address = $address;
        $user->phone_number = $phone_number;
        $user->save();
        return true;
    }

    public static function authenticateUser($username, $password)
    {
        $hashed_password = hash('sha256', $password);

        $user = ORM::forTable(static::$_table)
            ->whereEqual('username', $username)
            ->findOne();
        return ($hashed_password === $user->password);
    }
}

?>
