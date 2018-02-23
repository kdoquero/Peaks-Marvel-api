<?php

namespace simplon\entities;

class Option {
  private $id;
  private $text;
  private $count;

  public function __construct(int $id, string $text, int $count){
    $this->id = $id;
    $this->text = $text;
    $this->count = $count;
  }

  public function get():array {
    return [
      "id" => $this->id,
      "text" => $this->text,
      "count" => $this->count
    ];
  }
}
