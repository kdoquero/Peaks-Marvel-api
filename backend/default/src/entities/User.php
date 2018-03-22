<?php 
namespace simplon\entities;

class User {
    private $id;
    private $name;
    private $favorites;

    public function __construct(int $id, string $name, array $favorites){
        $this->id = $id;
        $this->name = $name;
        $this->favorites = $favorites;    
    }

    

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId(int $id)
        {
                $this->id = $id;

                return $this;
        }

        public function get():array{
            $favorites = [];
            // on fait appel à la méthode get de chaque favorite d'un user
            foreach ($this->favorites as $key => $favorite) {
              $favorites[] = $favorite->get();
            }
            // on retourne un tableau PHP avec les données du user
            return [
              "id" => $this->id,
              "name" => $this->name,
              "favorites" => $favorites
            ];
          }
}

?>