<?php

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
     
session_start();
        $this->pdo = $pdo;
    }
    // inscription 
    public function inscription($username, $password, $email)
    {
        $query = $this->pdo->prepare("insert into users (username,password,email) values (:username,:password,:email)");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', hash('sha256', $password), PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $lastInsertId = $this->pdo->lastInsertId();

        if ($lastInsertId) {
            echo "<script>alert('inséré avec succès vous pouvez vous connecter');</script>";
            echo "<script>window.location.href='client.php'</script>";
        } else {
            echo "<script>alert('Veuillez réessayer');</script>";
            echo "<script>window.location.href='client.php'</script>";
        }
    }
     //affichage tout les utilisateurs  
    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("select id,username,password,email,type from users");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    //affichage les utilisateurs de type propriétaire 
    public function getAllUsersNoAdmin()
    {
        $sql='select id,username,password,email,type from users where type="prop"';
        $stmt = $this->pdo->prepare( $sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    // supprimer utilisateur
    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("delete from users where id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>alert('supprimé avec succès');</script>";
        echo "<script>window.location.href='admin.php'</script>";
    }
    // connexion
    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("select id,username,password,email,type from users  WHERE username = ? and password = ? ");

        $stmt->execute([$username, hash('sha256', $password)]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            if ($username == $res["username"] && hash('sha256', $password) == $res["password"]) { //verification
                $_SESSION['is_logged_in'] = true;
                $_SESSION['type'] = $res['type'];
                $_SESSION['user_id'] = $res['id'];
                return $res;
               
            }else{
                echo "<script>alert('Error , SVP verifier ton username et password !');</script>";
                echo "<script>window.location.href='client.php'</script>";
            }
        }

    }

}
