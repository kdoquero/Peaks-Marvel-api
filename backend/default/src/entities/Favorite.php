<?php

namespace simplon\entities;

class Favorite {
  private $id;
  private $name;

  public function __construct(int $id, string $name){
    $this->id = $id;
    $this->text = $name;
  }
  // la méthode get retourne un tableau php contenant les données d'un favori
  public function get():array {
    return [
      "id" => $this->id,
      "name" => $this->name,
    ];
  }
}