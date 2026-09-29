<?php
session_start();
// Ambil data transaksi dari memori session temporary browser
$daftar_riwayat = isset($_SESSION['riwayat']) ? $_SESSION['riwayat'] : [];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>George Store - Riwayat Transaksi</title>

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

        /* Memberi background sorot terang karena halaman ini sedang diakses */
        .hud-link.active {
            color: #EAE0CF !important;
            background-color: rgba(114, 136, 174, 0.25) !important;
            border: 1px solid rgba(114, 136, 174, 0.2);
        }
        .hud-link:hover {
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
           GAYA CARD TABEL KONTEN (Glassmorphism UI)
           ========================================================================== */
        .card-custom {
            background: rgba(75, 86, 148, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(114, 136, 174, 0.15);
            border-radius: 24px;
        }

        .table-custom { color: #EAE0CF; }
        .table-custom th { color: #7288AE; font-weight: 600; border-bottom: 2px solid rgba(114, 136, 174, 0.2); }
        .table-custom td { border-bottom: 1px solid rgba(114, 136, 174, 0.1); padding: 15px 10px; }
        
        .badge-pending { background-color: rgba(255, 193, 7, 0.15); color: #ffc107; border: 1px solid #ffc107; padding: 5px 12px; border-radius: 30px; font-size: 0.8rem; font-weight: 700; }

        .btn-home { 
            background: linear-gradient(135deg, #7288AE 0%, #4B5694 100%); 
            color: #EAE0CF; 
            border: none; 
            border-radius: 12px; 
            padding: 10px 24px; 
            font-weight: 600; 
            text-decoration: none; 
            transition: all 0.3s ease; 
        }
        .btn-home:hover { background: #EAE0CF; color: #0b0f2b; box-shadow: 0 0 15px rgba(234, 224, 207, 0.3); }

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
                <li><a class="hud-link active" href="riwayat.php">Riwayat</a></li>
            </ul>
        </nav>
    </header>

    <div class="container my-4 my-lg-5">
        <h2 class="fw-bold mb-2">Riwayat Transaksi Anda</h2>
        <p class="text-white-50 mb-4 small">Menampilkan daftar pesanan terakhir yang Anda lakukan pada browser ini.</p>

        <div class="card card-custom shadow p-4">
            <?php if (empty($daftar_riwayat)): ?>
                <div class="text-center py-5">
                    <h5 class="text-muted mb-3">Belum ada riwayat transaksi.</h5>
                    <a href="index.php" class="btn btn-home">Mulai Top Up 🚀</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-borderless table-custom align-middle">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>No. Invoice</th>
                                <th>Layanan Produk</th>
                                <th>ID Akun</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Looping data riwayat terbalik (Data terbaru muncul paling atas)
                            foreach (array_reverse($daftar_riwayat) as $item): 
                            ?>
                                <tr>
                                    <td class="small text-white-50"><?php echo $item['waktu']; ?></td>
                                    <td class="fw-bold text-warning"><?php echo $item['invoice']; ?></td>
                                    <td class="fw-bold text-info"><?php echo $item['game']; ?></td>
                                    <td><code><?php echo $item['user_id']; ?></code></td>
                                    <td class="fw-bold text-success">Rp <?php echo number_format($item['total'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
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