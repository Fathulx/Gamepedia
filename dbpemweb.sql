-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2026 pada 15.25
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpemweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `nama_game` varchar(150) NOT NULL,
  `tahun` int(11) NOT NULL,
  `ranking` int(11) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `developer` varchar(150) NOT NULL,
  `publisher` varchar(150) NOT NULL,
  `platform` varchar(150) NOT NULL,
  `deskripsi` text,
  `gambar_url` varchar(500) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `trailer_url` varchar(500) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`id`, `nama_game`, `tahun`, `ranking`, `genre`, `developer`, `publisher`, `platform`, `deskripsi`, `gambar_url`, `rating`, `trailer_url`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Persona 5 Royal', 2020, 1, 'RPG', 'Atlus', 'Atlus', 'PS4, Nintendo Switch, PC, Xbox', 'Versi diperluas dari Persona 5 dengan konten tambahan, karakter baru, dan cerita yang lebih dalam.', '/EASPrakPemweb/assets/Persona-5-Royal.jpg', '9.5', 'https://youtu.be/SKpSpvFCZRw?si=RB6VfZiQt1Hiyrx3', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(2, 'Hades', 2020, 2, 'Roguelike Action', 'Supergiant Games', 'Supergiant Games', 'PC, Nintendo Switch, PS4/5, Xbox', 'Roguelike aksi bertema mitologi Yunani, memainkan Zagreus yang mencoba kabur dari Underworld.', '/EASPrakPemweb/assets/Hades.jpg', '9.3', 'https://youtu.be/91t0ha9x0AE?si=eQqq-Fquq_lAzaPi', '249000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(3, 'Half-Life: Alyx', 2020, 3, 'FPS VR', 'Valve', 'Valve', 'PC (VR)', 'Prekuel Half-Life 2 yang dirancang penuh untuk perangkat VR.', '/EASPrakPemweb/assets/Half-Life-Alyx.jpg', '9.3', 'https://youtu.be/5c8_6Mli5WQ?si=if7G7U_aw-qWaI1D', '439000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(4, 'The Last of Us Part II', 2020, 4, 'Action-Adventure', 'Naughty Dog', 'Sony Interactive Entertainment', 'PS4', 'Kelanjutan kisah Ellie dan Joel dengan cerita yang penuh emosi dan dilema moral.', '/EASPrakPemweb/assets/The-Last-Of-Us-Part-2.jpg', '9.3', 'https://youtu.be/cxJWO3Dejj0?si=twF28u_QCM8FvKyO', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(5, 'Demon\'s Souls', 2020, 5, 'Action RPG', 'Bluepoint Games', 'Sony Interactive Entertainment', 'PS5', 'Remake grafis penuh dari game Souls-like klasik PS3.', '/EASPrakPemweb/assets/Demons-Souls.jpg', '9.2', 'https://youtu.be/2TMs2E6cms4?si=SBHCv-ovpTWfMcFT', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(6, 'Crusader Kings III', 2020, 6, 'Strategy', 'Paradox Development Studio', 'Paradox Interactive', 'PC', 'Simulasi strategi dinasti abad pertengahan yang mendalam.', '/EASPrakPemweb/assets/Crusader-Kings-III.jpg', '9.1', 'https://youtu.be/Demi3MfHHYw?si=L-dbNAQKkx8Z75pY', '499000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(7, 'Animal Crossing: New Horizons', 2020, 7, 'Simulation', 'Nintendo', 'Nintendo', 'Nintendo Switch', 'Simulasi kehidupan santai di pulau pribadi yang bisa dikustomisasi bebas.', '/EASPrakPemweb/assets/Animal-Crossing-New-Horizons.jpg', '9.0', 'https://youtu.be/5LAKjL3p6Gw?si=o1nR76kDJszwHTry', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(8, 'Ori and the Will of the Wisps', 2020, 8, 'Metroidvania', 'Moon Studios', 'Xbox Game Studios', 'PC, Xbox, Nintendo Switch', 'Petualangan platformer indah dengan visual dan musik yang memukau.', '/EASPrakPemweb/assets/Ori-and-the-Will-of-the-Wisps.jpg', '9.0', 'https://youtu.be/kd0zbNw1VOg?si=avD4T10diMuoCUkG', '349000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(9, 'Doom Eternal', 2020, 9, 'FPS', 'id Software', 'Bethesda Softworks', 'PC, PS4/5, Xbox, Switch', 'Aksi tembak-menembak brutal dan cepat melawan pasukan neraka.', '/EASPrakPemweb/assets/DOOM-Eternal.jpg', '8.8', 'https://youtu.be/_UuktemkCFI?si=pvanXtEOnBTvh8uC', '499000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(10, 'Final Fantasy VII Remake', 2020, 10, 'Action RPG', 'Square Enix', 'Square Enix', 'PS4/5', 'Remake modern dari RPG klasik legendaris Final Fantasy VII.', '/EASPrakPemweb/assets/Final-Fantasy-VII-Remake.jpg', '8.7', 'https://youtu.be/sz9QWTcbXYE?si=ASRcxM73ULp8RRyb', '699000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(11, 'It Takes Two', 2021, 1, 'Co-op Adventure', 'Hazelight Studios', 'Electronic Arts', 'PC, PS4/5, Xbox, Switch', 'Petualangan kooperatif kreatif tentang pasangan yang berubah jadi boneka.', '/EASPrakPemweb/assets/It-Takes-Two.jpg', '9.3', 'https://youtu.be/ohClxMmNLQQ?si=n5tR-wv8BTy7C0-g', '499000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(12, 'Forza Horizon 5', 2021, 2, 'Racing', 'Playground Games', 'Xbox Game Studios', 'PC, Xbox', 'Balapan dunia terbuka dengan latar Meksiko yang penuh warna.', '/EASPrakPemweb/assets/Forza-Horizon-5.jpg', '9.2', 'https://youtu.be/FYH9n37B7Yw?si=BasEVjrpPfhynPvN', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(13, 'Deathloop', 2021, 3, 'FPS Immersive Sim', 'Arkane Studios', 'Bethesda Softworks', 'PC, PS5', 'Aksi loop waktu dengan gaya penuturan yang unik.', '/EASPrakPemweb/assets/Deathloop.jpg', '9.0', 'https://youtu.be/mc2hz3LJhTY?si=Li_ypfMs_t2XKfNe', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(14, 'Metroid Dread', 2021, 4, 'Metroidvania', 'MercurySteam', 'Nintendo', 'Nintendo Switch', 'Kelanjutan seri Metroid 2D setelah lebih dari satu dekade.', '/EASPrakPemweb/assets/Metroid-Dread.jpg', '8.9', 'https://youtu.be/XsN0avdHf4I?si=hoRQ5lRFUqjnO9la', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(15, 'Psychonauts 2', 2021, 5, 'Platformer', 'Double Fine Productions', 'Xbox Game Studios', 'PC, PS4, Xbox', 'Platformer kreatif dengan eksplorasi pikiran karakter yang unik.', '/EASPrakPemweb/assets/Psychonauts-2.jpg', '8.9', 'https://youtu.be/liJTZfJhOcs?si=mF8Gmpunw7OXwckM', '499000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(16, 'Resident Evil Village', 2021, 6, 'Survival Horror', 'Capcom', 'Capcom', 'PC, PS4/5, Xbox', 'Horor kelangsungan hidup dengan atmosfer gothic yang mencekam.', '/EASPrakPemweb/assets/Resident-Evil-Village.jpg', '8.7', 'https://youtu.be/26tay8lMZW4?si=JpmxSos8WXh140-0', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(17, 'Ratchet & Clank: Rift Apart', 2021, 7, 'Action-Platformer', 'Insomniac Games', 'Sony Interactive Entertainment', 'PS5', 'Petualangan aksi dimensi-melompat dengan visual next-gen.', '/EASPrakPemweb/assets/Ratchet-and-Clank-Rift-Apart.jpg', '8.8', 'https://youtu.be/55PRv_e00wc?si=mfw_UYXYpBfXALzC', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(18, 'Returnal', 2021, 8, 'Roguelike Shooter', 'Housemarque', 'Sony Interactive Entertainment', 'PS5', 'Roguelike tembak-menembak sci-fi dengan tingkat kesulitan tinggi.', '/EASPrakPemweb/assets/Returnal.jpg', '8.6', 'https://youtu.be/Jv4BjWoB-NA?si=Vuh2NjayKs8UznGG', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(19, 'Halo Infinite', 2021, 9, 'FPS', '343 Industries', 'Xbox Game Studios', 'PC, Xbox', 'Kembalinya Master Chief dalam petualangan dunia terbuka pertama seri Halo.', '/EASPrakPemweb/assets/Halo-Infinite.jpg', '8.7', 'https://youtu.be/MBb88gLmJZY?si=FqmBmeXnITG10kBB', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(20, 'Marvel\'s Guardians of the Galaxy', 2021, 10, 'Action-Adventure', 'Eidos-Montreal', 'Square Enix', 'PC, PS4/5, Xbox, Switch', 'Petualangan aksi dengan dialog komedi khas Guardians of the Galaxy.', '/EASPrakPemweb/assets/Marvels-Guardians-of-the-Galaxy.jpg', '8.5', 'https://youtu.be/QBn8ST8rELc?si=A5Tyx2ZfVg2ysy8q', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(21, 'Elden Ring', 2022, 1, 'Action RPG', 'FromSoftware', 'Bandai Namco', 'PC, PS4/5, Xbox', 'RPG aksi dunia terbuka dari pencipta Dark Souls, kolaborasi dengan George R.R. Martin.', '/EASPrakPemweb/assets/Elden-Ring.jpg', '9.6', 'https://youtu.be/E3Huy2cdih0?si=hTsxNPOyIqmx5kGy', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(22, 'God of War Ragnarok', 2022, 2, 'Action-Adventure', 'Santa Monica Studio', 'Sony Interactive Entertainment', 'PS4/5', 'Kelanjutan kisah Kratos dan Atreus menghadapi Ragnarok Nordik.', '/EASPrakPemweb/assets/God-Of-War-Ragnarok.jpg', '9.4', 'https://youtu.be/EE-4GvjKcfs?si=83BHEEogATWVzLS3', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(23, 'Horizon Forbidden West', 2022, 3, 'Action RPG', 'Guerrilla Games', 'Sony Interactive Entertainment', 'PS4/5', 'Petualangan Aloy menjelajahi dunia pasca-apokaliptik yang dipenuhi mesin.', '/EASPrakPemweb/assets/Horizon-Forbidden-West.jpg', '9.0', 'https://youtu.be/Lq594XmpPBg?si=wr6I3ycfPq5MP61V', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(24, 'Xenoblade Chronicles 3', 2022, 4, 'JRPG', 'Monolith Soft', 'Nintendo', 'Nintendo Switch', 'JRPG epik dengan sistem pertarungan mendalam dan dunia luas.', '/EASPrakPemweb/assets/Xenoblade-Chronicles-3.jpg', '9.0', 'https://youtu.be/t-iNpDKuYb8?si=bhAFRikS3qJrycJR', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(25, 'Stray', 2022, 5, 'Adventure', 'BlueTwelve Studio', 'Annapurna Interactive', 'PC, PS4/5', 'Petualangan unik memainkan seekor kucing di kota cyberpunk.', '/EASPrakPemweb/assets/Stray.jpg', '8.9', 'https://youtu.be/kJawWyRUOBM?si=Oyv1Zm3LFuKmjPWI', '299000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(26, 'Immortality', 2022, 6, 'Interactive Film', 'Half Mermaid', 'Annapurna Interactive', 'PC, PS4/5, Xbox', 'Game naratif eksperimental berbentuk kumpulan rekaman film.', '/EASPrakPemweb/assets/Immortality.jpg', '8.8', 'https://youtu.be/d8NHtOIz6fU?si=AKrOWYkTuylTuOvU', '349000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(27, 'A Plague Tale: Requiem', 2022, 7, 'Action-Adventure', 'Asobo Studio', 'Focus Entertainment', 'PC, PS5, Xbox', 'Kisah emosional dua bersaudara bertahan hidup di tengah wabah abad pertengahan.', '/EASPrakPemweb/assets/A-Plague-Tale-Requiem.jpg', '8.7', 'https://youtu.be/qIbzwb8vzNI?si=G87oekdNEExUspGy', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(28, 'Vampire Survivors', 2022, 8, 'Roguelike', 'poncle', 'poncle', 'PC, mobile', 'Roguelike bertahan hidup sederhana namun sangat adiktif.', '/EASPrakPemweb/assets/Vampire-Survivors.jpg', '8.7', 'https://youtu.be/6HXNxWbRgsg?si=rI6hygKLIGmj4QvW', '49000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(29, 'Tunic', 2022, 9, 'Action-Adventure', 'Andrew Shouldice', 'Finji', 'PC, PS4/5, Xbox', 'Petualangan aksi teka-teki dengan gaya visual isometrik yang memikat.', '/EASPrakPemweb/assets/Tunic.jpg', '8.5', 'https://youtu.be/Q5XpgTO7YN0?si=GwI5pCvM3kHYguIS', '249000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(30, 'Sifu', 2022, 10, 'Beat \'em up', 'Sloclap', 'Sloclap', 'PC, PS4/5, Xbox, Switch', 'Game pertarungan kungfu dengan mekanik penuaan karakter yang unik.', '/EASPrakPemweb/assets/Sifu.jpg', '8.4', 'https://youtu.be/1FQ1YO3Ks2U?si=9Jj0hH-Jn4Q9YQdD', '399000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(31, 'Baldur\'s Gate 3', 2023, 1, 'RPG', 'Larian Studios', 'Larian Studios', 'PC, PS5, Xbox', 'RPG berbasis Dungeons & Dragons dengan kebebasan cerita yang luar biasa.', '/EASPrakPemweb/assets/Baldurs-Gate-3.jpg', '9.7', 'https://youtu.be/1T22wNvoNiU?si=uTwYFfg5J1UNrbfZ', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(32, 'Alan Wake 2', 2023, 2, 'Survival Horror', 'Remedy Entertainment', 'Epic Games Publishing', 'PC, PS5, Xbox', 'Horor psikologis dengan narasi ganda antara dua karakter utama.', '/EASPrakPemweb/assets/Alan-Wake-2.jpg', '9.3', 'https://youtu.be/q0vNoRhuV_I?si=yLTAGl2qQVDCEu6C', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(33, 'Marvel\'s Spider-Man 2', 2023, 3, 'Action-Adventure', 'Insomniac Games', 'Sony Interactive Entertainment', 'PS5', 'Aksi ayunan kota New York dengan dua Spider-Man sekaligus.', '/EASPrakPemweb/assets/Marvels-Spider-Man-2.jpg', '9.1', 'https://youtu.be/nq1M_Wc4FIc?si=xFYaRjC4waxyeUqK', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(34, 'Resident Evil 4 (Remake)', 2023, 4, 'Survival Horror', 'Capcom', 'Capcom', 'PC, PS4/5, Xbox', 'Remake modern dari salah satu game horor paling ikonik sepanjang masa.', '/EASPrakPemweb/assets/Resident-Evil-4-(Remake).jpg', '9.2', 'https://youtu.be/rcFarJACzx0?si=us6kG2RDYqsnbh5n', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(35, 'Super Mario Bros. Wonder', 2023, 5, 'Platformer', 'Nintendo', 'Nintendo', 'Nintendo Switch', 'Platformer 2D Mario dengan mekanik \"Wonder Flower\" yang kreatif.', '/EASPrakPemweb/assets/Super-Mario-Bros-Wonder.jpg', '9.0', 'https://youtu.be/JStAYvbeSHc?si=EKrRrmV5Y1yrzhj9', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(36, 'The Legend of Zelda: Tears of the Kingdom', 2023, 6, 'Action-Adventure', 'Nintendo', 'Nintendo', 'Nintendo Switch', 'Kelanjutan Breath of the Wild dengan mekanik kreasi dan eksplorasi vertikal.', '/EASPrakPemweb/assets/The-Legend-of-Zelda-Tears-of-the-Kingdom.jpg', '9.5', 'https://youtu.be/2SNF4M_v7wc?si=1SXFv1Xcrv-mmVJa', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(37, 'Hogwarts Legacy', 2023, 7, 'Action RPG', 'Avalanche Software', 'Warner Bros. Games', 'PC, PS4/5, Xbox, Switch', 'RPG dunia terbuka bertema dunia sihir Harry Potter.', '/EASPrakPemweb/assets/Hogwarts-Legacy.jpg', '8.6', 'https://youtu.be/2_r8wLyeoKQ?si=nIol6PL-XRBS3gT3', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(38, 'Street Fighter 6', 2023, 8, 'Fighting', 'Capcom', 'Capcom', 'PC, PS4/5, Xbox', 'Kelanjutan seri fighting legendaris dengan mode World Tour yang baru.', '/EASPrakPemweb/assets/Street-Fighter-6.jpg', '8.9', 'https://youtu.be/1INU3FOJsTw?si=LqZjn3D8tvgmlhc8', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(39, 'Diablo IV', 2023, 9, 'Action RPG', 'Blizzard Entertainment', 'Blizzard Entertainment', 'PC, PS4/5, Xbox', 'Kelanjutan seri hack-and-slash gelap dengan dunia terbuka bersama.', '/EASPrakPemweb/assets/Diablo-IV.jpg', '8.5', 'https://youtu.be/0SSYzl9fXOQ?si=sWdwsRG3PDXYlPwU', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(40, 'Hi-Fi Rush', 2023, 10, 'Rhythm Action', 'Tango Gameworks', 'Bethesda Softworks', 'PC, Xbox', 'Aksi ritme energik dengan gaya visual komik yang cerah.', '/EASPrakPemweb/assets/Hi-Fi-Rush.jpg', '8.8', 'https://youtu.be/KNYct9-HmUI?si=qCAgr9fWpx9pi_gb', '399000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(41, 'Astro Bot', 2024, 1, 'Platformer', 'Team Asobi', 'Sony Interactive Entertainment', 'PS5', 'Platformer 3D ceria yang menampilkan kemampuan DualSense secara maksimal.', '/EASPrakPemweb/assets/Astro-Bot.jpg', '9.4', 'https://youtu.be/JEoza2V-0Ro?si=6WIwnmI47pt0n4HY', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(42, 'Balatro', 2024, 2, 'Card / Roguelike', 'LocalThunk', 'Playstack', 'PC, PS4/5, Xbox, Switch, mobile', 'Roguelike kartu berbasis poker yang sangat adiktif.', '/EASPrakPemweb/assets/Balatro.jpg', '9.2', 'https://youtu.be/VUyP21iQ_-g?si=Gx4B4_Q7eBTKfudN', '149000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(43, 'Black Myth: Wukong', 2024, 3, 'Action RPG', 'Game Science', 'Game Science', 'PC, PS5', 'Action RPG bertema mitologi Tiongkok berdasarkan kisah Journey to the West.', '/EASPrakPemweb/assets/Black-Myth-Wukong.jpg', '8.9', 'https://youtu.be/pnSsgRJmsCc?si=lEqExYTkbV-TQy6F', '599000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(44, 'Elden Ring: Shadow of the Erdtree', 2024, 4, 'Action RPG (DLC)', 'FromSoftware', 'Bandai Namco', 'PC, PS4/5, Xbox', 'Ekspansi besar dari Elden Ring dengan wilayah dan bos baru.', '/EASPrakPemweb/assets/Elden-Ring-Shadow-of-the-Erdtree.jpg', '9.3', 'https://youtu.be/qLZenOn7WUo?si=zoJeiVEpMtxto3D2', '399000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(45, 'Final Fantasy VII Rebirth', 2024, 5, 'Action RPG', 'Square Enix', 'Square Enix', 'PS5', 'Kelanjutan kisah remake FFVII dengan dunia terbuka yang luas.', '/EASPrakPemweb/assets/Final-Fantasy-VII-Rebirth.jpg', '9.2', 'https://youtu.be/HkD8BCCYsS0?si=DKeSrvw1Oqawc9qj', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(46, 'Metaphor: ReFantazio', 2024, 6, 'JRPG', 'Atlus', 'Atlus', 'PC, PS4/5, Xbox', 'JRPG fantasi baru dari tim pembuat seri Persona.', '/EASPrakPemweb/assets/Metaphor-ReFantazio.jpg', '9.1', 'https://youtu.be/SjbgJaYi4NE?si=9jvDLS5TP_2trEXq', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(47, 'Helldivers 2', 2024, 7, 'Co-op Shooter', 'Arrowhead Game Studios', 'Sony Interactive Entertainment', 'PC, PS5', 'Aksi tembak-menembak kooperatif satir melawan invasi alien.', '/EASPrakPemweb/assets/Helldivers-2.jpg', '8.7', 'https://youtu.be/UC5EpJR0GBQ?si=5gUvRhketDEwuBQB', '399000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(48, 'Silent Hill 2 (Remake)', 2024, 8, 'Survival Horror', 'Bloober Team', 'Konami', 'PC, PS5', 'Remake dari salah satu game horor psikologis paling berpengaruh.', '/EASPrakPemweb/assets/Silent-Hill-2-(Remake).jpg', '8.9', 'https://youtu.be/J3i1g_PHcaY?si=UZfBWQ9umIxiFpu-', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(49, 'Dragon\'s Dogma 2', 2024, 9, 'Action RPG', 'Capcom', 'Capcom', 'PC, PS5, Xbox', 'RPG aksi dunia terbuka dengan sistem Pawn yang khas.', '/EASPrakPemweb/assets/Dragons-Dogma-2.jpg', '8.4', 'https://youtu.be/cT0rIgaiPWA?si=iSjDezzp9qjEN4xa', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(50, 'Like a Dragon: Infinite Wealth', 2024, 10, 'Action RPG', 'Ryu Ga Gotoku Studio', 'Sega', 'PC, PS4/5, Xbox', 'Kelanjutan seri Yakuza/Like a Dragon dengan setting Hawaii.', '/EASPrakPemweb/assets/Like-a-Dragon-Infinite-Wealth.jpg', '8.8', 'https://youtu.be/dWXAxOKdQ6c?si=5CdjWJ-j0LDpmMQt', '799000.00', '2026-07-01 11:59:53', '2026-07-01 17:38:49'),
