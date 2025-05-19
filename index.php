<?php require_once __DIR__ . '/header.php'; ?>
<section class="center">
    <h1><?= e($product['name']) ?></h1>
    <img src="assets/image.jpeg" alt="Widget photo" class="img-200">
    <p><?= e($product['description']) ?></p>
    <p><strong>$<?= number_format($product['price'], 2) ?></strong></p>

    <form action="add_to_cart.php" method="post" style="display:inline-block">
        <input type="number" name="qty" value="1" min="1" style="width:4rem">
        <button type="submit">Add to Cart</button>
    </form>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>