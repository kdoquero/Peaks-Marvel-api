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
  // la méthode get retourne un tableau contenant les données d'un poll
  public function get():array{
    $options = [];
    // on fait appel à la méthode get de chaque option d'un poll
    foreach ($this->options as $key => $option) {
      $options[] = $option->get();
    }
    // on retourne un tableau PHP avec les données du poll
    return [
      "id" => $this->id,
      "title" => $this->title,
      "options" => $options
    ];
  }
}
