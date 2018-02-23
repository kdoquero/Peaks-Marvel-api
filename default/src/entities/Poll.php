<?php

namespace simplon\entities;

class Poll {
  private $id;
  private $title;
  private $options;

  public function __construct(int $id, string $title, array $options){
    $this->id = $id;
    $this->title = $title;
    $this->options = $options;    
  }

  public function get():array{
    return [
      "id" => $this->id,
      "title" => $this->title,
      "options" => $this->options
    ];
  }
}
