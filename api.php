<?php
// =============================================
// API Handler - semua request AJAX masuk sini
// =============================================

require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'get_staff':
        getStaff();
        break;
    case 'add_staff':
        addStaff();
        break;
    case 'tambah_pembelian':
        tambahPembelian();
        break;
    case 'tambah_pembayaran':
        tambahPembayaran();
        break;
    case 'get_riwayat':
        getRiwayat();
        break;
    case 'hapus_transaksi':
        hapusTransaksi();
        break;
    default:
        echo json_encode(['error' => 'Action tidak dikenali']);
}

// -----------------------------------------------
// Ambil semua staff diurutkan saldo terendah dulu
// -----------------------------------------------
function getStaff() {
    $db = getDB();
    $res = $db->query("SELECT * FROM staff ORDER BY saldo ASC");
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $data]);
}

// -----------------------------------------------
// Tambah staff baru
// -----------------------------------------------
function addStaff() {
    $db = getDB();
    $nama = trim($_POST['nama'] ?? '');
    if (empty($nama)) {
        echo json_encode(['error' => 'Nama tidak boleh kosong']);
        return;
    }
    $stmt = $db->prepare("INSERT INTO staff (nama, saldo) VALUES (?, 0.00)");
    $stmt->bind_param('s', $nama);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $stmt->insert_id]);
    } else {
        echo json_encode(['error' => 'Gagal menambah staff']);
    }
}

// -----------------------------------------------
// Catat pembelian (mengurangi saldo)
// -----------------------------------------------
function tambahPembelian() {
    $db = getDB();
    $staff_id   = intval($_POST['staff_id'] ?? 0);
    $tanggal    = $_POST['tanggal'] ?? date('Y-m-d');
    $nominal    = floatval($_POST['nominal'] ?? 0);
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($staff_id <= 0 || $nominal <= 0) {
        echo json_encode(['error' => 'Data tidak valid']);
        return;
    }

    $db->begin_transaction();
    try {
        $stmt = $db->prepare("INSERT INTO transaksi (staff_id, tipe, tanggal, nominal, keterangan) VALUES (?, 'pembelian', ?, ?, ?)");
        $stmt->bind_param('isds', $staff_id, $tanggal, $nominal, $keterangan);
        $stmt->execute();

        $stmt2 = $db->prepare("UPDATE staff SET saldo = saldo - ? WHERE id = ?");
        $stmt2->bind_param('di', $nominal, $staff_id);
        $stmt2->execute();

        $db->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $db->rollback();
        echo json_encode(['error' => 'Gagal menyimpan transaksi']);
    }
}

// -----------------------------------------------
// Catat pembayaran (menambah saldo)
// -----------------------------------------------
function tambahPembayaran() {
    $db = getDB();
    $staff_id   = intval($_POST['staff_id'] ?? 0);
    $tanggal    = $_POST['tanggal'] ?? date('Y-m-d');
    $nominal    = floatval($_POST['nominal'] ?? 0);
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($staff_id <= 0 || $nominal <= 0) {
        echo json_encode(['error' => 'Data tidak valid']);
        return;
    }

    $db->begin_transaction();
    try {
        $stmt = $db->prepare("INSERT INTO transaksi (staff_id, tipe, tanggal, nominal, keterangan) VALUES (?, 'pembayaran', ?, ?, ?)");
        $stmt->bind_param('isds', $staff_id, $tanggal, $nominal, $keterangan);
        $stmt->execute();

        $stmt2 = $db->prepare("UPDATE staff SET saldo = saldo + ? WHERE id = ?");
        $stmt2->bind_param('di', $nominal, $staff_id);
        $stmt2->execute();

        $db->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $db->rollback();
        echo json_encode(['error' => 'Gagal menyimpan transaksi']);
    }
}

// -----------------------------------------------
// Ambil riwayat transaksi staff
// -----------------------------------------------
function getRiwayat() {
    $db = getDB();
    $staff_id = intval($_GET['staff_id'] ?? 0);
    if ($staff_id <= 0) {
        echo json_encode(['error' => 'Staff tidak valid']);
        return;
    }

    // Info staff
    $stmt = $db->prepare("SELECT * FROM staff WHERE id = ?");
    $stmt->bind_param('i', $staff_id);
    $stmt->execute();
    $staff = $stmt->get_result()->fetch_assoc();

    // Transaksi diurutkan terbaru dulu
    $stmt2 = $db->prepare("SELECT * FROM transaksi WHERE staff_id = ? ORDER BY tanggal DESC, created_at DESC");
    $stmt2->bind_param('i', $staff_id);
    $stmt2->execute();
    $res = $stmt2->get_result();
    $transaksi = [];
    while ($row = $res->fetch_assoc()) {
        $transaksi[] = $row;
    }

    echo json_encode(['success' => true, 'staff' => $staff, 'transaksi' => $transaksi]);
}

// -----------------------------------------------
// Hapus transaksi dan koreksi saldo
// -----------------------------------------------
function hapusTransaksi() {
    $db = getDB();
    $id = intval($_POST['id'] ?? 0);
    if ($id <= 0) {
        echo json_encode(['error' => 'ID tidak valid']);
        return;
    }

    $stmt = $db->prepare("SELECT * FROM transaksi WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $trx = $stmt->get_result()->fetch_assoc();

    if (!$trx) {
        echo json_encode(['error' => 'Transaksi tidak ditemukan']);
        return;
    }

    $db->begin_transaction();
    try {
        // Balik efek ke saldo
        if ($trx['tipe'] === 'pembelian') {
            $stmt2 = $db->prepare("UPDATE staff SET saldo = saldo + ? WHERE id = ?");
        } else {
            $stmt2 = $db->prepare("UPDATE staff SET saldo = saldo - ? WHERE id = ?");
        }
        $stmt2->bind_param('di', $trx['nominal'], $trx['staff_id']);
        $stmt2->execute();

        $stmt3 = $db->prepare("DELETE FROM transaksi WHERE id = ?");
        $stmt3->bind_param('i', $id);
        $stmt3->execute();

        $db->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $db->rollback();
        echo json_encode(['error' => 'Gagal menghapus transaksi']);
    }
}