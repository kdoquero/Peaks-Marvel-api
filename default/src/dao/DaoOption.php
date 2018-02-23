<?php

namespace simplon\dao;
use simplon\entities\Option;
use simplon\dao\Connect;

class DaoOption {
  public function vote(int $optionId){
    try {
      $query = Connect::getInstance()->prepare(
        "UPDATE options SET count = count + 1 WHERE id = :id"
      );
      $query->bindValue(":id", $optionId);
      $query->execute();

      $query = Connect::getInstance()->prepare(
        "SELECT * FROM options WHERE id = :id"
      );
      $query->bindValue(":id", $optionId);
      $query->execute();

      $option = $query->fetch();
      return new Option($option["id"], $option["text"], $option["count"]);
      
    } catch (Exception $e) {
      echo $e;
    }
  }
}