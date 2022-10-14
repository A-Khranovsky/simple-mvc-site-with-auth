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

    public function login($userName, $password)
    {
        $sql = "select id from users where login=:userName and password=:password";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'userName' => $userName,
            'password' => $password
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }

    public function getAllById($id)
    {
        $sql = "select * from users where id=:id";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'id' => $id
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }

    public function getAllLoginId($login)
    {
        $sql = "select * from users where login=:login";

        $result = $this->database->pdo->prepare($sql);
        $result->execute([
            'login' => $login
        ]);
        return $result->fetch(Database::FETCH_ASSOC);
    }
//    {
//        ini_set ("session.use_trans_sid", true);    session_start();    if (isset($_SESSION['id']))//если сесcия есть
//
//        {
//            if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) //если cookie есть, обновляется время их жизни и возвращается true      {
//                SetCookie("login", "", time() - 1, '/');            SetCookie("password","", time() - 1, '/');
//
//            setcookie ("login", $_COOKIE['login'], time() + 50000, '/');
//
//            setcookie ("password", $_COOKIE['password'], time() + 50000, '/');
//
//            $id = $_SESSION['id'];
//            lastAct($id);
//            return true;
//
//        }
//        else //иначе добавляются cookie с логином и паролем, чтобы после перезапуска браузера сессия не слетала
//        {
//            $rez = mysql_query("SELECT * FROM users WHERE id='{$_SESSION['id']}'"); //запрашивается строка с искомым id
//
//            if (mysql_num_rows($rez) == 1) //если получена одна строка          {
//                $row = mysql_fetch_assoc($rez); //она записывается в ассоциативный массив
//
//            setcookie ("login", $row['login'], time()+50000, '/');
//
//            setcookie ("password", md5($row['login'].$row['password']), time() + 50000, '/');
//
//            $id = $_SESSION['id'];
//            lastAct($id);
//            return true;
//
//        }
//    else return false;
//    }
//}
//else //если сессии нет, проверяется существование cookie. Если они существуют, проверяется их валидность по базе данных
//{
//    if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) //если куки существуют
//
//    {
//        $rez = mysql_query("SELECT * FROM users WHERE login='{$_COOKIE['login']}'"); //запрашивается строка с искомым логином и паролем
//        @$row = mysql_fetch_assoc($rez);
//
//        if(@mysql_num_rows($rez) == 1 && md5($row['login'].$row['password']) == $_COOKIE['password']) //если логин и пароль нашлись в базе данных
//
//        {
//            $_SESSION['id'] = $row['id']; //записываем в сесиию id
//            $id = $_SESSION['id'];
//
//            lastAct($id);
//            return true;
//        }
//        else //если данные из cookie не подошли, эти куки удаляются
//        {
//            SetCookie("login", "", time() - 360000, '/');
//
//            SetCookie("password", "", time() - 360000, '/');
//            return false;
//
//        }
//    }
//    else //если куки не существуют
//    {
//        return false;
//    }
//}
//}
}