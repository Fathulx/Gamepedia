<?php
require_once __DIR__ . '/includes/auth_check.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

$errors = [];
$input = [
    'nama_game'   => '',
    'tahun'       => '',
    'ranking'     => '',
    'genre'       => '',
    'developer'   => '',
    'publisher'   => '',
    'platform'    => '',
    'deskripsi'   => '',
    'gambar_url'  => '',
    'rating'      => '',
    'trailer_url' => '',
    'harga'       => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($input as $key => $_) {
        $input[$key] = trim($_POST[$key] ?? '');
    }

    // Validasi dasar
    if ($input['nama_game'] === '') $errors[] = 'Nama game wajib diisi.';
    if ($input['tahun'] === '' || $input['tahun'] < 2020 || $input['tahun'] > 2025) $errors[] = 'Tahun harus antara 2020-2025.';
    if ($input['ranking'] === '' || $input['ranking'] < 1 || $input['ranking'] > 10) $errors[] = 'Ranking harus antara 1-10.';
    if ($input['genre'] === '') $errors[] = 'Genre wajib diisi.';
    if ($input['developer'] === '') $errors[] = 'Developer wajib diisi.';
    if ($input['publisher'] === '') $errors[] = 'Publisher wajib diisi.';
    if ($input['platform'] === '') $errors[] = 'Platform wajib diisi.';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO games
                (nama_game, tahun, ranking, genre, developer, publisher, platform, deskripsi, gambar_url, rating, trailer_url, harga)
                VALUES
                (:nama_game, :tahun, :ranking, :genre, :developer, :publisher, :platform, :deskripsi, :gambar_url, :rating, :trailer_url, :harga)');

            $stmt->execute([
                'nama_game'   => $input['nama_game'],
                'tahun'       => (int) $input['tahun'],
                'ranking'     => (int) $input['ranking'],
                'genre'       => $input['genre'],
                'developer'   => $input['developer'],
                'publisher'   => $input['publisher'],
                'platform'    => $input['platform'],
                'deskripsi'   => $input['deskripsi'] ?: null,
                'gambar_url'  => $input['gambar_url'] ?: null,
                'rating'      => $input['rating'] !== '' ? (float) $input['rating'] : null,
                'trailer_url' => $input['trailer_url'] ?: null,
                'harga'       => $input['harga'] !== '' ? (float) $input['harga'] : null,
            ]);

            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Game baru berhasil ditambahkan.'];
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $errors[] = 'Ranking tersebut sudah dipakai game lain di tahun yang sama. Gunakan ranking berbeda.';
            } else {
                $errors[] = 'Terjadi kesalahan saat menyimpan data.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Game | Dashboard Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="../assets/gamepedia-icon.svg">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f7f5f2;
    }
    .font-display {
        font-family: 'Sora', sans-serif;
    }
    .form-input:focus {
        border-color: #1e293b;
        box-shadow: 0 0 0 2px #1e293b;
        outline: none;

    }
    .btn-primary {
        transition: all 0.15s ease;
    }
    .btn-primary:hover {
        transform: scale(1.02);
    }
    .img-preview {
        transition: all 0.2s ease;
    }
    .img-preview:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 25px -8px rgba(0,0,0,0.2);
    }
</style>
</head>
<body class="min-h-screen text-stone-800">

<!-- ========================================== -->
<!-- NAVBAR - SAMA PERSIS DENGAN INDEX PUBLIC   -->
<!-- ========================================== -->
<header class="border-b border-stone-200 bg-[#f7f5f2]/90 backdrop-blur sticky top-0 z-20">
    <div class="max-w-4xl mx-auto px-5 py-5 flex items-center justify-between">
        <h1 class="font-display text-xl md:text-2xl font-extrabold tracking-tight text-stone-900 flex items-center gap-2">
            <img src="../assets/gamepedia-icon.svg" alt="Gamepedia" class="w-7 h-7 md:w-8 md:h-8">
            Tambah Game
        </h1>
        <div class="flex items-center gap-4">
            <span class="text-xs md:text-sm text-stone-500 font-medium">
                <i class="fas fa-user-circle mr-1"></i> 
                <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?>
            </span>
            <a href="index.php" class="text-xs md:text-sm text-stone-500 hover:text-stone-900 transition flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</header>

