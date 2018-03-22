<?php

namespace simplon\dao;
use simplon\entities\User;
use simplon\entities\Favorite;
use simplon\dao\Connect;
use simplon\dao\DaoFavorite;

class DaoPoll {
  public function addWithFavorites(User $user){
    try {
      // on créé un nouveau user dans la base de données
      $query = Connect::getInstance()->prepare(
        "INSERT INTO users(name) VALUES (:name)"
      );
      // pour cela, on passe le contenu du champ name de notre User
      $query->bindValue(":name", $user->get()["title"]);
      $query->execute();
      // on récupère l'id du user qui viens d'être inséré dans la base de données
      $userId = Connect::getInstance()->lastInsertId();
      $user->setId($userId);
      // pour chaque otpions du poll
      for ($i=0; $i < count($user->get()["favorites"]); $i++) {
        $text = $user->get()["favorite"][$i]["name"];
        // on insère une nouvelle option dans la base de données
        $query = Connect::getInstance()->prepare(
          "INSERT INTO favorites(name,user_id) VALUES (:name, :user_id)"
        );
        $query->bindValue(":name", $text);
        $query->bindValue(":user_id", $userId);
        $query->execute();
      }
      $query = Connect::getInstance()->prepare(
        ""
      );
      return $user;
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function getByIdWithFavorites(int $userId){
    try {
      // on récupère les options correspondant à l'id du user passé en paramètre
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM favorites WHERE favorite.user_id = :userId"
      );
      $query->bindValue(":userId", $userId);
      $query->execute();

      $options = [];
      
      while($row = $query->fetch()) {
        // pour chaque favorite, on créé une instance de favorite
        $favorite = new Favorite(
          $row["id"],
          $row["name"]
        );
        // on ajoute ensuite le favorite dans un tableau
        $favorites[] = $favorite;
      }
      // on récupère le user dans la base de données
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM users WHERE user.id = :userId"
      );
      $query->bindValue(":userId", $userId);
      $query->execute();
      $result = $query->fetch();
      // on créé un nouveau user à partir du résultat de la requête et du tableau des favorites
      $user = new User($result["id"], $result["name"], $favorites);

      return $user;
    } catch (Exception $e) {
      echo $e;
    }
  }
}