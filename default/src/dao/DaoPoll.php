<?php

namespace simplon\dao;
use simplon\entities\Poll;
use simplon\entities\Option;
use simplon\dao\Connect;
use simplon\dao\DaoOption;

class DaoPoll {
  public function addWithOptions(Poll $poll){
    try {
      $query = Connect::getInstance()->prepare(
        "INSERT INTO polls(title) VALUES (:title)"
      );
      $query->bindValue(":title", $poll->get()["title"]);
      $query->execute();

      $pollId = Connect::getInstance()->lastInsertId();

      for ($i=0; $i < count($poll->get()["options"]); $i++) {
        $text = $poll->get()["options"][$i]["text"];

        $query = Connect::getInstance()->prepare(
          "INSERT INTO options(text, count, poll_id) VALUES (:text, 0, :poll_id)"
        );
        $query->bindValue(":text", $text);
        $query->bindValue(":poll_id", $pollId);
        $query->execute();
      }

    } catch (Exception $e) {
      echo $e;
    }
  }
  //   try {
  //   $query = Connect::getInstance()->prepare(
  //     "UPDATE options SET count = count + 1 WHERE id = :id"
  //   );
  //   $query->bindValue(":id", $optionId);
  //   $query->execute();

  //   $query = Connect::getInstance()->prepare(
  //     "SELECT * FROM options WHERE id = :id"
  //   );
  //   $query->bindValue(":id", $optionId);
  //   $query->execute();

  //   $option = $query->fetch();
  //   return new Option($option["id"], $option["text"], $option["count"]);
    
  // } catch (Exception $e) {
  //   echo $e;
  // }
}