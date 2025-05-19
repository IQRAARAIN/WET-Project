<?php
require_once __DIR__ . '/functions.php';
must_login();

$cart = $_SESSION['cart'] ?? null;
if (!$cart) {
    header("Location: cart.php");
    exit;
}

$pdo->beginTransaction();
try {
    // 1. create order
    $total = $cart['product']['price'] * $cart['qty'];
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $total]);
    $order_id = (int) $pdo->lastInsertId();

    // 2. order item
    $item = $cart['product'];
    $stmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product, price, qty)
        VALUES (?,?,?,?)
    ");
    $stmt->execute([
        $order_id,
        $item['name'],
        $item['price'],
        $cart['qty']
    ]);

    $pdo->commit();
    unset($_SESSION['cart']);      // clear cart

    header("Location: " . BASE_URL . "/index.php?thanks=1");
} catch (Throwable $e) {
    $pdo->rollBack();
    exit("Order failed: " . $e->getMessage());
}
