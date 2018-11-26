<?
error_reporting(E_STRICT);
session_start();

require($_SERVER['DOCUMENT_ROOT'].'/Cart.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/Product.class.php');

$cart = Cart::factory();
$product = new Product();

if($_GET['action']) {
    if($_GET['name'])
        $item = $product->getItem($_GET['name']);

    switch($_GET['action']) {
        case 'addItem':
            $cart->addItem($item);
        break;
        case 'increaseQuantity':
            $cart->increaseQuantity($item);
        break;
        case 'decreaseQuantity':
            $cart->decreaseQuantity($item);
        break;
        case 'removeItem':
            $cart->removeItem($item);
        break;
        case 'clearCart':
            $cart->clearCart();
        break;
    }
}

$cartItems = $cart->getItems();
$productItems = $product->getItems();

$total = 0;
$quantity = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Ezvet - PHP test - <a href="https://github.com/charles-benedito/ezyVet-test-php" target="_NEW">Github</a></h1>
    <h2>My Cart</h2>
    <? if(count($cartItems)) { ?>
            <ul>
    <?      foreach($cartItems as $item) { 
                $total += $item['price']*$item['quantity'];
                $quantity += $item['quantity']; ?>
                <li>
                    <?=$item['name']?> / Unit Price $<?=number_format($item['price'], 2, '.', '')?> / Quantity <?=$item['quantity']?> / Total $<?=number_format($item['price']*$item['quantity'], 2, '.', '')?><br />
                    <a href="/?action=increaseQuantity&name=<?=$item['name']?>">Increase Quantity</a>&nbsp;
                    <a href="/?action=decreaseQuantity&name=<?=$item['name']?>">Decrease Quantity</a>&nbsp;
                    <a href="/?action=removeItem&name=<?=$item['name']?>">Remove Product</a>
                    <br /><br />
                </li>
    <?      } ?>
            </ul>
            <b>Total: $<?=number_format($total, 2, '.', '')?></b> <small>(<?=$quantity?> products)</small>
            <br />
            <a href="/?action=clearCart">Clear Cart</a>
    <?  } ?>

    <hr />

    <h2>Products</h2>
    <ul>
        <? foreach($productItems as $item) { ?>
            <li>
                <?=$item['name']?> $<?=number_format($item['price'], 2, '.', '')?><br />
                <a href="/?action=addItem&name=<?=$item['name']?>">Add Product</a>
                <br /><br />
            </li>
        <? } ?>
    </ul>

    <script>
        window.history.pushState({}, "/", "/");
    </script>
</body>
</html>
