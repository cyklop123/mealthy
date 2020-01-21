<?php
require_once 'Repository.php';
require_once __DIR__.'/../Models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $login) :?User
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE login=:user");
        $stmt->bindParam(':user', $login,  PDO::PARAM_STR);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if($res != null)
        {
            $user = new User($res['login'], $res['password'], $res['user_id'], $res['role']);
            $conn = null;
            return $user;
        }

        return null;
    }

    public function setUser(User $user):bool
    {
        $conn = $this->db->connect();

        $stmt = $conn->prepare("INSERT INTO users(login,password) VALUES (:login,:pass)");
        $stmt->bindParam(':login',$user->getLogin(), PDO::PARAM_STR);
        $stmt->bindParam(':pass',$user->getPassword(), PDO::PARAM_STR);
        if($stmt->execute())
            return true;
        else
            return false;
    }
}