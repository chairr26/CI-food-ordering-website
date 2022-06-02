<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="<?= base_url();  ?>/CSS/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        hr {
            display: block;
            margin: 40px 0 -15px;
            width: 100%;
            height: 1px;
            border: 0;
            background-color: rgba(0, 0, 0, 0.35);
        }

        hr+h2 {
            display: inline-block;
            position: relative;
            left: 50%;
            margin: 0;
            padding: 5px 10px;
            border: 1px solid #453986;
            transform: translateX(-50%);
            color: #453986;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.32em;
            text-align: center;
            text-transform: uppercase;
            background-color: #fff;
        }

        hr+h2::first-letter {
            margin-left: 0.32em;
        }

        /* Alternative transform: translate */
        hr+h2 {
            border-width: 1px 0;
        }

        hr+h2::before,
        hr+h2::after {
            display: block;
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1px;
            background: #453986;
            content: "";
        }

        hr+h2::before {
            left: 0;
        }

        hr+h2::after {
            right: 0;
        }

        /**/
        * {
            box-sizing: border-box;
        }

        .hidden {
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?= base_url();  ?>/JS/multislider.min.js"></script>
    <title>Lau Cafe (<?= $nomeja; ?>)</title>

</head>

<body style="margin:0">
    <nav>
        <center>
            <div class="navbar-top">
                <div>
                    <a href="#">
                        <h4 class="logo">Lau Cafe</h4>
                    </a>
                </div>
            </div>
        </center>
    </nav>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding:0">
            <center><img style="width: 70%;" src='<?= $qr ?>' /></center>

            <center>
                <button onclick="window.location='<?php echo base_url('Bayar/donlot/' . $idlog) ?>'" class="btn btn-primary btn-sm">Download QRIS</button>
                <button onclick="window.location='<?php echo base_url($nomeja . '/Bayar/cekstatus/' . $idlog) ?>'" class="btn btn-primary btn-sm">Cek Status</button>
            </center>
        </div>
        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12" style="padding:0">
            <center style="margin: 0 20px;">
                <br>
                <font>Aplikasi pembayaran yang mendukung transaksi pada perangkat yang sama</font><br><br>
                <img src="/image/shopee.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/dana.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/bni.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/linkaja.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/ovo.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/gopay.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/bri.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/bca.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/blu.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <img src="/image/jenius.jpg" width="40px" height="40px" style="margin-bottom:3px;border-radius:10px;border:1px solid darkgrey;">
                <br><br>
                <font>Cara Bayar</font><br><br>
            </center>
            <div style="margin:0 20px">
                1. Download QRIS<br>
                2. Buka aplikasi pembayaran yang kamu punya<br>
                3. Pilih menu Scan/Bayar/QRIS sesuai dengan aplikasi yang kamu gunakan<br>
                4. Pilih upload from gallery (biasanya berupa icon galeri)<br>
                5. Pilih QRIS yang sudah kamu download<br>
                6. Klik bayar<br>
                <font color="red">7. Kembali ke pesanan, dan klik "<b>Cek Status</b>"</font><br>
                8. Infokan ke pelayan jika ada masalah pembayaran
            </div>
        </div>
    </div>
</body>