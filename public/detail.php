<?php
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM games WHERE id = :id');
$stmt->execute(['id' => $id]);
$game = $stmt->fetch();

if (!$game) {
    header('Location: index.php');
    exit();
}

function getYoutubeEmbedUrl($url) {
    if (empty($url)) return null;
    if (strpos($url, 'embed') !== false) return $url;
    $pattern = '/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
    preg_match($pattern, $url, $matches);
    return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : null;
}

$trailerEmbed = getYoutubeEmbedUrl($game['trailer_url']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($game['nama_game']) ?> | Gamepedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../assets/gamepedia-icon.svg">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f7f5f2; }
        .font-display { font-family: 'Sora', sans-serif; }
        .cover-image {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .badge-rank {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .trailer-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            background: #000;
        }
        .trailer-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            font-weight: 600;
        }
        .info-value {
            font-weight: 500;
            color: #1e293b;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 999px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }
    </style>
</head>
<body class="min-h-screen text-stone-800">

<!-- ========================================== -->
<!-- HEADER SAMA PERSIS DENGAN INDEX           -->
<!-- ========================================== -->
<header class="border-b border-stone-200 bg-[#f7f5f2]/90 backdrop-blur sticky top-0 z-20">
    <div class="max-w-6xl mx-auto px-5 py-5 flex items-center justify-between">
        <h1 class="font-display text-xl md:text-2xl font-extrabold tracking-tight text-stone-900 flex items-center gap-2">
            <img src="../assets/gamepedia-icon.svg" alt="Gamepedia" class="w-7 h-7 md:w-8 md:h-8">
            Gamepedia
        </h1>
        <span class="text-xs md:text-sm text-stone-500 font-medium">Peringkat Game Terbaik 2020&ndash;2025</span>
    </div>
</header>

<!-- ========================================== -->
<!-- MAIN CONTENT - LAYOUT 2 KOLOM             -->
<!-- ========================================== -->
<main class="max-w-6xl mx-auto px-5 pt-20 pb-10">

    <!-- ======================================== -->
    <!-- TOMBOL KEMBALI - DI ATAS CARD, POJOK KANAN -->
    <!-- ======================================== -->
    <div class="flex justify-end mb-3">
        <a href="index.php?tahun=<?= (int) $game['tahun'] ?>" class="btn-back">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <!-- CARD DETAIL -->
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden p-6 md:p-8">
        
        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- Kolom Kiri: Gambar (3:4) -->
            <div class="md:w-1/3">
                <?php if (!empty($game['gambar_url'])): ?>
                    <img src="<?= htmlspecialchars($game['gambar_url']) ?>" 
                         alt="<?= htmlspecialchars($game['nama_game']) ?>" 
                         class="cover-image">
                <?php else: ?>
                    <div class="w-full aspect-[3/4] bg-stone-100 rounded-xl flex items-center justify-center text-stone-400">
                        <i class="fas fa-image text-5xl"></i>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Kolom Kanan: Info Game -->
            <div class="md:w-2/3">
                
                <!-- Badge Ranking & Tahun -->
                <div class="badge-rank mb-4">
                    <span>#<?= (int) $game['ranking'] ?></span>
                    <span class="w-px h-4 bg-white/30"></span>
                    <span><?= $game['tahun'] ?></span>
                </div>
                
                <!-- Judul -->
                <h1 class="text-3xl md:text-4xl font-bold text-stone-800 mb-2">
                    <?= htmlspecialchars($game['nama_game']) ?>
                </h1>
                
                <!-- Harga -->
                <?php if ($game['harga'] !== null): ?>
                    <div class="text-2xl font-bold text-green-600 mb-4">
                        Rp <?= number_format($game['harga'], 0, ',', '.') ?>
                    </div>
                <?php endif; ?>
                
                <!-- Detail Grid -->
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 mb-6">
                    <div>
                        <p class="info-label">Genre</p>
                        <p class="info-value"><?= htmlspecialchars($game['genre']) ?></p>
                    </div>
                    <div>
                        <p class="info-label">Rating</p>
                        <p class="info-value">
                            <?= $game['rating'] !== null ? number_format($game['rating'], 1) . ' / 10' : '-' ?>
                        </p>
                    </div>
                    <div>
                        <p class="info-label">Developer</p>
                        <p class="info-value"><?= htmlspecialchars($game['developer']) ?></p>
                    </div>
                    <div>
                        <p class="info-label">Publisher</p>
                        <p class="info-value"><?= htmlspecialchars($game['publisher']) ?></p>
                    </div>
                    <div class="col-span-2">
                        <p class="info-label">Platform</p>
                        <p class="info-value"><?= htmlspecialchars($game['platform']) ?></p>
                    </div>
                </div>
                
                <!-- Deskripsi -->
                <?php if (!empty($game['deskripsi'])): ?>
                    <div class="mb-4">
                        <p class="info-label mb-1">Deskripsi</p>
                        <p class="text-stone-700 leading-relaxed text-sm"><?= nl2br(htmlspecialchars($game['deskripsi'])) ?></p>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
        
        <!-- Trailer (Full Width) -->
        <?php if ($trailerEmbed): ?>
            <div class="mt-8 border-t border-stone-200 pt-6">
                <h3 class="text-sm font-bold text-stone-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fas fa-video text-red-600 text-base"></i> Trailer Game
                </h3>
                <div class="trailer-wrapper">
                    <iframe src="<?= htmlspecialchars($trailerEmbed) ?>" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        <?php endif; ?>

    </div>

</main>

<footer class="border-t border-stone-200 mt-16 py-6 text-center text-xs text-stone-400">
    Gamepedia &mdash; Portal Informasi Game Tahunan
</footer>

</body>
</html>