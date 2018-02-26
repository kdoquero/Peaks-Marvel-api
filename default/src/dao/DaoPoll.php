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
      return true;
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function getByIdWithOptions(int $pollId){
    try {
      $query = Connect::getInstance()->prepare(
        "SELECT * FROM options WHERE options.poll_id = :pollId"
      );
      $query->bindValue(":pollId", $pollId);
      $query->execute();

      $options = [];
      
      while($row = $query->fetch()) {
        $option = new Option(
          $row["id"],
          $row["text"],
          $row["count"]
        );

        $options[] = $option;
      }

      $query = Connect::getInstance()->prepare(
        "SELECT * FROM polls WHERE polls.id = :pollId"
      );

      $query->bindValue(":pollId", $pollId);
      $query->execute();

      $result = $query->fetch();
      $poll = new Poll($result["id"], $result["title"], $options);

      return $poll;
    } catch (Exception $e) {
      echo $e;
    }
  }
}