<!-- ========================================== -->
<!-- MAIN CONTENT                              -->
<!-- ========================================== -->
<main class="max-w-4xl mx-auto px-5 py-8">

    <!-- Error Message -->
    <?php if (!empty($errors)): ?>
        <div class="mb-6 text-sm rounded-xl px-5 py-3 border-l-4 shadow-sm bg-red-50 text-red-800 border-red-500">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <ul class="list-disc list-inside space-y-0.5">
                <?php foreach ($errors as $err): ?><li><?= htmlspecialchars($err) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="bg-white border border-stone-200 rounded-xl shadow-sm overflow-hidden">
        <div class="border-b border-stone-200 px-6 py-4 bg-stone-50/80 flex items-center gap-3">
            <i class="fas fa-pen text-stone-500"></i>
            <span class="text-sm font-medium text-stone-700">Formulir Tambah Game Baru</span>
            <span class="ml-auto text-xs text-stone-400"><i class="fas fa-asterisk text-red-400 text-[10px]"></i> wajib diisi</span>
        </div>

        <form method="POST" class="p-6 space-y-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Nama Game -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-tag mr-1 text-stone-400"></i> Nama Game <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_game" value="<?= htmlspecialchars($input['nama_game']) ?>" required
                        class="form-input w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-calendar-alt mr-1 text-stone-400"></i> Tahun <span class="text-red-500">*</span>
                    </label>
                    <select name="tahun" required
                            class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                        <option value="">Pilih tahun</option>
                        <?php foreach ([2020,2021,2022,2023,2024,2025] as $t): ?>
                            <option value="<?= $t ?>" <?= (string) $input['tahun'] === (string) $t ? 'selected' : '' ?>><?= $t ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Ranking -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-hashtag mr-1 text-stone-400"></i> Ranking (1-10) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="1" max="10" name="ranking" value="<?= htmlspecialchars($input['ranking']) ?>" required
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Genre -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-film mr-1 text-stone-400"></i> Genre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="genre" value="<?= htmlspecialchars($input['genre']) ?>" required
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Developer -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-code mr-1 text-stone-400"></i> Developer <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="developer" value="<?= htmlspecialchars($input['developer']) ?>" required
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Publisher -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-building mr-1 text-stone-400"></i> Publisher <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="publisher" value="<?= htmlspecialchars($input['publisher']) ?>" required
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Platform -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-desktop mr-1 text-stone-400"></i> Platform <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="platform" value="<?= htmlspecialchars($input['platform']) ?>" placeholder="Contoh: PC, PS5, Xbox" required
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-align-left mr-1 text-stone-400"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                            class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition"><?= htmlspecialchars($input['deskripsi']) ?></textarea>
                </div>

                <!-- Gambar URL -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-image mr-1 text-stone-400"></i> URL Gambar
                    </label>
                    <input type="text" name="gambar_url" value="<?= htmlspecialchars($input['gambar_url']) ?>" placeholder="https://..."
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                    <?php if (!empty($input['gambar_url'])): ?>
                        <div class="mt-3">
                            <img src="<?= htmlspecialchars($input['gambar_url']) ?>" alt="Preview" 
                                class="img-preview h-32 rounded-lg border border-stone-200 object-cover shadow-sm">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Trailer URL -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-video mr-1 text-stone-400"></i> URL Trailer (YouTube)
                    </label>
                    <input type="text" name="trailer_url" value="<?= htmlspecialchars($input['trailer_url']) ?>" placeholder="https://youtube.com/watch?v=..."
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-star mr-1 text-stone-400"></i> Rating (0-10)
                    </label>
                    <input type="number" step="0.1" min="0" max="10" name="rating" value="<?= htmlspecialchars($input['rating']) ?>"
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">
                        <i class="fas fa-money-bill-wave mr-1 text-stone-400"></i> Harga (Rp)
                    </label>
                    <input type="number" step="1000" min="0" name="harga" value="<?= htmlspecialchars($input['harga']) ?>"
                        class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-transparent transition">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-wrap gap-3 pt-4 border-t border-stone-200">
                <button type="submit" class="btn-primary bg-stone-800 hover:bg-stone-900 text-white text-sm font-semibold px-6 py-2.5 rounded-lg shadow-sm transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Game
                </button>
                <a href="index.php" class="bg-white border border-stone-300 hover:bg-stone-50 text-stone-700 text-sm font-medium px-6 py-2.5 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </form>
    </div>

    <!-- Info Tambahan -->
    <div class="mt-4 text-xs text-stone-400 flex items-center justify-between">
        <span><i class="fas fa-info-circle mr-1"></i> Field bertanda <span class="text-red-500">*</span> wajib diisi</span>
        <span><i class="fas fa-clock mr-1"></i> <?= date('d M Y H:i') ?></span>
    </div>

</main>

</body>
</html>