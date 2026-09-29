<?php
session_start();

// 1. TANGKAP DATA DARI FORM ORDER
$user_id     = isset($_POST['user_id']) ? $_POST['user_id'] : '-';
$zone_id     = isset($_POST['zone_id']) ? $_POST['zone_id'] : '';
$nominal_raw = isset($_POST['paket_item']) ? $_POST['paket_item'] : '';

// Jika halaman diakses tanpa data POST (misal di-refresh), arahkan balik ke home
if (empty($nominal_raw) && !isset($_GET['batal'])) {
    header("Location: index.php");
    exit;
}

// 2. PROSES SWITCH CASE (LOGIKA UTAMA KAMU)
$nama_item = "Item Tidak Dikenal";
$harga     = 0;

switch ($nominal_raw) {
    // Mobile Legends
    case "50_diamonds": $nama_item = "MLBB - 50 Diamonds"; $harga = 15000; break;
    case "100_diamonds": $nama_item = "MLBB - 100 Diamonds"; $harga = 30000; break;
    case "250_diamonds": $nama_item = "MLBB - 250 Diamonds"; $harga = 75000; break;
    case "500_diamonds": $nama_item = "MLBB - 500 Diamonds"; $harga = 145000; break;
    case "1000_diamonds": $nama_item = "MLBB - 1000 Diamonds"; $harga = 290000; break;
    case "weekly_diamond_pass": $nama_item = "MLBB - Weekly Diamond Pass"; $harga = 30000; break;

    // Roblox
    case "80_robux": $nama_item = "Roblox - 80 Robux"; $harga = 16000; break;
    case "400_robux": $nama_item = "Roblox - 400 Robux"; $harga = 79000; break;
    case "800_robux": $nama_item = "Roblox - 800 Robux"; $harga = 155000; break;
    case "170_robux": $nama_item = "Roblox - 1700 Robux"; $harga = 320000; break;
    case "roblox_premium_450": $nama_item = "Roblox - Premium 450/Bulan"; $harga = 79000; break;
    case "roblox_premium_1000": $nama_item = "Roblox - Premium 1000/Bulan"; $harga = 155000; break;

    // Free Fire
    case "ff_50_diamonds": $nama_item = "Free Fire - 50 Diamonds"; $harga = 8000; break;
    case "ff_140_diamonds": $nama_item = "Free Fire - 140 Diamonds"; $harga = 22000; break;
    case "ff_355_diamonds": $nama_item = "Free Fire - 355 Diamonds"; $harga = 53000; break;
    case "ff_720_diamonds": $nama_item = "Free Fire - 720 Diamonds"; $harga = 105000; break;
    case "ff_membership_mingguan": $nama_item = "Free Fire - Membership Mingguan"; $harga = 33000; break;
    case "ff_membership_bulanan": $nama_item = "Free Fire - Membership Bulanan"; $harga = 115000; break;
}

// 3. GENERATE NOMOR INVOICE ACAK & WAKTU
$no_invoice = "GS-" . rand(100000, 999999);
$waktu_sekarang = date('Y-m-d H:i');

// --- SIMPAN SEMENTARA KE SESSION RIWAYAT ---
if ($harga > 0) {
    $_SESSION['riwayat'][] = [
        'waktu'   => $waktu_sekarang,
        'invoice' => $no_invoice,
        'game'    => $nama_item,
        'user_id' => $user_id . ($zone_id ? " ($zone_id)" : ""),
        'total'   => $harga
    ];
}

// --- LOGIKA BATALKAN PESANAN ---
// Jika user klik tombol batal, hapus data riwayat paling terakhir yang baru dimasukkan tadi
if (isset($_GET['batal']) && $_GET['batal'] == 'true') {
    if (!empty($_SESSION['riwayat'])) {
        array_pop($_SESSION['riwayat']); // Menghapus item terakhir di array riwayat
    }
    header("Location: index.php");
    exit;
}

