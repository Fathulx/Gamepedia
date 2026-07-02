<?php
/**
 * Koneksi Database (PDO MySQL)
 * ------------------------------------------------
 * Mendukung environment variable (untuk deploy di Railway)
 * dan juga fallback ke konfigurasi manual (untuk testing lokal).
 *
 * Kalau deploy di Railway, cukup set environment variable berikut
 * di service PHP kamu (Settings > Variables):
 *   DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS
 *
 * Kalau testing di localhost / XAMPP, tinggal isi langsung
 * nilai default di bawah ini.
 */

function getDbConnection(): PDO
{
    $host = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'localhost';
    $port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';
    $dbname = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'dbpemweb';
    $user = getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root';
    $pass = getenv('DB_PASS') ?: getenv('MYSQLPASSWORD') ?: '';

    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        // Jangan tampilkan detail koneksi ke publik, cukup pesan generik
        die('Koneksi database gagal. Periksa konfigurasi environment variable DB_HOST, DB_NAME, DB_USER, DB_PASS.');
    }
}
