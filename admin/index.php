<?php
require_once __DIR__ . '/includes/auth_check.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

// Ambil filter tahun
$filterTahun = isset($_GET['tahun']) && $_GET['tahun'] !== '' ? (int) $_GET['tahun'] : null;

// Ambil data game
if ($filterTahun) {
    $stmt = $pdo->prepare('SELECT * FROM games WHERE tahun = :tahun ORDER BY ranking ASC');
    $stmt->execute(['tahun' => $filterTahun]);
    $games = $stmt->fetchAll();
    $gamesByYear = [$filterTahun => $games];
} else {
    $stmt = $pdo->query('SELECT * FROM games ORDER BY tahun DESC, ranking ASC');
    $games = $stmt->fetchAll();
    $gamesByYear = [];
    foreach ($games as $g) {
        $gamesByYear[$g['tahun']][] = $g;
    }
    krsort($gamesByYear);
}

// Statistik
$totalGames = count($games);
$totalTahun = count($gamesByYear);
$topRating = $games ? max(array_column($games, 'rating')) : null;
$topGame = null;
if ($games && $topRating !== null) {
    foreach ($games as $g) {
        if ($g['rating'] == $topRating) {
            $topGame = $g;
            break;
        }
    }
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$tahunList = [2020, 2021, 2022, 2023, 2024, 2025];
$filterLabel = $filterTahun ? $filterTahun : 'Semua';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Gamepedia</title>
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
        .stat-card {
            transition: all 0.2s ease;
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
            padding: 1.25rem;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -12px rgba(20,20,20,0.18);
            border-color: #d97757;
        }
        .badge-rank {
            background: #1c1c1c;
            color: white;
            padding: 2px 10px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .table-row:hover {
            background-color: #f8fafc;
        }
        .btn-action {
            transition: all 0.15s ease;
        }
        .btn-action:hover {
            transform: scale(1.02);
        }
        .year-heading {
            background: #f1f5f9;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            color: #1e293b;
        }
        .table-container {
            margin-bottom: 2rem;
        }
        .table-container:last-child {
            margin-bottom: 0;
        }
        /* Dropdown filter */
        .filter-dropdown {
            position: relative;
            display: inline-block;
        }
        .filter-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid #e5e5e5;
            background: white;
            color: #4a4a4a;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-dropdown-btn:hover {
            border-color: #d97757;
            color: #1c1c1c;
        }
        .filter-dropdown-menu {
            position: absolute;
            left: 0;
            margin-top: 0.5rem;
            width: 140px;
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            z-index: 10;
            overflow: hidden;
            display: none;
        }
        .filter-dropdown-menu.open {
            display: block;
        }
        .filter-dropdown-menu a {
            display: block;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #4a4a4a;
            text-decoration: none;
            transition: background 0.15s;
        }
        .filter-dropdown-menu a:hover {
            background: #f1f5f9;
        }
        .filter-dropdown-menu a.active {
            background: #1c1c1c;
            color: white;
        }
    </style>
</head>
<body class="min-h-screen text-stone-800">

<!-- ========================================== -->
<!-- NAVBAR - SAMA PERSIS DENGAN INDEX PUBLIC   -->
<!-- ========================================== -->
<header class="border-b border-stone-200 bg-[#f7f5f2]/90 backdrop-blur sticky top-0 z-20">
    <div class="max-w-6xl mx-auto px-5 py-5 flex items-center justify-between">
        <h1 class="font-display text-xl md:text-2xl font-extrabold tracking-tight text-stone-900 flex items-center gap-2">
            <img src="../assets/gamepedia-icon.svg" alt="Gamepedia" class="w-7 h-7 md:w-8 md:h-8">
            Dashboard Admin
        </h1>
        <div class="flex items-center gap-4">
            <span class="text-xs md:text-sm text-stone-500 font-medium">
                <i class="fas fa-user-circle mr-1"></i> 
                <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?>
            </span>
            <a href="../public/index.php" target="_blank" class="text-xs md:text-sm text-stone-500 hover:text-stone-900 transition flex items-center gap-1">
                <i class="fas fa-external-link-alt"></i> Situs
            </a>
            <a href="logout.php" class="text-xs md:text-sm bg-stone-200 hover:bg-stone-300 text-stone-700 px-3 py-1.5 rounded-full transition">
                <i class="fas fa-sign-out-alt mr-1"></i> Logout
            </a>
        </div>
    </div>
</header>

<!-- ========================================== -->
<!-- MAIN CONTENT                              -->
<!-- ========================================== -->
<main class="max-w-6xl mx-auto px-5 py-8">

    <!-- Flash Message -->
    <?php if ($flash): ?>
        <div class="mb-6 text-sm rounded-xl px-5 py-3 border-l-4 shadow-sm
            <?= $flash['type'] === 'success' 
                ? 'bg-green-50 text-green-800 border-green-500' 
                : 'bg-red-50 text-red-800 border-red-500' ?>">
            <i class="fas <?= $flash['type'] === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?> mr-2"></i>
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- Statistik Cards - BERWARNA -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-stone-400 font-medium uppercase tracking-wider">Total Game</p>
                    <p class="text-2xl font-bold text-stone-800 mt-1"><?= $totalGames ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                    <i class="fas fa-gamepad text-lg"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-stone-400 font-medium uppercase tracking-wider">Tahun Aktif</p>
                    <p class="text-2xl font-bold text-stone-800 mt-1"><?= $totalTahun ?></p>
                </div>
                <div class="w-10 h-10 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                    <i class="fas fa-calendar-alt text-lg"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-stone-400 font-medium uppercase tracking-wider">Rating Tertinggi</p>
                    <p class="text-2xl font-bold text-stone-800 mt-1">
                        <?= $topRating !== null ? number_format($topRating, 1) : '-' ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600">
                    <i class="fas fa-star text-lg"></i>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-stone-400 font-medium uppercase tracking-wider">Game Terbaik</p>
                    <p class="text-sm font-semibold text-stone-800 mt-1 truncate max-w-[120px]">
                        <?= $topGame ? htmlspecialchars($topGame['nama_game']) : '-' ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                    <i class="fas fa-trophy text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Tombol Tambah -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <span class="text-sm text-stone-500 font-medium"><i class="fas fa-filter mr-1"></i> Filter:</span>

            <!-- DROPDOWN FILTER -->
            <div class="filter-dropdown" id="filterDropdown">
                <button class="filter-dropdown-btn" onclick="toggleFilterDropdown()">
                    <span id="filterLabel"><?= $filterLabel ?></span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="filter-dropdown-menu" id="filterMenu">
                    <a href="index.php" class="<?= !$filterTahun ? 'active' : '' ?>">Semua</a>
                    <?php foreach ($tahunList as $t): ?>
                        <a href="index.php?tahun=<?= $t ?>" class="<?= $filterTahun === $t ? 'active' : '' ?>"><?= $t ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <a href="add.php" class="bg-stone-900 hover:bg-[#d97757] text-white text-sm font-semibold px-5 py-2.5 rounded-full transition flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Game
        </a>
    </div>

    <!-- Tabel Data - Kelompok per Tahun -->
    <?php if (empty($gamesByYear)): ?>
        <div class="bg-white border border-stone-200 rounded-xl shadow-sm p-12 text-center text-stone-400">
            <i class="fas fa-inbox text-4xl block mb-3"></i>
            Belum ada data game.
        </div>
    <?php else: ?>
        <?php foreach ($gamesByYear as $tahun => $gamesTahun): ?>
            <div class="table-container">
                <!-- Heading Tahun -->
                <div class="flex items-center gap-3 mb-3">
                    <span class="year-heading">
                        <i class="fas fa-calendar-alt mr-2"></i> Tahun <?= $tahun ?>
                    </span>
                    <span class="text-xs text-stone-400 bg-stone-100 px-2 py-0.5 rounded-full">
                        <?= count($gamesTahun) ?> game
                    </span>
                </div>

                <!-- Tabel per Tahun -->
                <div class="bg-white border border-stone-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-stone-50 border-b border-stone-200 text-stone-500 text-left">
                                <tr>
                                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Rank</th>
                                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Nama Game</th>
                                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Genre</th>
                                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Rating</th>
                                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                <?php foreach ($gamesTahun as $g): ?>
                                <tr class="table-row transition">
                                    <td class="px-5 py-3.5 text-stone-700">
                                        <span class="badge-rank">#<?= (int) $g['ranking'] ?></span>
                                    </td>
                                    <td class="px-5 py-3.5 font-medium text-stone-800">
                                        <?= htmlspecialchars($g['nama_game']) ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-stone-600">
                                        <?= htmlspecialchars($g['genre']) ?>
                                    </td>
                                    <td class="px-5 py-3.5 text-stone-700">
                                        <?php if ($g['rating'] !== null): ?>
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <?= number_format((float) $g['rating'], 1) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-stone-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="flex justify-end gap-2">
                                            <a href="edit.php?id=<?= (int) $g['id'] ?>" 
                                               class="btn-action text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="delete.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus &quot;<?= htmlspecialchars(addslashes($g['nama_game'])) ?>&quot;?');">
                                                <input type="hidden" name="id" value="<?= (int) $g['id'] ?>">
                                                <button type="submit" class="btn-action text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Footer Info -->
    <div class="flex flex-wrap items-center justify-between mt-6 text-xs text-stone-400">
        <span><i class="fas fa-database mr-1"></i> Total: <?= $totalGames ?> game dari <?= $totalTahun ?> tahun</span>
        <span><i class="fas fa-clock mr-1"></i> Terakhir diperbarui: <?= date('d M Y H:i') ?></span>
    </div>

</main>

<!-- Script untuk toggle dropdown -->
<script>
    function toggleFilterDropdown() {
        const menu = document.getElementById('filterMenu');
        menu.classList.toggle('open');
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('filterDropdown');
        if (!dropdown.contains(event.target)) {
            document.getElementById('filterMenu').classList.remove('open');
        }
    });
</script>

</body>
</html>