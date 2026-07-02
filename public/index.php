<?php
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

$tahunTersedia = [2020, 2021, 2022, 2023, 2024, 2025];
$tahunDefault = max($tahunTersedia);

$tahunAktif = isset($_GET['tahun']) ? (int) $_GET['tahun'] : $tahunDefault;
if (!in_array($tahunAktif, $tahunTersedia, true)) {
    $tahunAktif = $tahunDefault;
}

$stmt = $pdo->prepare('SELECT id, nama_game, tahun, ranking, gambar_url FROM games WHERE tahun = :tahun ORDER BY ranking ASC');
$stmt->execute(['tahun' => $tahunAktif]);
$games = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gamepedia | Top 10 Game Tahunan 2020-2025</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="../assets/gamepedia-icon.svg">
<style>
    body { font-family: 'Inter', sans-serif; background: #f7f5f2; }
    .font-display { font-family: 'Sora', sans-serif; }
    .card-hover {
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -12px rgba(20,20,20,0.18);
        border-color: #d97757;
    }
    .rank-badge {
        background: #1c1c1c;
    }
    .game-name {
        font-weight: 600;
        font-size: 0.875rem;
        line-height: 1.3;
        color: #1c1c1c;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        min-height: 2.5rem;
        max-height: 3.5rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    @media (min-width: 768px) {
        .game-name {
            font-size: 1rem;
        }
    }
    .game-name:hover {
        color: #d97757;
    }
</style>
</head>
<body class="min-h-screen text-stone-800">

<header class="border-b border-stone-200 bg-[#f7f5f2]/90 backdrop-blur sticky top-0 z-20">
    <div class="max-w-6xl mx-auto px-5 py-5 flex items-center justify-between">
        <h1 class="font-display text-xl md:text-2xl font-extrabold tracking-tight text-stone-900 flex items-center gap-2">
            <img src="../assets/gamepedia-icon.svg" alt="Gamepedia" class="w-7 h-7 md:w-8 md:h-8">
            Gamepedia
        </h1>
        <span class="text-xs md:text-sm text-stone-500 font-medium">Peringkat Game Terbaik 2020&ndash;2025</span>
    </div>
</header>

<main class="max-w-6xl mx-auto px-5 pt-20 pb-10">

    <section class="text-center mb-10">
        <h2 class="font-display text-3xl md:text-5xl font-extrabold leading-tight text-stone-900">
            Top 10 Game Terbaik<br class="md:hidden"> Setiap Tahun
        </h2>
        <p class="text-stone-500 mt-3 max-w-xl mx-auto text-sm md:text-base">
            Pilih tahun untuk melihat 10 game dengan peringkat terbaik. Klik salah satu game untuk melihat detail lengkapnya.
        </p>
    </section>

    <!-- Pilihan Tahun -->
    <nav class="flex flex-wrap justify-center gap-2 md:gap-3 mb-10">
        <?php foreach ($tahunTersedia as $tahun): ?>
            <a href="?tahun=<?= $tahun ?>"
               class="px-4 py-2 md:px-5 md:py-2.5 rounded-full font-display font-bold text-sm md:text-base transition-all border
                      <?= $tahun === $tahunAktif
                          ? 'bg-stone-900 text-white border-stone-900'
                          : 'bg-white text-stone-600 border-stone-200 hover:border-stone-400 hover:text-stone-900' ?>">
                <?= $tahun ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <!-- Grid Game -->
    <?php if (empty($games)): ?>
        <p class="text-center text-stone-400 py-16">Belum ada data game untuk tahun <?= $tahunAktif ?>.</p>
    <?php else: ?>
    <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
        <?php foreach ($games as $game): ?>
            <!-- ========================================= -->
            <!-- Link ke detail dengan parameter tahun     -->
            <!-- ========================================= -->
            <a href="detail.php?id=<?= (int) $game['id'] ?>&tahun=<?= $tahunAktif ?>"
               class="card-hover group relative rounded-xl overflow-hidden bg-white border border-stone-200">
                <span class="absolute top-2 left-2 z-10 w-8 h-8 rounded-full rank-badge text-white font-display font-black text-sm flex items-center justify-center shadow">
                    <?= (int) $game['ranking'] ?>
                </span>
                <div class="aspect-[3/4] w-full bg-stone-100 flex items-center justify-center overflow-hidden">
                    <?php if (!empty($game['gambar_url'])): ?>
                        <img src="<?= htmlspecialchars($game['gambar_url']) ?>" 
                             alt="<?= htmlspecialchars($game['nama_game']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.174C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.174 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="p-3">
                    <p class="game-name">
                        <?= htmlspecialchars($game['nama_game']) ?>
                    </p>
                    <p class="text-xs text-stone-400 mt-1"><?= (int) $game['tahun'] ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>

</main>

<footer class="border-t border-stone-200 mt-16 py-6 text-center text-xs text-stone-400">
    Gamepedia &mdash; Portal Informasi Game Tahunan
</footer>

</body>
</html>