<?php
require_once __DIR__ . '/config.php';

$qty = max(1, (int) ($_POST['qty'] ?? 1));
$_SESSION['cart'] = [
    'product' => $product,
    'qty' => $qty
];
header("Location: " . BASE_URL . "/single_product_shop/cart.php");
