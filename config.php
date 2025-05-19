<?php
// config.php
declare(strict_types=1);

session_start();

/* ---- EDIT THESE ---- */
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'single_product_shop');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', 'http://localhost'); // adjust when deploying
/* -------------------- */

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    exit("DB connection failed: " . $e->getMessage());
}

// Single product definition (could live in DB – kept simple here)
$product = [
    'id' => 1,
    'name' => 'Super Widget',
    'description' => 'A single must-have widget that solves everything.',
    'price' => 49.99,
    'image' => BASE_URL . '/assets/image.jpeg'
];
