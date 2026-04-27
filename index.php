<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Kasbon RJS - Pencatatan Keuangan Kantor</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* =========================================
   ROOT & RESET
   ========================================= */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg: #F4F6F9;
  --surface: #FFFFFF;
  --surface2: #F0F2F5;
  --border: #E4E8EF;
  --text: #1A1D23;
  --text-2: #6B7280;
  --text-3: #9CA3AF;
  --red: #EF4444;
  --red-soft: #FEF2F2;
  --red-mid: #FCA5A5;
  --blue: #3B82F6;
  --blue-soft: #EFF6FF;
  --blue-mid: #93C5FD;
  --green: #10B981;
  --green-soft: #ECFDF5;
  --amber: #F59E0B;
  --amber-soft: #FFFBEB;
  --shadow-sm: 0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.05);
  --shadow-md: 0 4px 16px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04);
  --shadow-lg: 0 10px 40px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
  --radius: 14px;
  --radius-sm: 8px;
  --radius-lg: 20px;
  --font: 'Plus Jakarta Sans', sans-serif;
}

html { scroll-behavior: smooth; }
body {
  font-family: var(--font);
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  -webkit-font-smoothing: antialiased;
}

/* =========================================
   HEADER
   ========================================= */
.header {
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  padding: 16px 20px;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: var(--shadow-sm);
}
.header-inner {
  max-width: 480px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.header-logo {
  display: flex;
  align-items: center;
  gap: 10px;
}
.header-icon {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
  box-shadow: 0 2px 8px rgba(59,130,246,.35);
}
.header h1 { font-size: 17px; font-weight: 700; letter-spacing: -.3px; }
.header p { font-size: 11px; color: var(--text-2); margin-top: 1px; }
.header-refresh {
  width: 34px; height: 34px;
  border-radius: 8px;
  border: 1px solid var(--border);
  background: var(--surface);
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
  transition: all .2s;
  color: var(--text-2);
}
.header-refresh:hover { background: var(--surface2); }

/* =========================================
   SUMMARY BAR
   ========================================= */
.summary-bar {
  max-width: 480px;
  margin: 16px auto 0;
  padding: 0 16px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}
.summary-card {
  background: var(--surface);
  border-radius: var(--radius);
  padding: 14px 16px;
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
}
.summary-card .label { font-size: 11px; color: var(--text-2); font-weight: 500; margin-bottom: 4px; }
.summary-card .value { font-size: 16px; font-weight: 700; }
.summary-card.hutang .value { color: var(--red); }
.summary-card.deposit .value { color: var(--blue); }

/* =========================================
   MAIN CONTENT
   ========================================= */
.main {
  max-width: 480px;
  margin: 0 auto;
  padding: 16px 16px 100px;
}

.section-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--text-2);
  letter-spacing: .5px;
  text-transform: uppercase;
  margin-bottom: 12px;
  margin-top: 4px;
  padding-left: 2px;
}

/* =========================================
   STAFF GRID - 2 kolom
   ========================================= */
.staff-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}

