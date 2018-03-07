<?php

namespace simplon\dao;
use simplon\entities\Option;
use simplon\dao\Connect;

class DaoOption {
  public function vote(int $optionId){
    try {
      // on incrémente le champ count de la table options
      $query = Connect::getInstance()->prepare(
        "UPDATE options SET count = count + 1 WHERE id = :id"
      );
      // ... à partir de l'id qui à été passé en paramètre
      $query->bindValue(":id", $optionId);
      $query->execute();
      // on sélectionne ensuite l'option fraichement modifiée
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM options WHERE id = :id"
      );
      // ... toujours à partir de l'id qui à été passé en paramètre
      $query->bindValue(":id", $optionId);
      $query->execute();
      // on récupère le résultat de la requête
      $option = $query->fetch();
      // on retourne une instance de Option construite à partir du résultat de la requête
      return new Option($option["id"], $option["text"], $option["count"]);
      
    } catch (Exception $e) {
      echo $e;
    }
  }
}