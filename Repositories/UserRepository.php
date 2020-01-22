<?php
require_once 'Repository.php';
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/UserDetails.php';

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

        $conn->beginTransaction();
        $conn->exec("SET FOREIGN_KEY_CHECKS = 0");
        $status = null;

        $s1 = $conn->prepare("INSERT INTO user_details VALUES(NULL, 18, 175,1, 67)");
        $s1->execute();

        $last_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO users(login,password,user_details_id) VALUES (:login,:pass,:ud_id)");
        $stmt->bindParam(':login',$user->getLogin(), PDO::PARAM_STR);
        $stmt->bindParam(':pass',$user->getPassword(), PDO::PARAM_STR);
        $stmt->bindParam(':ud_id',$last_id, PDO::PARAM_INT);

        if($stmt->execute()) {
            $status = true;
            $conn->commit();
        }
        else {
            $status = false;
            $conn->rollBack();
        }

        $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

        return $status;
    }

    public function getUserDetails(int $id): ?UserDetails
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM users,user_details WHERE users.user_details_id=user_details.user_details_id AND user_id=:id");
        $stmt->bindParam(':id', $id,  PDO::PARAM_INT);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if($res != null)
        {
            $user = new UserDetails($res['login'], $res['password'], $res['user_details_id'], $res['role'], $res['age'], $res['size'], $res['weight'], $res['male']);
            //var_dump($user);
            //();
            $conn = null;
            return $user;
        }
        return null;
    }

    public function updateUserDetails($age, $size, $weight, $male, $id) : bool
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("UPDATE user_details SET age=:age, size=:size, male=:male, weight=:weight WHERE user_details_id=:id");
        $stmt->bindParam(':age', $age,  PDO::PARAM_STR);
        $stmt->bindParam(':size', $size,  PDO::PARAM_STR);
        $stmt->bindParam(':male', $male,  PDO::PARAM_STR);
        $stmt->bindParam(':weight', $weight,  PDO::PARAM_STR);
        $stmt->bindParam(':id', $id,  PDO::PARAM_STR);
        if($stmt->execute())
            return  true;
        return false;
    }
}