(61, 'Clair Obscur: Expedition 33', 2025, 1, 'Turn-based RPG', 'Sandfall Interactive', 'Kepler Interactive', 'PC, PS5, Xbox', 'RPG giliran dengan gaya seni Belle Epoque Prancis yang memukau.', '/EASPrakPemweb/assets/Clair-Obscur-Expedition-33.jpg', '9.4', 'https://youtu.be/2VaLOc1FpSo?si=Nb93aJr30QeoXaI3', '599000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(62, 'Death Stranding 2: On the Beach', 2025, 2, 'Action-Adventure', 'Kojima Productions', 'Sony Interactive Entertainment', 'PS5', 'Kelanjutan petualangan Sam Porter Bridges menyambungkan dunia yang terpisah.', '/EASPrakPemweb/assets/Death-Stranding-2-On-the-Beach.jpg', '9.0', 'https://youtu.be/F79oEkMXElU?si=J4YmBS6uBX139oc_', '799000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(63, 'Donkey Kong Bananza', 2025, 3, 'Platformer', 'Nintendo', 'Nintendo', 'Nintendo Switch 2', 'Petualangan 3D Donkey Kong dengan mekanik penghancuran lingkungan.', '/EASPrakPemweb/assets/Donkey-Kong-Bananza.jpg', '9.0', 'https://youtu.be/mIddsPkdX9U?si=79Na6mzGu_QqNVRC', '699000.00', '2026-07-01 18:06:46', '2026-07-01 18:18:35'),
(64, 'Hades II', 2025, 4, 'Roguelike Action', 'Supergiant Games', 'Supergiant Games', 'PC, Nintendo Switch, PS5, Xbox', 'Kelanjutan Hades dengan protagonis baru, Melinoe, melawan Titan Kronos.', '/EASPrakPemweb/assets/Hades-II.jpg', '9.1', 'https://youtu.be/WzJ_UhPptBQ?si=TcED81bui5cYvEWX', '249000.00', '2026-07-01 18:06:46', '2026-07-01 18:18:35'),
(65, 'Hollow Knight: Silksong', 2025, 5, 'Metroidvania', 'Team Cherry', 'Team Cherry', 'PC, PS4/5, Xbox, Switch', 'Kelanjutan Hollow Knight yang telah dinanti bertahun-tahun.', '/EASPrakPemweb/assets/Hollow-Knight-Silksong.jpg', '9.2', 'https://youtu.be/6XGeJwsUP9c?si=SCd-nmsmwtnzfV8N', '349000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(66, 'Kingdom Come: Deliverance II', 2025, 6, 'Action RPG', 'Warhorse Studios', 'Deep Silver', 'PC, PS5, Xbox', 'RPG realistis bertema abad pertengahan Eropa Tengah.', '/EASPrakPemweb/assets/Kingdom-Come-Deliverance-II.jpg', '8.9', 'https://youtu.be/wMZFM6JC47Q?si=vNtiy3JMoLTmeS-O', '699000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(67, 'Split Fiction', 2025, 7, 'Co-op Adventure', 'Hazelight Studios', 'Electronic Arts', 'PC, PS5, Xbox', 'Petualangan kooperatif kreatif dari tim pembuat It Takes Two.', '/EASPrakPemweb/assets/Split-Fiction.jpg', '8.9', 'https://youtu.be/fcwngWPXQtg?si=12_LmjL6e7-0sVuW', '499000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(68, 'Mario Kart World', 2025, 8, 'Racing', 'Nintendo', 'Nintendo', 'Nintendo Switch 2', 'Balapan Mario Kart dengan dunia terbuka yang bisa dijelajahi bebas.', '/EASPrakPemweb/assets/Mario-Kart-World.jpg', '8.8', 'https://youtu.be/3pE23YTYEZM?si=equXkAyj7rBtfd_d', '699000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(69, 'Ghost of Yotei', 2025, 9, 'Action-Adventure', 'Sucker Punch Productions', 'Sony Interactive Entertainment', 'PS5', 'Kelanjutan Ghost of Tsushima dengan latar dan tokoh baru.', '/EASPrakPemweb/assets/Ghost-of-Yotei.jpg', '8.7', 'https://youtu.be/7z7kqwuf0a8?si=9KbQ1EI_0g9TDu9x', '799000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14'),
(70, 'Blue Prince', 2025, 10, 'Puzzle Adventure', 'Dogubomb', 'Raw Fury', 'PC, PS5, Xbox', 'Petualangan teka-teki eksplorasi rumah misterius yang berubah tiap hari.', '/EASPrakPemweb/assets/Blue-Prince.jpg', '8.6', 'https://youtu.be/CQFxvMg87Cs?si=vItWFWXnNNSsS0Lh', '349000.00', '2026-07-01 18:06:46', '2026-07-01 18:17:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tahun_ranking` (`tahun`,`ranking`),
  ADD KEY `idx_tahun` (`tahun`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
