<?php


namespace App\models;


use App\Database\Database;

class User extends Model
{
    private Database $database;

    public function __construct()
    {
        $this->database = self::$db;
    }

    public function login(string $userName, string $password): array
    {
        $sql = "select id from users where login=:userName and password=:password";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'userName' => $userName,
            'password' => $password
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }

    public function getAllById(int $id): array
    {
        $sql = "select * from users where id=:id";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'id' => $id
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }

    public function getAllByLogin(string $login): array|bool
    {
        $sql = "select * from users where login=:login";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'login' => $login
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }
}