<?
class Cart {
    private $items;

    public function getItems() {
        return $this->items ? $this->items : Array();
    }

    public function addItem($item) {
        if(@$this->items[$item["name"]])
            $this->items[$item["name"]]["quantity"] += 1;
        else {
            $item["quantity"] = 1;
            $this->items[$item["name"]] = $item;
        }
    }

    public function increaseQuantity($item) {
        $this->items[$item["name"]]["quantity"] += 1;
    }

    public function decreaseQuantity($item) {
        $this->items[$item["name"]]["quantity"] -= 1;
        if($this->items[$item["name"]]["quantity"] === 0)
            $this->removeItem($item);
    }

    public function removeItem($item) {
        unset($this->items[$item["name"]]);
    }

    public function clearCart() {
        $this->items = Array();
    }

    public static function factory() {
        if(isset($_SESSION["Cart"]) === true)
            return unserialize($_SESSION["Cart"]);
        return new Cart();
    }

    public function __destruct() {
        $_SESSION["Cart"] = serialize($this);
    }
}
