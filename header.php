<?php
// header.php
require_once __DIR__ . '/functions.php';
$user = current_user();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Single Product Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/4.3.0/mini-default.min.css">
    <style>
        .center {
            text-align: center;
        }

        .img-200 {
            max-width: 200px;
        }
    </style>
</head>

<body>
    <header class="sticky">
        <a href="<?= BASE_URL ?>/single_product_shop" class="logo">Widget Store</a>
        <a href="<?= BASE_URL ?>/single_product_shop/cart.php">🛒 Cart

            <?php if (!empty($_SESSION['cart']['qty'])): ?>
                (<strong><?= e((string) $_SESSION['cart']['qty']) ?></strong>)
            <?php endif; ?>
        </a>
        <?php if ($user): ?>
            <span>Hello, <?= e($user['name']) ?></span>
            <a href="<?= BASE_URL ?>/single_product_shop/logout.php">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/single_product_shop/login.php">Login</a>
        <?php endif; ?>
    </header>
    <main class="container">