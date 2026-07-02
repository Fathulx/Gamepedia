<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==========================================================
// Kredensial admin (hardcoded, sesuai kesepakatan tugas).
// Silakan ganti sebelum deploy ke publik.
// ==========================================================
const ADMIN_USERNAME = 'admin';
const ADMIN_PASSWORD = 'admin123';

$error = '';

// Kalau sudah login, langsung ke dashboard
if (!empty($_SESSION['is_admin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['is_admin'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: index.php');
        exit;
    }

    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin | TopGame</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <h1 class="text-xl font-bold text-slate-800 mb-1">Admin Dashboard</h1>
        <p class="text-sm text-slate-500 mb-6">Masuk untuk mengelola data game.</p>

        <?php if ($error): ?>
            <div class="mb-4 text-sm bg-red-50 text-red-700 border border-red-200 rounded-md px-3 py-2">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                <input type="text" name="username" required autofocus
                       class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-800">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-800">
            </div>
            <button type="submit"
                    class="w-full bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold py-2.5 rounded-md transition-colors">
                Masuk
            </button>
        </form>

        <a href="../public/index.php" class="block text-center text-xs text-slate-400 hover:text-slate-600 mt-6">&larr; Kembali ke halaman utama</a>
    </div>

</body>
</html>