// 4. MEMBUAT PESAN WHATSAPP
$nomor_wa_admin = "6285362084641"; // Gantilah dengan nomor WA toko kamu
$text_wa = "Halo Admin George Store, saya ingin menyelesaikan pembayaran top up.\n\n"
         . "🧾 *No. Invoice:* " . $no_invoice . "\n"
         . "🎮 *Produk:* " . $nama_item . "\n"
         . "🆔 *ID Pengguna:* " . $user_id . "\n"
         . "🌐 *Zone/Server:* " . ($zone_id ? $zone_id : '-') . "\n"
         . "💰 *Total Tagihan:* Rp " . number_format($harga, 0, ',', '.') . "\n\n"
         . "Mohon instruksi pembayarannya ya, terima kasih!";
$link_wa = "https://api.whatsapp.com/send?phone=" . $nomor_wa_admin . "&text=" . urlencode($text_wa);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>George Store - Detail Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body {
            background-color: #0b0f2b;
            color: #EAE0CF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card-invoice {
            background: rgba(75, 86, 148, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(114, 136, 174, 0.2);
            border-radius: 24px;
            width: 100%;
            max-width: 550px;
        }
        .invoice-header {
            background: rgba(11, 15, 43, 0.4);
            border-bottom: 1px solid rgba(114, 136, 174, 0.15);
            padding: 20px;
            text-align: center;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
        }
        .invoice-body { padding: 30px; }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }
        .detail-label { color: rgba(234, 224, 207, 0.6); }
        .detail-value { font-weight: 600; text-align: right; }
        .btn-wa {
            background: #EAE0CF;
            color: #0b0f2b;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            padding: 14px;
            width: 100%;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-wa:hover {
            background: #ffffff;
            box-shadow: 0 0 20px rgba(234, 224, 207, 0.4);
            color: #0b0f2b;
        }
        .btn-batal {
            color: rgba(234, 224, 207, 0.4);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }
        .btn-batal:hover { color: #EAE0CF; }
    </style>
  </head>
  <body>

    <div class="card-invoice shadow">
        <div class="invoice-header">
            <h5 class="fw-bold m-0">📄 DETAIL INVOICE TRANSAKSI</h5>
        </div>
        
        <div class="invoice-body">
            <p class="text-center text-white-50 small mb-4">Silakan periksa kembali rincian data Anda sebelum beralih ke pintu pembayaran.</p>
            
            <div class="detail-row">
                <span class="detail-label">No. Invoice</span>
                <span class="detail-value text-warning"><?php echo $no_invoice; ?></span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">ID Pengguna</span>
                <span class="detail-value"><?php echo htmlspecialchars($user_id); ?></span>
            </div>
            
            <?php if (!empty($zone_id)): ?>
            <div class="detail-row">
                <span class="detail-label">Zone / Server</span>
                <span class="detail-value"><?php echo htmlspecialchars($zone_id); ?></span>
            </div>
            <?php endif; ?>
            
            <div class="detail-row">
                <span class="detail-label">Produk Game</span>
                <span class="detail-value text-info"><?php echo $nama_item; ?></span>
            </div>
            
            <hr style="border-color: rgba(114, 136, 174, 0.2); margin: 20px 0;">
            
            <div class="detail-row align-items-center mb-4">
                <span class="fs-5 fw-bold">Total Tagihan</span>
                <span class="fs-4 fw-bold text-success">Rp <?php echo number_format($harga, 0, ',', '.'); ?></span>
            </div>
            
            <a href="<?php echo $link_wa; ?>" target="_blank" onclick="setTimeout(function(){ window.location.href='riwayat.php'; }, 1000);" class="btn-wa shadow mb-3">Selesaikan Pembayaran via WA 💬</a>
            
            <div class="text-center mt-3">
                <a href="proses_order.php?batal=true" class="btn-batal">Batalkan Pesanan</a>
            </div>
        </div>
    </div>

  </body>
</html>