<?php
// =============================================
// Konfigurasi Database
// Sesuaikan dengan setting shared hosting Anda
// =============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'pstxmyid_sapini');         // Ganti dengan username database Anda
define('DB_PASS', 'cyF!K1s)NyMcl3T)');             // Ganti dengan password database Anda
define('DB_NAME', 'pstxmyid_ctt_staff');   // Ganti jika nama database berbeda

function getDB() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die(json_encode(['error' => 'Koneksi database gagal: ' . $conn->connect_error]));
        }
        $conn->set_charset('utf8mb4');
    }
    return $conn;
}