.staff-card {
  background: var(--surface);
  border-radius: var(--radius);
  padding: 14px 14px 12px;
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
  cursor: pointer;
  transition: all .2s ease;
  position: relative;
  overflow: hidden;
  -webkit-tap-highlight-color: transparent;
  user-select: none;
}
.staff-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  border-radius: var(--radius) var(--radius) 0 0;
}
.staff-card.hutang::before { background: linear-gradient(90deg, var(--red), #F87171); }
.staff-card.deposit::before { background: linear-gradient(90deg, var(--blue), #60A5FA); }
.staff-card.netral::before { background: linear-gradient(90deg, #D1D5DB, #9CA3AF); }

.staff-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
.staff-card:active { transform: translateY(0); box-shadow: var(--shadow-sm); }

.staff-avatar {
  width: 38px; height: 38px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
  font-weight: 700;
  margin-bottom: 10px;
  font-style: normal;
}
.staff-card.hutang .staff-avatar { background: var(--red-soft); color: var(--red); }
.staff-card.deposit .staff-avatar { background: var(--blue-soft); color: var(--blue); }
.staff-card.netral .staff-avatar { background: var(--surface2); color: var(--text-2); }

.staff-name {
  font-size: 13px;
  font-weight: 600;
  color: var(--text);
  margin-bottom: 6px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.staff-saldo {
  font-size: 15px;
  font-weight: 700;
  letter-spacing: -.3px;
}
.staff-card.hutang .staff-saldo { color: var(--red); }
.staff-card.deposit .staff-saldo { color: var(--blue); }
.staff-card.netral .staff-saldo { color: var(--text-2); }

.staff-saldo-label {
  font-size: 10px;
  font-weight: 500;
  margin-top: 2px;
}
.staff-card.hutang .staff-saldo-label { color: var(--red-mid); }
.staff-card.deposit .staff-saldo-label { color: var(--blue-mid); }
.staff-card.netral .staff-saldo-label { color: var(--text-3); }

.staff-arrow {
  position: absolute;
  top: 12px; right: 12px;
  font-size: 12px;
  color: var(--text-3);
}

/* =========================================
   FLOATING BUTTON
   ========================================= */
.fab {
  position: fixed;
  bottom: 28px;
  right: 50%;
  transform: translateX(50%);
  /* max-width agar FAB tetap di tengah konten di desktop */
  z-index: 200;
}
@media (min-width: 520px) {
  .fab { right: calc(50% - 240px + 20px); transform: none; }
}
.fab button {
  background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
  color: #fff;
  border: none;
  border-radius: 50px;
  padding: 14px 22px;
  font-size: 14px;
  font-weight: 600;
  font-family: var(--font);
  cursor: pointer;
  box-shadow: 0 4px 20px rgba(59,130,246,.45);
  display: flex; align-items: center; gap: 8px;
  transition: all .2s;
  white-space: nowrap;
}
.fab button:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(59,130,246,.5); }
.fab button:active { transform: translateY(0); }

/* =========================================
   MODAL BACKDROP
   ========================================= */
.modal-backdrop {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.45);
  z-index: 300;
  align-items: flex-end;
  justify-content: center;
  backdrop-filter: blur(2px);
}
.modal-backdrop.active { display: flex; }

/* =========================================
   MODAL BASE (bottom sheet)
   ========================================= */
.modal {
  background: var(--surface);
  border-radius: 22px 22px 0 0;
  width: 100%;
  max-width: 480px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 0;
  animation: slideUp .28s cubic-bezier(.22,.68,0,1.2);
  position: relative;
}
@keyframes slideUp {
  from { transform: translateY(100%); opacity: 0; }
  to   { transform: translateY(0);    opacity: 1; }
}

.modal-handle {
  width: 36px; height: 4px;
  background: var(--border);
  border-radius: 2px;
  margin: 12px auto 0;
}

.modal-header {
  padding: 16px 20px 12px;
  border-bottom: 1px solid var(--border);
}
.modal-title {
  font-size: 16px;
  font-weight: 700;
  letter-spacing: -.2px;
}
.modal-subtitle {
  font-size: 12px;
  color: var(--text-2);
  margin-top: 2px;
}
.modal-close {
  position: absolute;
  top: 16px; right: 20px;
  width: 28px; height: 28px;
  border: none;
  background: var(--surface2);
  border-radius: 50%;
  cursor: pointer;
  font-size: 14px;
  display: flex; align-items: center; justify-content: center;
  color: var(--text-2);
  transition: all .15s;
}
.modal-close:hover { background: var(--border); }

.modal-body { padding: 16px 20px 32px; }

/* =========================================
   ACTION BUTTONS (di modal staff)
   ========================================= */
.action-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 10px;
  margin-top: 4px;
}
.action-btn {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 16px 8px;
  cursor: pointer;
  text-align: center;
  transition: all .2s;
  font-family: var(--font);
  -webkit-tap-highlight-color: transparent;
}
.action-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-sm); }
.action-btn:active { transform: scale(.97); }
.action-btn .ab-icon {
  font-size: 24px;
  display: block;
  margin-bottom: 6px;
}
.action-btn .ab-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--text);
}
.action-btn.pembelian { border-color: #FECACA; background: var(--red-soft); }
.action-btn.pembelian .ab-label { color: var(--red); }
.action-btn.pembayaran { border-color: #BBF7D0; background: var(--green-soft); }
.action-btn.pembayaran .ab-label { color: var(--green); }
.action-btn.riwayat { border-color: var(--blue-mid); background: var(--blue-soft); }
.action-btn.riwayat .ab-label { color: var(--blue); }

/* Staff info di modal aksi */
.modal-staff-info {
  background: var(--surface2);
  border-radius: var(--radius-sm);
  padding: 12px 14px;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.modal-staff-avatar {
  width: 42px; height: 42px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px;
  font-weight: 700;
}
.modal-staff-avatar.hutang { background: var(--red-soft); color: var(--red); }
.modal-staff-avatar.deposit { background: var(--blue-soft); color: var(--blue); }
.modal-staff-avatar.netral { background: var(--border); color: var(--text-2); }
.modal-staff-info .name { font-size: 14px; font-weight: 700; }
.modal-staff-info .saldo { font-size: 12px; font-weight: 600; }
.modal-staff-info .saldo.hutang { color: var(--red); }
.modal-staff-info .saldo.deposit { color: var(--blue); }
.modal-staff-info .saldo.netral { color: var(--text-2); }

/* =========================================
   FORM STYLES
   ========================================= */
.form-group { margin-bottom: 14px; }
.form-label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: var(--text-2);
  margin-bottom: 6px;
  letter-spacing: .2px;
}
.form-control {
  width: 100%;
  padding: 11px 14px;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-sm);
  font-size: 14px;
  font-family: var(--font);
  color: var(--text);
  background: var(--surface);
  outline: none;
  transition: border-color .15s;
  -webkit-appearance: none;
}
.form-control:focus { border-color: var(--blue); }
.form-control[readonly] { background: var(--surface2); color: var(--text-2); }

/* Tanggal radio */
.date-radio-group { display: flex; gap: 8px; flex-wrap: wrap; }
.date-radio {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 8px 12px;
  border: 1.5px solid var(--border);
  border-radius: 8px;
  cursor: pointer;
  font-size: 13px;
  font-weight: 500;
  color: var(--text-2);
  transition: all .15s;
  background: var(--surface);
}
.date-radio.active { border-color: var(--blue); background: var(--blue-soft); color: var(--blue); }
.date-radio input { display: none; }
.date-picker-wrap { margin-top: 8px; display: none; }
.date-picker-wrap.show { display: block; }

.btn-submit {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: var(--radius-sm);
  font-size: 15px;
  font-weight: 700;
  font-family: var(--font);
  cursor: pointer;
  transition: all .2s;
  margin-top: 6px;
}
.btn-submit.red { background: linear-gradient(135deg, #EF4444, #DC2626); color: #fff; }
.btn-submit.green { background: linear-gradient(135deg, #10B981, #059669); color: #fff; }
.btn-submit:hover { transform: translateY(-1px); box-shadow: var(--shadow-md); }
.btn-submit:active { transform: translateY(0); }
.btn-submit:disabled { opacity: .6; cursor: default; transform: none; }

/* =========================================
   RIWAYAT / TIMELINE
   ========================================= */
.riwayat-summary {
  background: var(--surface2);
  border-radius: var(--radius-sm);
  padding: 14px 16px;
  margin-bottom: 20px;
  text-align: center;
}
.riwayat-summary .rs-label { font-size: 11px; color: var(--text-2); font-weight: 500; }
.riwayat-summary .rs-value { font-size: 22px; font-weight: 800; letter-spacing: -.5px; margin-top: 2px; }
.riwayat-summary .rs-value.hutang { color: var(--red); }
.riwayat-summary .rs-value.deposit { color: var(--blue); }
.riwayat-summary .rs-value.netral { color: var(--text-2); }
.riwayat-summary .rs-sub { font-size: 11px; font-weight: 600; margin-top: 3px; }
.riwayat-summary .rs-sub.hutang { color: var(--red); }
.riwayat-summary .rs-sub.deposit { color: var(--blue); }

.timeline { position: relative; padding-left: 28px; }
.timeline::before {
  content: '';
  position: absolute;
  left: 10px; top: 0; bottom: 0;
  width: 2px;
  background: var(--border);
  border-radius: 1px;
}

.timeline-date-group { margin-bottom: 20px; }
.timeline-date-label {
  font-size: 11px;
  font-weight: 600;
  color: var(--text-2);
  letter-spacing: .5px;
  text-transform: uppercase;
  margin-bottom: 10px;
  padding-left: 4px;
  position: relative;
}

.timeline-item {
  position: relative;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 11px 12px;
  margin-bottom: 8px;
  display: flex;
  align-items: flex-start;
  gap: 10px;
}
.timeline-item::before {
  content: '';
  position: absolute;
  left: -22px; top: 14px;
  width: 10px; height: 10px;
  border-radius: 50%;
  border: 2px solid var(--surface);
}
.timeline-item.pembelian::before { background: var(--red); }
.timeline-item.pembayaran::before { background: var(--green); }

.timeline-dot {
  width: 28px; height: 28px;
  border-radius: 7px;
  flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 14px;
}
.timeline-item.pembelian .timeline-dot { background: var(--red-soft); }
.timeline-item.pembayaran .timeline-dot { background: var(--green-soft); }

.timeline-content { flex: 1; min-width: 0; }
.timeline-tipe { font-size: 11px; font-weight: 600; margin-bottom: 1px; }
.timeline-item.pembelian .timeline-tipe { color: var(--red); }
.timeline-item.pembayaran .timeline-tipe { color: var(--green); }
.timeline-ket { font-size: 13px; font-weight: 500; color: var(--text); margin-bottom: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.timeline-ket:empty::after { content: '—'; color: var(--text-3); font-style: italic; font-size: 12px; }
.timeline-nominal { font-size: 14px; font-weight: 700; flex-shrink: 0; }
.timeline-item.pembelian .timeline-nominal { color: var(--red); }
.timeline-item.pembayaran .timeline-nominal { color: var(--green); }

.timeline-delete {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--text-3);
  font-size: 12px;
  padding: 2px 4px;
  border-radius: 4px;
  transition: all .15s;
  flex-shrink: 0;
  margin-top: 2px;
}
.timeline-delete:hover { color: var(--red); background: var(--red-soft); }

.empty-state {
  text-align: center;
  padding: 40px 20px;
  color: var(--text-3);
}
.empty-state .es-icon { font-size: 40px; margin-bottom: 12px; }
.empty-state p { font-size: 13px; }

/* =========================================
   TOAST
   ========================================= */
.toast {
  position: fixed;
  bottom: 90px;
  left: 50%;
  transform: translateX(-50%) translateY(20px);
  background: #1A1D23;
  color: #fff;
  padding: 12px 20px;
  border-radius: 50px;
  font-size: 13px;
  font-weight: 500;
  z-index: 999;
  opacity: 0;
  transition: all .3s cubic-bezier(.22,.68,0,1.2);
  white-space: nowrap;
  pointer-events: none;
}
.toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
.toast.success::before { content: '✓  '; color: #34D399; }
.toast.error::before { content: '✕  '; color: #F87171; }

/* =========================================
   LOADING
   ========================================= */
.loading {
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  padding: 60px 20px;
  gap: 14px;
  color: var(--text-2);
  font-size: 13px;
}
.spinner {
  width: 32px; height: 32px;
  border: 3px solid var(--border);
  border-top-color: var(--blue);
  border-radius: 50%;
  animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* =========================================
   NOMINAL INPUT WITH Rp PREFIX
   ========================================= */
.nominal-wrap {
  display: flex;
  align-items: center;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-sm);
  background: var(--surface);
  overflow: hidden;
  transition: border-color .15s;
}
.nominal-wrap:focus-within { border-color: var(--blue); }
.nominal-prefix {
  padding: 11px 12px 11px 14px;
  font-size: 14px;
  font-weight: 600;
  color: var(--text-2);
  background: var(--surface2);
  border-right: 1.5px solid var(--border);
  white-space: nowrap;
  flex-shrink: 0;
  user-select: none;
}
.nominal-input {
  flex: 1;
  padding: 11px 14px;
  border: none;
  outline: none;
  font-size: 16px;
  font-weight: 600;
  font-family: var(--font);
  color: var(--text);
  background: transparent;
  letter-spacing: .3px;
  min-width: 0;
}
.nominal-input::placeholder { font-weight: 400; font-size: 14px; color: var(--text-3); letter-spacing: 0; }

/* =========================================
   ADD STAFF MODAL
   ========================================= */
.modal-add-staff .modal-body { padding: 16px 20px 40px; }

/* =========================================
   RESPONSIVE
   ========================================= */
@media (min-width: 480px) {
  .modal-backdrop { align-items: center; }
  .modal {
    border-radius: var(--radius-lg);
    max-height: 85vh;
    margin: 0;
  }
}
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="header-inner">
    <div class="header-logo">
      <div class="header-icon">💼</div>
      <div>
        <h1>Kasbon RJS</h1>
        <p>Pencatatan Keuangan Kantor</p>
      </div>
    </div>
    <button class="header-refresh" onclick="loadStaff()" title="Refresh">↻</button>
  </div>
</header>

<!-- SUMMARY BAR -->
<div class="summary-bar">
  <div class="summary-card hutang">
    <div class="label">Total Hutang</div>
    <div class="value" id="total-hutang">Rp 0</div>
  </div>
  <div class="summary-card deposit">
    <div class="label">Total Deposit</div>
    <div class="value" id="total-deposit">Rp 0</div>
  </div>
</div>

<!-- MAIN -->
<main class="main">
  <div class="section-label">Daftar Staff</div>
  <div id="staff-grid" class="staff-grid">
    <div class="loading" style="grid-column:1/-1">
      <div class="spinner"></div>
      <span>Memuat data...</span>
    </div>
  </div>
</main>

<!-- FAB -->
<div class="fab">
  <button onclick="openAddStaff()">
    <span>＋</span> Tambah Staff
  </button>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<!-- =============================================
     MODAL: AKSI STAFF
     ============================================= -->
<div class="modal-backdrop" id="modal-aksi">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="modal-header">
      <div class="modal-title" id="aksi-title">Pilih Aksi</div>
      <div class="modal-subtitle" id="aksi-subtitle"></div>
      <button class="modal-close" onclick="closeModal('modal-aksi')">✕</button>
    </div>
    <div class="modal-body">
      <div class="modal-staff-info">
        <div class="modal-staff-avatar" id="aksi-avatar"></div>
        <div>
          <div class="name" id="aksi-name-display"></div>
          <div class="saldo" id="aksi-saldo-display"></div>
        </div>
      </div>
      <div class="action-grid">
        <button class="action-btn pembelian" onclick="openPembelian()">
          <span class="ab-icon">🛒</span>
          <span class="ab-label">Pembelian</span>
        </button>
        <button class="action-btn pembayaran" onclick="openPembayaran()">
          <span class="ab-icon">💵</span>
          <span class="ab-label">Pembayaran</span>
        </button>
        <button class="action-btn riwayat" onclick="openRiwayat()">
          <span class="ab-icon">📋</span>
          <span class="ab-label">Riwayat</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- =============================================
     MODAL: PEMBELIAN
     ============================================= -->
<div class="modal-backdrop" id="modal-pembelian">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="modal-header">
      <div class="modal-title">🛒 Catat Pembelian</div>
      <div class="modal-subtitle">Mengurangi saldo staff</div>
      <button class="modal-close" onclick="closeModal('modal-pembelian')">✕</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Nama Staff</label>
        <input type="text" class="form-control" id="beli-nama" readonly>
      </div>
      <div class="form-group">
        <label class="form-label">Tanggal</label>
        <div class="date-radio-group">
          <label class="date-radio active" id="beli-radio-hari">
            <input type="radio" name="beli-tgl" value="today" checked onchange="handleDateChange('beli')">
            Hari ini
          </label>
          <label class="date-radio" id="beli-radio-kemarin">
            <input type="radio" name="beli-tgl" value="yesterday" onchange="handleDateChange('beli')">
            Kemarin
          </label>
          <label class="date-radio" id="beli-radio-custom">
            <input type="radio" name="beli-tgl" value="custom" onchange="handleDateChange('beli')">
            Pilih tanggal
          </label>
        </div>
        <div class="date-picker-wrap" id="beli-date-picker">
          <input type="date" class="form-control" id="beli-tanggal-custom" style="margin-top:0">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Nominal</label>
        <div class="nominal-wrap">
          <span class="nominal-prefix">Rp</span>
          <input type="text" class="nominal-input" id="beli-nominal" placeholder="0" inputmode="numeric" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="beli-ket" placeholder="Contoh: Nasi goreng, rokok, dll">
      </div>
      <button class="btn-submit red" onclick="submitPembelian()">Simpan Pembelian</button>
    </div>
  </div>
</div>

<!-- =============================================
     MODAL: PEMBAYARAN
     ============================================= -->
<div class="modal-backdrop" id="modal-pembayaran">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="modal-header">
      <div class="modal-title">💵 Catat Pembayaran</div>
      <div class="modal-subtitle">Menambah saldo / lunasi hutang</div>
      <button class="modal-close" onclick="closeModal('modal-pembayaran')">✕</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Nama Staff</label>
        <input type="text" class="form-control" id="bayar-nama" readonly>
      </div>
      <div class="form-group">
        <label class="form-label">Tanggal</label>
        <div class="date-radio-group">
          <label class="date-radio active" id="bayar-radio-hari">
            <input type="radio" name="bayar-tgl" value="today" checked onchange="handleDateChange('bayar')">
            Hari ini
          </label>
          <label class="date-radio" id="bayar-radio-kemarin">
            <input type="radio" name="bayar-tgl" value="yesterday" onchange="handleDateChange('bayar')">
            Kemarin
          </label>
          <label class="date-radio" id="bayar-radio-custom">
            <input type="radio" name="bayar-tgl" value="custom" onchange="handleDateChange('bayar')">
            Pilih tanggal
          </label>
        </div>
        <div class="date-picker-wrap" id="bayar-date-picker">
          <input type="date" class="form-control" id="bayar-tanggal-custom" style="margin-top:0">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Nominal</label>
        <div class="nominal-wrap">
          <span class="nominal-prefix">Rp</span>
          <input type="text" class="nominal-input" id="bayar-nominal" placeholder="0" inputmode="numeric" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Keterangan</label>
        <input type="text" class="form-control" id="bayar-ket" placeholder="Contoh: Bayar hutang minggu ini">
      </div>
      <button class="btn-submit green" onclick="submitPembayaran()">Simpan Pembayaran</button>
    </div>
  </div>
</div>

<!-- =============================================
     MODAL: RIWAYAT
     ============================================= -->
<div class="modal-backdrop" id="modal-riwayat">
  <div class="modal">
    <div class="modal-handle"></div>
    <div class="modal-header">
      <div class="modal-title" id="riwayat-title">📋 Riwayat</div>
      <div class="modal-subtitle">Semua transaksi terurut waktu</div>
      <button class="modal-close" onclick="closeModal('modal-riwayat')">✕</button>
    </div>
    <div class="modal-body" id="riwayat-body">
      <div class="loading">
        <div class="spinner"></div>
        <span>Memuat riwayat...</span>
      </div>
    </div>
  </div>
</div>

<!-- =============================================
     MODAL: TAMBAH STAFF
     ============================================= -->
<div class="modal-backdrop" id="modal-add-staff">
  <div class="modal modal-add-staff">
    <div class="modal-handle"></div>
    <div class="modal-header">
      <div class="modal-title">👤 Tambah Staff</div>
      <button class="modal-close" onclick="closeModal('modal-add-staff')">✕</button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Nama Staff</label>
        <input type="text" class="form-control" id="new-staff-nama" placeholder="Masukkan nama staff">
      </div>
      <button class="btn-submit" style="background: linear-gradient(135deg,#3B82F6,#2563EB);color:#fff" onclick="submitAddStaff()">Tambah Staff</button>
    </div>
  </div>
</div>

<script>
// =============================================
// STATE
// =============================================
let staffData = [];
let activeStaff = null;

const today = new Date();
const todayStr = today.toISOString().split('T')[0];
const yesterdayStr = new Date(today - 86400000).toISOString().split('T')[0];

// =============================================
// HELPERS
// =============================================
function fmt(n) {
  const abs = Math.abs(n);
  return 'Rp ' + abs.toLocaleString('id-ID');
}

function fmtTanggal(str) {
  const d = new Date(str + 'T00:00:00');
  return d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
}

function fmtTanggalShort(str) {
  const d = new Date(str + 'T00:00:00');
  if (str === todayStr) return 'Hari ini';
  if (str === yesterdayStr) return 'Kemarin';
  return d.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
}

function getInitials(nama) {
  return nama.split(' ').map(w => w[0]).join('').substring(0,2).toUpperCase();
}

function getSaldoClass(saldo) {
  if (saldo < 0) return 'hutang';
  if (saldo > 0) return 'deposit';
  return 'netral';
}

function showToast(msg, type = 'success') {
  const t = document.getElementById('toast');
  t.className = 'toast ' + type;
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}

// =============================================
// MODAL CONTROL
// =============================================
function openModal(id) {
  document.getElementById(id).classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeModal(id) {
  document.getElementById(id).classList.remove('active');
  // Hanya unlock scroll jika tidak ada modal lain yang aktif
  if (!document.querySelector('.modal-backdrop.active')) {
    document.body.style.overflow = '';
  }
}

// Tutup modal saat klik backdrop
document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
  backdrop.addEventListener('click', function(e) {
    if (e.target === this) closeModal(this.id);
  });
});

// =============================================
// LOAD STAFF
// =============================================
async function loadStaff() {
  const grid = document.getElementById('staff-grid');
  grid.innerHTML = '<div class="loading" style="grid-column:1/-1"><div class="spinner"></div><span>Memuat data...</span></div>';

  const res = await fetch('api.php?action=get_staff');
  const json = await res.json();
  if (!json.success) { grid.innerHTML = '<p style="color:red;padding:20px">Gagal memuat data.</p>'; return; }

  staffData = json.data;
  renderStaff(staffData);
  updateSummary(staffData);
}

function renderStaff(data) {
  const grid = document.getElementById('staff-grid');
  if (!data.length) {
    grid.innerHTML = '<div class="empty-state" style="grid-column:1/-1"><div class="es-icon">👥</div><p>Belum ada staff terdaftar.</p></div>';
    return;
  }

  grid.innerHTML = data.map(s => {
    const cls = getSaldoClass(parseFloat(s.saldo));
    const saldoNum = parseFloat(s.saldo);
    const saldoLabel = cls === 'hutang' ? 'Hutang' : cls === 'deposit' ? 'Deposit' : 'Lunas';
    const prefix = cls === 'hutang' ? '−' : cls === 'deposit' ? '+' : '';
    return `
      <div class="staff-card ${cls}" onclick="openAksi(${s.id})">
        <div class="staff-arrow">›</div>
        <div class="staff-avatar">${getInitials(s.nama)}</div>
        <div class="staff-name">${escHtml(s.nama)}</div>
        <div class="staff-saldo">${prefix}${fmt(saldoNum)}</div>
        <div class="staff-saldo-label">${saldoLabel}</div>
      </div>
    `;
  }).join('');
}

function updateSummary(data) {
  let hutang = 0, deposit = 0;
  data.forEach(s => {
    const n = parseFloat(s.saldo);
    if (n < 0) hutang += Math.abs(n);
    else if (n > 0) deposit += n;
  });
  document.getElementById('total-hutang').textContent = fmt(hutang);
  document.getElementById('total-deposit').textContent = fmt(deposit);
}

function escHtml(s) {
  return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// =============================================
// MODAL AKSI STAFF
// =============================================
function openAksi(staffId) {
  activeStaff = staffData.find(s => s.id == staffId);
  if (!activeStaff) return;

  const cls = getSaldoClass(parseFloat(activeStaff.saldo));
  const saldoNum = parseFloat(activeStaff.saldo);
  const prefix = cls === 'hutang' ? '−' : cls === 'deposit' ? '+' : '';
  const label = cls === 'hutang' ? 'Hutang' : cls === 'deposit' ? 'Deposit' : 'Saldo lunas';

  document.getElementById('aksi-title').textContent = activeStaff.nama;
  document.getElementById('aksi-subtitle').textContent = 'Pilih tindakan';
  document.getElementById('aksi-avatar').textContent = getInitials(activeStaff.nama);
  document.getElementById('aksi-avatar').className = 'modal-staff-avatar ' + cls;
  document.getElementById('aksi-name-display').textContent = activeStaff.nama;
  document.getElementById('aksi-saldo-display').textContent = `${label}: ${prefix}${fmt(saldoNum)}`;
  document.getElementById('aksi-saldo-display').className = 'saldo ' + cls;

  openModal('modal-aksi');
}

// =============================================
// MODAL PEMBELIAN
// =============================================
function openPembelian() {
  closeModal('modal-aksi');
  document.getElementById('beli-nama').value = activeStaff.nama;
  document.getElementById('beli-nominal').value = '';
  document.getElementById('beli-ket').value = '';
  resetDateRadio('beli');
  openModal('modal-pembelian');
  setTimeout(() => document.getElementById('beli-nominal').focus(), 300);
}

async function submitPembelian() {
  const nominal = parseNominal('beli-nominal');
  const ket = document.getElementById('beli-ket').value;
  const tanggal = getSelectedDate('beli');

  if (!nominal || nominal <= 0) { showToast('Masukkan nominal yang valid', 'error'); return; }

  const btn = document.querySelector('#modal-pembelian .btn-submit');
  btn.disabled = true; btn.textContent = 'Menyimpan...';

  const fd = new FormData();
  fd.append('action', 'tambah_pembelian');
  fd.append('staff_id', activeStaff.id);
  fd.append('tanggal', tanggal);
  fd.append('nominal', nominal);
  fd.append('keterangan', ket);

  const res = await fetch('api.php', { method: 'POST', body: fd });
  const json = await res.json();

  btn.disabled = false; btn.textContent = 'Simpan Pembelian';

  if (json.success) {
    closeModal('modal-pembelian');
    showToast('Pembelian berhasil dicatat ✓');
    loadStaff();
  } else {
    showToast(json.error || 'Gagal menyimpan', 'error');
  }
}

// =============================================
// MODAL PEMBAYARAN
// =============================================
function openPembayaran() {
  closeModal('modal-aksi');
  document.getElementById('bayar-nama').value = activeStaff.nama;
  document.getElementById('bayar-nominal').value = '';
  document.getElementById('bayar-ket').value = '';
  resetDateRadio('bayar');
  openModal('modal-pembayaran');
  setTimeout(() => document.getElementById('bayar-nominal').focus(), 300);
}

async function submitPembayaran() {
  const nominal = parseNominal('bayar-nominal');
  const ket = document.getElementById('bayar-ket').value;
  const tanggal = getSelectedDate('bayar');

  if (!nominal || nominal <= 0) { showToast('Masukkan nominal yang valid', 'error'); return; }

  const btn = document.querySelector('#modal-pembayaran .btn-submit');
  btn.disabled = true; btn.textContent = 'Menyimpan...';

  const fd = new FormData();
  fd.append('action', 'tambah_pembayaran');
  fd.append('staff_id', activeStaff.id);
  fd.append('tanggal', tanggal);
  fd.append('nominal', nominal);
  fd.append('keterangan', ket);

  const res = await fetch('api.php', { method: 'POST', body: fd });
  const json = await res.json();

  btn.disabled = false; btn.textContent = 'Simpan Pembayaran';

  if (json.success) {
    closeModal('modal-pembayaran');
    showToast('Pembayaran berhasil dicatat ✓');
    loadStaff();
  } else {
    showToast(json.error || 'Gagal menyimpan', 'error');
  }
}

// =============================================
// MODAL RIWAYAT
// =============================================
async function openRiwayat() {
  closeModal('modal-aksi');
  document.getElementById('riwayat-title').textContent = '📋 Riwayat — ' + activeStaff.nama;
  document.getElementById('riwayat-body').innerHTML = '<div class="loading"><div class="spinner"></div><span>Memuat riwayat...</span></div>';
  openModal('modal-riwayat');

  const res = await fetch('api.php?action=get_riwayat&staff_id=' + activeStaff.id);
  const json = await res.json();

  if (!json.success) {
    document.getElementById('riwayat-body').innerHTML = '<p style="color:red">Gagal memuat riwayat.</p>';
    return;
  }

  renderRiwayat(json.staff, json.transaksi);
}

function renderRiwayat(staff, transaksi) {
  const saldoNum = parseFloat(staff.saldo);
  const cls = getSaldoClass(saldoNum);
  const prefix = cls === 'hutang' ? '−' : cls === 'deposit' ? '+' : '';
  const label = cls === 'hutang' ? '🔴 Masih punya hutang' : cls === 'deposit' ? '🔵 Sisa deposit' : '✅ Lunas';

  let html = `
    <div class="riwayat-summary">
      <div class="rs-label">Saldo Saat Ini</div>
      <div class="rs-value ${cls}">${prefix}${fmt(saldoNum)}</div>
      <div class="rs-sub ${cls}">${label}</div>
    </div>
  `;

  if (!transaksi.length) {
    html += '<div class="empty-state"><div class="es-icon">📭</div><p>Belum ada transaksi.</p></div>';
    document.getElementById('riwayat-body').innerHTML = html;
    return;
  }

  // Group by tanggal
  const groups = {};
  transaksi.forEach(t => {
    if (!groups[t.tanggal]) groups[t.tanggal] = [];
    groups[t.tanggal].push(t);
  });

  html += '<div class="timeline">';
  Object.keys(groups).sort((a,b) => b.localeCompare(a)).forEach(tgl => {
    html += `<div class="timeline-date-group">
      <div class="timeline-date-label">${fmtTanggal(tgl)}</div>
    `;
    groups[tgl].forEach(t => {
      const icon = t.tipe === 'pembelian' ? '🛒' : '💵';
      const prefix2 = t.tipe === 'pembelian' ? '−' : '+';
      html += `
        <div class="timeline-item ${t.tipe}">
          <div class="timeline-dot">${icon}</div>
          <div class="timeline-content">
            <div class="timeline-tipe">${t.tipe === 'pembelian' ? 'Pembelian' : 'Pembayaran'}</div>
            <div class="timeline-ket">${escHtml(t.keterangan || '')}</div>
          </div>
          <div class="timeline-nominal">${prefix2}${fmt(parseFloat(t.nominal))}</div>
          <button class="timeline-delete" onclick="hapusTransaksi(${t.id}, ${staff.id})" title="Hapus">🗑</button>
        </div>
      `;
    });
    html += '</div>';
  });
  html += '</div>';

  document.getElementById('riwayat-body').innerHTML = html;
}

async function hapusTransaksi(id, staffId) {
  if (!confirm('Hapus transaksi ini?')) return;

  const fd = new FormData();
  fd.append('action', 'hapus_transaksi');
  fd.append('id', id);

  const res = await fetch('api.php', { method: 'POST', body: fd });
  const json = await res.json();

  if (json.success) {
    showToast('Transaksi dihapus');
    // Refresh riwayat dan staff data
    activeStaff = { ...activeStaff, id: staffId };
    openRiwayat();
    loadStaff();
  } else {
    showToast(json.error || 'Gagal menghapus', 'error');
  }
}

// =============================================
// TAMBAH STAFF
// =============================================
function openAddStaff() {
  document.getElementById('new-staff-nama').value = '';
  openModal('modal-add-staff');
}

async function submitAddStaff() {
  const nama = document.getElementById('new-staff-nama').value.trim();
  if (!nama) { showToast('Nama tidak boleh kosong', 'error'); return; }

  const fd = new FormData();
  fd.append('action', 'add_staff');
  fd.append('nama', nama);

  const res = await fetch('api.php', { method: 'POST', body: fd });
  const json = await res.json();

  if (json.success) {
    closeModal('modal-add-staff');
    showToast('Staff berhasil ditambahkan ✓');
    loadStaff();
  } else {
    showToast(json.error || 'Gagal menambah staff', 'error');
  }
}

// =============================================
// DATE RADIO HELPER
// =============================================
function resetDateRadio(prefix) {
  document.querySelectorAll(`[name="${prefix}-tgl"]`).forEach(r => r.checked = r.value === 'today');
  document.querySelectorAll(`label[id^="${prefix}-radio"]`).forEach(l => l.classList.remove('active'));
  document.getElementById(`${prefix}-radio-hari`).classList.add('active');
  document.getElementById(`${prefix}-date-picker`).classList.remove('show');
  // Set default untuk custom input
  document.getElementById(`${prefix}-tanggal-custom`).value = todayStr;
}

function handleDateChange(prefix) {
  const selected = document.querySelector(`[name="${prefix}-tgl"]:checked`).value;
  document.querySelectorAll(`label[id^="${prefix}-radio"]`).forEach(l => l.classList.remove('active'));
  const map = { today: 'hari', yesterday: 'kemarin', custom: 'custom' };
  document.getElementById(`${prefix}-radio-${map[selected]}`).classList.add('active');
  const dp = document.getElementById(`${prefix}-date-picker`);
  dp.classList.toggle('show', selected === 'custom');
}

function getSelectedDate(prefix) {
  const val = document.querySelector(`[name="${prefix}-tgl"]:checked`).value;
  if (val === 'today') return todayStr;
  if (val === 'yesterday') return yesterdayStr;
  return document.getElementById(`${prefix}-tanggal-custom`).value || todayStr;
}

// =============================================
// NOMINAL FORMAT HELPERS
// =============================================

// Format angka jadi string dengan titik ribuan: 15000 → "15.000"
function formatRibuan(val) {
  const angka = val.replace(/\D/g, ''); // hapus semua bukan digit
  if (!angka) return '';
  return parseInt(angka, 10).toLocaleString('id-ID');
}

// Ambil nilai murni angka dari field bertitik
function parseNominal(fieldId) {
  const raw = document.getElementById(fieldId).value;
  const bersih = raw.replace(/\./g, '').replace(/\D/g, '');
  return bersih ? parseInt(bersih, 10) : 0;
}

// Pasang event listener format otomatis ke input nominal
function bindNominalInput(fieldId) {
  const el = document.getElementById(fieldId);
  el.addEventListener('input', function() {
    const pos = this.selectionStart;
    const sebelum = this.value.length;
    this.value = formatRibuan(this.value);
    // Pertahankan posisi kursor agar tidak loncat ke ujung
    const sesudah = this.value.length;
    const diff = sesudah - sebelum;
    try { this.setSelectionRange(pos + diff, pos + diff); } catch(e) {}
  });
  // Tolak karakter non-digit (kecuali backspace, delete, arrow, dll)
  el.addEventListener('keydown', function(e) {
    const allowed = ['Backspace','Delete','ArrowLeft','ArrowRight','Tab','Home','End'];
    if (allowed.includes(e.key)) return;
    if (!/^\d$/.test(e.key)) e.preventDefault();
  });
  // Paste — bersihkan dan format
  el.addEventListener('paste', function(e) {
    e.preventDefault();
    const text = (e.clipboardData || window.clipboardData).getData('text');
    this.value = formatRibuan(text);
  });
}

// =============================================
// INIT
// =============================================
loadStaff();

// Pasang formatter ke kedua input nominal
bindNominalInput('beli-nominal');
bindNominalInput('bayar-nominal');

// Enter di form tambah staff
document.getElementById('new-staff-nama').addEventListener('keypress', e => {
  if (e.key === 'Enter') submitAddStaff();
});
</script>
</body>
</html>