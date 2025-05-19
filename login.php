<?php
require_once __DIR__ . '/functions.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $redirect = $_GET['next'] ?? 'index.php';
        header("Location: " . $redirect);
        exit;
    }
    $errors[] = "Invalid credentials.";
}

require_once __DIR__ . '/header.php'; ?>
<h2>Login</h2>
<?php if (!empty($_GET['registered'])): ?>
    <div class="card success">Registration successful. You can log in now.</div>
<?php endif; ?>
<?php foreach ($errors as $e)
    echo "<div class='card error'>" . e($e) . "</div>"; ?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="primary">Login</button>
</form>
<p>No account? <a href="register.php">Register</a></p>
<?php require_once __DIR__ . '/footer.php'; ?>