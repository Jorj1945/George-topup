<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (Hanya untuk grid & layout konten, bukan untuk navbar) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>George Store - Premium Game Refill</title>

    <!-- Google Fonts & Custom UI/UX Stylesheet -->
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
            position: relative;
        }

        /* Ambient Glow Effect di Background */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(114, 136, 174, 0.15) 0%, rgba(0,0,0,0) 70%);
            top: -100px;
            right: -50px;
            z-index: -1;
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

        /* Menu Navigasi Default (Desktop) */
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

        /* Tombol Hamburger Kustom untuk Mobile (Sembunyi di Desktop) */
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

        /* Responsive Breakpoint Khusus Navbar (< 768px) */
        @media (max-width: 767.98px) {
            .hud-navbar {
                margin: 10px auto;
                padding: 12px 20px;
                position: relative;
            }
            .hud-toggle {
                display: block; /* Munculkan hamburger di HP */
            }
            .hud-menu {
                display: none; /* Sembunyikan menu bawaan */
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
            /* Class active pemicu Javascript untuk membuka menu */
            .hud-menu.show {
                display: flex;
            }
            .hud-link {
                display: block;
                width: 100%;
                padding: 12px 20px;
            }
        }

        /* ==========================================================================
           SISA GAYA LAYOUT KONTEN (TETAP SAMA SEPERTI SEBELUMNYA)
           ========================================================================== */
        .hero-section { padding: 30px 0; }
        @media (min-width: 992px) { .hero-section { padding: 60px 0; } }
        
        .hero-title {
            font-weight: 800;
            font-size: 2.2rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #EAE0CF 0%, #7288AE 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @media (min-width: 992px) { .hero-title { font-size: 3.8rem; } }

        .promo-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(114, 136, 174, 0.2);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        }
        .promo-wrapper img {
            width: 100%;
            height: 360px;
            object-fit: cover;
        }
        @media (max-width: 767.98px) {
            .promo-wrapper img { height: auto !important; object-fit: contain !important; }
        }

        .card-custom {
            background: rgba(75, 86, 148, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #EAE0CF;
            border: 1px solid rgba(114, 136, 174, 0.15);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-custom .card-body { padding: 15px !important; }
        @media (max-width: 767.98px) {
            .card-custom .card-title { font-size: 1rem !important; margin-bottom: 4px !important; }
            .card-custom .card-text-custom { font-size: 0.75rem !important; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 12px !important; }
            .card-custom .card-img-top { height: 130px !important; }
        }

        .btn-custom {
            background: linear-gradient(135deg, #4B5694 0%, #111844 100%);
            color: #EAE0CF;
            font-weight: 700;
            border: 1px solid rgba(114, 136, 174, 0.4);
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        @media (max-width: 767.98px) {
            .btn-custom { padding: 8px 12px; font-size: 0.8rem; border-radius: 10px; }
        }
        .btn-custom:hover {
            background: #EAE0CF;
            color: #0b0f2b;
            box-shadow: 0 0 15px rgba(234, 224, 207, 0.3);
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

    <!-- NAVBAR MANUAL TANPA BOOTSTRAP -->
    <header class="hud-header">
        <nav class="hud-navbar">
            <a class="hud-brand" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" class="me-2" style="fill: none; stroke: #EAE0CF; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;">
                    <path d="M21 12A9 9 0 1 1 12 3h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1a3 3 0 1 0 3 3V9"></path>
                    <polygon points="16 3 21 3 21 8"></polygon>
                </svg>
                George Store.
            </a>

            <!-- Tombol Hamburger (Mobile Only) -->
            <button class="hud-toggle" id="menuToggle" aria-label="Toggle Navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Menu List -->
            <ul class="hud-menu" id="navMenu">
                <li><a class="hud-link active" href="index.php">Home</a></li>
                <li><a class="hud-link" href="#daftar-game">Daftar Game</a></li>
                <li><a class="hud-link" href="riwayat.php">Riwayat</a></li>
            </ul>
        </nav>
    </header>

     <!-- Hero Section -->
     <div class="container my-5">
  <div class="row align-items-center g-5">
    
    <div class="col-lg-6">
      <h1 class="display-4 fw-bold mb-3" style="color: #EAE0CF;">Level Up Your Gaming Experience.</h1>
      <p class="lead text-white-50 mb-4">Proses otomatis, harga ramah kantong, dan jaminan aman 100%.</p>
      <a href="#daftar-game" class="btn px-4 py-2" style="background-color: rgba(114, 136, 174, 0.2); color: #EAE0CF; border: 1px solid rgba(114, 136, 174, 0.4); border-radius: 12px; font-weight: 600;">
        Mulai Top Up 🎯
      </a>
    </div>

    <div class="col-lg-6">
      <div style="background-color: #050714; border: 1px solid rgba(114, 136, 174, 0.15); border-radius: 24px; padding: 30px; display: flex; justify-content: center; align-items: center;">
        
        <div id="heroImageCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
          <div class="carousel-inner">
            
            <div class="carousel-item active text-center">
              <img src="1.jpg" class="img-fluid" alt="Mobile Legends Banner" style="border-radius: 16px; max-height: 300px; object-fit: contain;">
            </div>

            <div class="carousel-item text-center">
              <img src="2.jpg" class="img-fluid" alt="Roblox Banner" style="border-radius: 16px; max-height: 300px; object-fit: contain;">
            </div>

            <div class="carousel-item text-center">
              <img src="3.jpg" class="img-fluid" alt="Free Fire Banner" style="border-radius: 16px; max-height: 300px; object-fit: contain;">
            </div>

          </div>
        </div> </div>
    </div>

  </div>
</div>
        
     <!-- Section Daftar Game Grid -->
     <div class="container my-4 my-lg-5" id="daftar-game">
        <div class="d-flex align-items-center mb-4 mb-lg-5">
            <div style="width: 5px; height: 24px; background: #7288AE; border-radius: 10px; margin-right: 12px;"></div>
            <h3 class="m-0 fw-bold fs-4 fs-lg-2">🔥 Game Populer</h3>
        </div>
        
        <div class="row row-cols-2 row-cols-md-3 g-3 g-lg-4">
            <!-- Card Game 1 -->
            <div class="col">
                <div class="card h-100 card-custom shadow-sm">
                    <img src="1.jpg" class="card-img-top" alt="Mobile Legends" style="height: 180px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold">Mobile Legends</h4>
                        <p class="card-text-custom text-white-50 small">Diamonds Instan</p>
                        <a href="order.php?game=mlbb" class="btn btn-custom w-100">Top Up</a>
                    </div>
                </div>
            </div>

            <!-- Card Game 2 -->
            <div class="col">
                <div class="card h-100 card-custom shadow-sm">
                    <img src="2.jpg" class="card-img-top" alt="Roblox" style="height: 180px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold">Roblox</h4>
                        <p class="card-text-custom text-white-50 small">Robux Murah</p>
                        <a href="order.php?game=roblox" class="btn btn-custom w-100">Top Up</a>
                    </div>
                </div>
            </div>

            <!-- Card Game 3 -->
            <div class="col">
                <div class="card h-100 card-custom shadow-sm">
                    <img src="3.jpg" class="card-img-top" alt="Free Fire" style="height: 180px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold">Free Fire</h4>
                        <p class="card-text-custom text-white-50 small">Sistem Kilat</p>
                        <a href="order.php?game=ff" class="btn btn-custom w-100">Top Up</a>
                    </div>
                </div>
            </div>
        </div>
     </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <small class="fw-semibold text-white-50">&copy; 2026 George Store. All Rights Reserved.</small>
        </div>
    </footer>

    <!-- JAVASCRIPT KUSTOM: Untuk Menjalankan Fungsi Tombol Hamburger Tanpa Bootstrap -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('show');
        });

        // Menutup menu otomatis jika salah satu link di klik (berguna untuk link #daftar-game)
        const navLinks = document.querySelectorAll('.hud-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('show');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>