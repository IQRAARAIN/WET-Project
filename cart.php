<?php
require_once __DIR__ . '/header.php';

$cart = $_SESSION['cart'] ?? null;
if (!$cart):
    echo "<h2>Your cart is empty 🙂</h2>";
    require_once __DIR__ . '/footer.php';
    exit;
endif;

$total = $cart['product']['price'] * $cart['qty'];
?>
<h2>Your Cart</h2>

<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
    <tr>
        <td><?= e($cart['product']['name']) ?></td>
        <td>$<?= number_format($cart['product']['price'], 2) ?></td>
        <td><?= e((string) $cart['qty']) ?></td>
        <td>$<?= number_format($total, 2) ?></td>
    </tr>
</table>

<form action="add_to_cart.php" method="post">
    <label>Update quantity:</label>
    <input type="number" name="qty" value="<?= e((string) $cart['qty']) ?>" min="1" style="width:4rem">
    <button type="submit">Update</button>
</form>

<p><a href="checkout.php" class="button primary">Proceed to Checkout</a></p>
<?php require_once __DIR__ . '/footer.php'; ?>