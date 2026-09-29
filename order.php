<?php
// Ambil parameter game dari URL (contoh: order.php?game=mlbb)
$game_aktif = isset($_GET['game']) ? $_GET['game'] : 'mlbb';

// Inisialisasi variabel default
$judul_game = "Mobile Legends";
$nama_item = "Diamonds";
$pilihan_paket = [];

// PILIHAN NOMINAL DISINKRONKAN DENGAN SWITCH DI PROSES_ORDER.PHP
if ($game_aktif == 'roblox') {
    $judul_game = "Roblox";
    $nama_item = "Robux & Premium";
    $pilihan_paket = [
        ['value' => '80_robux', 'label' => '80 Robux', 'harga' => 'Rp 16.000'],
        ['value' => '400_robux', 'label' => '400 Robux', 'harga' => 'Rp 79.000'],
        ['value' => '800_robux', 'label' => '800 Robux', 'harga' => 'Rp 155.000'],
        ['value' => '170_robux', 'label' => '1700 Robux', 'harga' => 'Rp 320.000'],
        ['value' => 'roblox_premium_450', 'label' => 'Roblox Premium 450/Bulan', 'harga' => 'Rp 79.000'],
        ['value' => 'roblox_premium_1000', 'label' => 'Roblox Premium 1000/Bulan', 'harga' => 'Rp 155.000']
    ];
} elseif ($game_aktif == 'ff') {
    $judul_game = "Free Fire";
    $nama_item = "Diamonds & Membership";
    $pilihan_paket = [
        ['value' => 'ff_50_diamonds', 'label' => '50 Diamonds', 'harga' => 'Rp 8.000'],
        ['value' => 'ff_140_diamonds', 'label' => '140 Diamonds', 'harga' => 'Rp 22.000'],
        ['value' => 'ff_355_diamonds', 'label' => '355 Diamonds', 'harga' => 'Rp 53.000'],
        ['value' => 'ff_720_diamonds', 'label' => '720 Diamonds', 'harga' => 'Rp 105.000'],
        ['value' => 'ff_membership_mingguan', 'label' => 'Membership Mingguan', 'harga' => 'Rp 33.000'],
        ['value' => 'ff_membership_bulanan', 'label' => 'Membership Bulanan', 'harga' => 'Rp 115.000']
    ];
} else {
    // Default Mobile Legends (mlbb)
    $judul_game = "Mobile Legends";
    $nama_item = "Diamonds & Pass";
    $pilihan_paket = [
        ['value' => '50_diamonds', 'label' => '50 Diamonds', 'harga' => 'Rp 15.000'],
        ['value' => '100_diamonds', 'label' => '100 Diamonds', 'harga' => 'Rp 30.000'],
        ['value' => '250_diamonds', 'label' => '250 Diamonds', 'harga' => 'Rp 75.000'],
        ['value' => '500_diamonds', 'label' => '500 Diamonds', 'harga' => 'Rp 145.000'],
        ['value' => '1000_diamonds', 'label' => '1000 Diamonds', 'harga' => 'Rp 290.000'],
        ['value' => 'weekly_diamond_pass', 'label' => 'Weekly Diamond Pass', 'harga' => 'Rp 30.000']
    ];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>George Store - Top Up <?php echo $judul_game; ?></title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

        body {
            background-color: #0b0f2b;
            color: #EAE0CF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==========================================================================
           PENGATURAN NAVBAR MURNI TANPA BOOTSTRAP (CUSTOM CSS)
           ========================================================================== */
        .hud-header {
            position: sticky;
            top: 0;
            z-index: 9999;
            padding: 0 15px;
        }

        .hud-navbar {
            background-color: rgba(11, 15, 43, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(114, 136, 174, 0.2);
            border-radius: 16px;
            margin: 20px auto;
            width: 100%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            transition: all 0.3s ease;
        }

        .hud-brand {
            color: #EAE0CF;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }
        .hud-brand:hover { color: #EAE0CF; }

        .hud-menu {
            display: flex;
            gap: 10px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .hud-link {
            color: rgba(234, 224, 207, 0.7);
            text-decoration: none;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .hud-link:hover, .hud-link.active {
            color: #EAE0CF;
            background-color: rgba(114, 136, 174, 0.15);
        }

        .hud-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }
        .hud-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #EAE0CF;
            margin: 5px 0;
            border-radius: 2px;
            transition: 0.3s;
        }

        @media (max-width: 767.98px) {
            .hud-navbar {
                margin: 10px auto;
                padding: 12px 20px;
                position: relative;
            }
            .hud-toggle { display: block; }
            .hud-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(11, 15, 43, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 16px;
                border: 1px solid rgba(114, 136, 174, 0.2);
                margin-top: 10px;
                padding: 15px;
                gap: 5px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            }
            .hud-menu.show { display: flex; }
            .hud-link { display: block; width: 100%; padding: 12px 20px; }
        }

        /* ==========================================================================
           GAYA FORM UTAMA (Glassmorphism UI)
           ========================================================================== */
        .card-custom {
            background: rgba(75, 86, 148, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(114, 136, 174, 0.15);
            border-radius: 24px;
            color: #EAE0CF;
        }

        .form-control {
            background-color: rgba(11, 15, 43, 0.6);
            border: 1px solid rgba(114, 136, 174, 0.3);
            color: #EAE0CF;
            border-radius: 12px;
            padding: 12px 15px;
        }
        .form-control:focus {
            background-color: rgba(11, 15, 43, 0.8);
            border-color: #7288AE;
            color: #EAE0CF;
            box-shadow: 0 0 10px rgba(114, 136, 174, 0.2);
        }

        /* Desain Pilihan Nominal Item Box */
        .nominal-box {
            background: rgba(11, 15, 43, 0.4);
            border: 1px solid rgba(114, 136, 174, 0.2);
            border-radius: 16px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .nominal-box:hover {
            transform: translateY(-3px);
            border-color: #7288AE;
            background: rgba(75, 86, 148, 0.12);
        }
        
        .nominal-radio {
            position: absolute;
            visibility: hidden;
            opacity: 0;
        }
        
        .nominal-radio:checked + .nominal-box {
            border-color: #EAE0CF;
            background: linear-gradient(135deg, rgba(75, 86, 148, 0.2) 0%, rgba(11, 15, 43, 0.6) 100%);
            box-shadow: 0 0 15px rgba(234, 224, 207, 0.15);
        }

        .btn-order {
            background: linear-gradient(135deg, #7288AE 0%, #4B5694 100%);
            color: #EAE0CF;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            padding: 14px;
            transition: all 0.3s ease;
        }
        .btn-order:hover {
            background: #EAE0CF;
            color: #0b0f2b;
            box-shadow: 0 0 20px rgba(234, 224, 207, 0.4);
        }

        footer {
            background-color: #070a1e;
            color: rgba(234, 224, 207, 0.5);
            border-top: 1px solid rgba(114, 136, 174, 0.1);
            padding: 30px 0;
            margin-top: auto;
        }
    </style>
  </head>
  <body>

    <header class="hud-header">
        <nav class="hud-navbar">
            <a class="hud-brand" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" class="me-2" style="fill: none; stroke: #EAE0CF; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;">
                    <path d="M21 12A9 9 0 1 1 12 3h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1a3 3 0 1 0 3 3V9"></path>
                    <polygon points="16 3 21 3 21 8"></polygon>
                </svg>
                George Store.
            </a>

            <button class="hud-toggle" id="menuToggle" aria-label="Toggle Navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="hud-menu" id="navMenu">
                <li><a class="hud-link" href="index.php">Home</a></li>
                <li><a class="hud-link" href="index.php#daftar-game">Daftar Game</a></li>
                <li><a class="hud-link" href="riwayat.php">Riwayat</a></li>
            </ul>
        </nav>
    </header>

    <div class="container my-4 my-lg-5">
        <h2 class="fw-bold mb-4">Top Up <?php echo $judul_game; ?></h2>
        
        <form action="proses_order.php" method="POST">
            <div class="row g-4">
                
                <div class="col-lg-4">
                    <div class="card card-custom p-4 shadow">
                        <h4 class="fw-bold mb-3">1. Data Akun 🎮</h4>
                        <hr style="border-color: rgba(114,136,174,0.3)">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-white-50">USER ID</label>
                            <input type="text" class="form-control" name="user_id" placeholder="Masukkan ID Akun" required>
                        </div>
                        
                        <?php if ($game_aktif == 'mlbb'): ?>
                        <div class="mb-2">
                            <label class="form-label small fw-semibold text-white-50">ZONE ID (SERVER)</label>
                            <input type="number" class="form-control" name="zone_id" placeholder="Contoh: 1234" required>
                        </div>
                        <?php endif; ?>
                        
                        <small class="text-white-50 d-block lh-sm" style="font-size:0.75rem;">*Pastikan ID yang Anda masukkan sudah benar untuk menghindari kesalahan pengiriman.</small>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-custom p-4 shadow">
                        <h4 class="fw-bold mb-3">2. Pilih Nominal <?php echo $nama_item; ?> ✨</h4>
                        <hr style="border-color: rgba(114,136,174,0.3)">
                        
                        <div class="row g-3 row-cols-2 row-cols-md-3 mb-4">
                            
                            <?php foreach ($pilihan_paket as $index => $paket): ?>
                            <div class="col">
                                <label class="w-100 h-100 position-relative">
                                    <input type="radio" name="paket_item" value="<?php echo $paket['value']; ?>" class="nominal-radio" <?php echo $index === 0 ? 'required' : ''; ?>>
                                    <div class="nominal-box">
                                        <span class="fw-bold style="font-size: 0.95rem;"><?php echo $paket['label']; ?></span>
                                        <span class="text-success fw-bold small mt-2"><?php echo $paket['harga']; ?></span>
                                    </div>
                                </label>
                            </div>
                            <?php endforeach; ?>

                        </div>

                        <button type="submit" class="btn btn-order w-100 fs-5 shadow mt-2">Lanjutkan Pembayaran 🚀</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <footer class="text-center">
        <div class="container">
            <small class="fw-semibold text-white-50">&copy; 2026 George Store. All Rights Reserved.</small>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('show');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>