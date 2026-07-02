<?php
require_once __DIR__ . '/includes/auth_check.php';
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$pdo = getDbConnection();
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

$stmt = $pdo->prepare('DELETE FROM games WHERE id = :id');
$stmt->execute(['id' => $id]);

$_SESSION['flash'] = $stmt->rowCount() > 0
    ? ['type' => 'success', 'message' => 'Game berhasil dihapus.']
    : ['type' => 'error', 'message' => 'Game tidak ditemukan atau sudah dihapus.'];

header('Location: index.php');
exit;
