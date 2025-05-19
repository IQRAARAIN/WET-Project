<?php
require_once __DIR__ . '/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (!$name || !$email || !$pass) {
        $errors[] = "All fields required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email.";
    } else {
        // duplicate?
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch())
            $errors[] = "Email already registered.";
    }

    if (!$errors) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)")
            ->execute([$name, $email, $hash]);
        header("Location: login.php?registered=1");
        exit;
    }
}

require_once __DIR__ . '/header.php'; ?>
<h2>Create Account</h2>
<?php foreach ($errors as $e)
    echo "<div class='card error'>" . e($e) . "</div>"; ?>
<form method="post">
    <input type="text" name="name" placeholder="Full name" required value="<?= e($_POST['name'] ?? '') ?>">
    <input type="email" name="email" placeholder="Email" required value="<?= e($_POST['email'] ?? '') ?>">
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="primary">Register</button>
</form>
<p>Have an account? <a href="login.php">Login</a></p>
<?php require_once __DIR__ . '/footer.php'; ?>