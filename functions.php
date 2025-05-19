<?php
// functions.php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

/**
 * Return logged-in user row or null.
 */
function current_user(): ?array
{
    global $pdo;
    if (!empty($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    return null;
}

/**
 * Ensure user is logged in; otherwise redirect.
 */
function must_login(): void
{
    if (!current_user()) {
        header("Location: " . BASE_URL . "/login.php?next=" . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}

/**
 * Tiny helper to sanitize output.
 */
function e(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
