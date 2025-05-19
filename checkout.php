<?php
require_once __DIR__ . '/functions.php';
must_login();                     // must be logged in
$cart = $_SESSION['cart'] ?? null;
if (!$cart) {
    header("Location: cart.php");
    exit;
}
require_once __DIR__ . '/header.php';

$total = $cart['product']['price'] * $cart['qty'];
?>
<h2>Checkout</h2>
<p>Total payable: <strong>$<?= number_format($total, 2) ?></strong></p>

<form action="process_order.php" method="post">
    <fieldset>
        <legend>Shipping address (dummy)</legend>
        <input type="text" name="address" placeholder="Address line 1" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="zip" placeholder="ZIP" required>
    </fieldset>
    <!-- payment fields would go here -->
    <button type="submit" class="primary">Pay &amp; Place Order</button>
</form>
<?php require_once __DIR__ . '/footer.php'; ?>