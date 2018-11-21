<?
class Product {
    public function __construct(){}

    public function getItems() {
        return array( // why i cant have an id? :(
            array("name" => "Sledgehammer", "price" => 125.75), 
            array("name" => "Axe", "price" => 190.50), 
            array("name" => "Bandsaw", "price" => 562.13), 
            array("name" => "Chisel", "price" => 12.9), 
            array("name" => "Hacksaw", "price" => 18.45)
        );
    }

    public function getItem($name) {
        foreach($this->getItems() as $item)
            if($item["name"] === $name)
                return $item;
    }    
   
}
