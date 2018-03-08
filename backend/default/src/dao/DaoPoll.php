<?php

namespace simplon\dao;
use simplon\entities\Poll;
use simplon\entities\Option;
use simplon\dao\Connect;
use simplon\dao\DaoOption;

class DaoPoll {
  public function addWithOptions(Poll $poll){
    try {
      // on créé un nouveau poll dans la base de données
      $query = Connect::getInstance()->prepare(
        "INSERT INTO polls(title) VALUES (:title)"
      );
      // pour cela, on passe le contenu du champ title de notre poll
      $query->bindValue(":title", $poll->get()["title"]);
      $query->execute();
      // on récupère l'id du poll qui viens d'être inséré dans la base de données
      $pollId = Connect::getInstance()->lastInsertId();
      $poll->setId($pollId);
      // pour chaque otpions du poll
      for ($i=0; $i < count($poll->get()["options"]); $i++) {
        $text = $poll->get()["options"][$i]["text"];
        // on insère une nouvelle option dans la base de données
        $query = Connect::getInstance()->prepare(
          "INSERT INTO options(text, count, poll_id) VALUES (:text, 0, :poll_id)"
        );
        $query->bindValue(":text", $text);
        $query->bindValue(":poll_id", $pollId);
        $query->execute();
      }
      $query = Connect::getInstance()->prepare(
        ""
      );
      return $poll;
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function getByIdWithOptions(int $pollId){
    try {
      // on récupère les options correspondant à l'id du poll passé en paramètre
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM options WHERE options.poll_id = :pollId"
      );
      $query->bindValue(":pollId", $pollId);
      $query->execute();

      $options = [];
      
      while($row = $query->fetch()) {
        // pour chaque option, on créé une instance de option
        $option = new Option(
          $row["id"],
          $row["text"],
          $row["count"]
        );
        // on ajoute ensuite l'option dans un tableau
        $options[] = $option;
      }
      // on récupère le poll dans la base de données
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM polls WHERE polls.id = :pollId"
      );
      $query->bindValue(":pollId", $pollId);
      $query->execute();
      $result = $query->fetch();
      // on créé un nouveau poll à partir du résultat de la requête et du tableau des options
      $poll = new Poll($result["id"], $result["title"], $options);

      return $poll;
    } catch (Exception $e) {
      echo $e;
    }
  }
}