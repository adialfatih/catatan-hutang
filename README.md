# Kasbon OB
### Aplikasi Pencatatan Keuangan Titipan Kantor

---

## Latar Belakang

Di banyak kantor, ada kebiasaan sehari-hari di mana karyawan menitipkan uang kepada Office Boy (OB) untuk dibelikan kebutuhan seperti makan siang, minuman, rokok, atau keperluan kecil lainnya. Transaksi semacam ini terjadi berulang kali setiap hari, melibatkan banyak orang, dan nilainya bervariasi.

Masalahnya, pencatatan selama ini sering dilakukan secara manual - di buku tulis, kertas coret-coretan, atau bahkan hanya mengandalkan ingatan. Cara ini rawan salah hitung, mudah lupa, dan sulit dipertanggungjawabkan ketika ada selisih antara OB dan karyawan yang bersangkutan.

**Kasbon OB** hadir sebagai solusi sederhana untuk masalah ini. Aplikasi ini dirancang khusus agar OB bisa mencatat setiap transaksi dengan cepat langsung dari HP, sehingga catatan keuangan selalu rapi, transparan, dan mudah ditelusuri kapan pun dibutuhkan.

---

## Tentang Aplikasi

Kasbon OB adalah aplikasi pencatatan keuangan berbasis web yang digunakan secara internal oleh Office Boy kantor. Aplikasi ini tidak memerlukan instalasi khusus di HP - cukup dibuka lewat browser.

Konsep saldo dalam aplikasi ini bekerja seperti dompet digital per orang:

- Ketika OB **membelikan sesuatu** untuk seorang karyawan, saldo karyawan tersebut **berkurang** (atau bertambah hutang).
- Ketika karyawan **membayar/setor uang** ke OB, saldo karyawan tersebut **bertambah** (hutang berkurang atau menjadi deposit).

Dengan begitu, OB maupun karyawan bisa sewaktu-waktu mengecek siapa yang masih punya hutang, berapa jumlahnya, dan apa saja yang pernah dibeli.

---

## Alur Aplikasi

### 1. Halaman Utama - Dashboard Staff

Saat aplikasi dibuka, halaman pertama langsung menampilkan kartu-kartu nama seluruh staff kantor yang terdiri dari:

- **Adi, Pak Ibnu, Pak Luthfi, Pak Hamid, Pak Zaenal, Bima, Mbak Isti, Safina, Rosi**

Setiap kartu menampilkan nama dan kondisi saldo terkini. Kartu diurutkan dari yang paling banyak hutangnya ke atas, sehingga OB langsung bisa melihat prioritas siapa yang perlu segera bayar.

Warna kartu membedakan kondisi saldo:

| Warna | Arti |
|---|---|
| 🔴 Merah | Masih punya hutang (saldo minus) |
| 🔵 Biru | Punya saldo deposit (sudah bayar lebih) |
| ⚪ Abu-abu | Saldo nol / lunas |

Di bagian atas halaman juga terdapat ringkasan total hutang seluruh staff dan total deposit seluruh staff.

---

### 2. Modal Aksi - Pilih Tindakan

Ketika salah satu kartu staff diklik, muncul bottom sheet berisi tiga pilihan tindakan:

- 🛒 **Pembelian** - mencatat OB membelikan sesuatu
- 💵 **Pembayaran** - mencatat karyawan menyetor/membayar ke OB
- 📋 **Riwayat** - melihat semua histori transaksi karyawan tersebut

---

### 3. Form Pembelian

Digunakan ketika OB membelikan sesuatu atas nama karyawan. Saldo karyawan akan **berkurang** sejumlah nominal yang diinput.

Form yang diisi:
- **Nama** - otomatis terisi sesuai kartu yang dipilih (tidak bisa diubah)
- **Tanggal** - pilih antara *Hari ini*, *Kemarin*, atau *Pilih tanggal* manual
- **Nominal** - diketik dalam format angka, otomatis tampil dengan pemisah ribuan (contoh: `25.000`)
- **Keterangan** - deskripsi apa yang dibeli (contoh: nasi goreng, rokok Sampoerna, dll)

---

### 4. Form Pembayaran

Digunakan ketika karyawan menyerahkan uang kepada OB sebagai pelunasan hutang atau deposit awal. Saldo karyawan akan **bertambah** sejumlah nominal yang diinput.

Form yang diisi sama seperti form pembelian, hanya keterangannya menyesuaikan konteks pembayaran.

---

### 5. Riwayat Transaksi

Menampilkan seluruh histori transaksi seorang karyawan dalam format timeline kronologis - dari yang terbaru hingga terlama. Setiap entri menunjukkan:

- Jenis transaksi (pembelian atau pembayaran)
- Keterangan barang/tujuan
- Nominal transaksi
- Tanggal kejadian

Di bagian atas riwayat ditampilkan **saldo terkini** karyawan tersebut beserta statusnya (hutang atau deposit). Setiap transaksi juga bisa dihapus jika terjadi kesalahan input - saldo akan otomatis terkoreksi saat transaksi dihapus.

---

### 6. Tambah Staff

Terdapat tombol mengambang (floating button) di bagian bawah halaman untuk menambah staff baru jika ada karyawan baru yang bergabung. Nama yang ditambahkan akan langsung muncul di dashboard dengan saldo awal nol.

---

## Struktur File

```
ob_finance/
├── index.php      ← Tampilan utama aplikasi (UI + logika frontend)
├── api.php        ← Backend: memproses semua transaksi dan query database
├── config.php     ← Konfigurasi koneksi ke database MySQL
└── database.sql   ← Skrip SQL untuk membuat tabel dan mengisi data staff awal
```

Aplikasi dibangun menggunakan **PHP murni** (tanpa framework) dan **MySQL**, sehingga kompatibel dengan hampir semua layanan shared hosting yang tersedia di pasaran.