<?php

class Announcement
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
   //ajout annonce  
    public function insert($user_id,$image, $details, $typeDeBien)
    {
        
        $query = $this->pdo->prepare("insert into annonces(user_id,image,details,typeDeBien) values (:uid,:img,:dtl,:tdb)");
        $query->bindParam(':uid', $user_id, PDO::PARAM_STR);
        $query->bindParam(':img', $image, PDO::PARAM_STR);
        $query->bindParam(':dtl', $details, PDO::PARAM_STR);
        $query->bindParam(':tdb', $typeDeBien, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $this->pdo->lastInsertId();

        if ($lastInsertId) {
            echo "<script>alert('inséré avec succès');</script>";
            echo "<script>window.location.href='prop.php'</script>";
        } else {
            echo "<script>alert('Veuillez réessayer');</script>";
            echo "<script>window.location.href='prop.php'</script>";
        }
    }
    // affichage les annonces de chaque user connecté  
    public function getLoggedInUserAnnoucenments($user_id)
    {
        $stmt = $this->pdo->prepare("select id,image,details,typeDeBien from annonces where user_id=".$user_id);        
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
      // affichage tout les annonces 
    public function getAllAnnoucenments()
    {
        $stmt = $this->pdo->prepare("select id,image,details,typeDeBien from annonces");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
     //modifier annonce
    public function update($id, $image, $details, $typeDeBien)
    {
        $stmt = $this->pdo->prepare("update annonces set image=:img,details=:dtl,typeDeBien=:tdb where id=:id");
        $stmt->bindParam(':img', $image, PDO::PARAM_STR);
        $stmt->bindParam(':dtl', $details, PDO::PARAM_STR);
        $stmt->bindParam(':tdb', $typeDeBien, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>alert('mis à jour avec succès');</script>";
        echo "<script>window.location.href='prop.php'</script>";

    }
      // affichage  annonces avec button details 
    public function getAnnouncement($id)
    {
        $stmt = $this->pdo->prepare("select id,image,details,typeDeBien from annonces where id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // supprimer annonce
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("delete from annonces where id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>alert('supprimé avec succès');</script>";
        echo "<script>window.location.href='prop.php'</script>";
    }
}