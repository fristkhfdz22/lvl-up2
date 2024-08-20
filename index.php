<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Lezat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

    <?php include 'header.php'; ?>
    
    <!-- Hero Section -->
    <div class="parallax" style="background-image: url('img/coding.jpg');">
        <div class="text-center">
            <h1 class="display-4">Selamat Datang di Restoran Lezat</h1>
            <h2 class="display-5">Dimasak dengan Cinta</h2>
            <p class="lead">Setiap hidangan disiapkan dengan bahan-bahan segar dan perhatian penuh terhadap detail.</p>
            <a href="#menu" class="btn btn-primary btn-lg">Lihat Menu</a>
        </div>
    </div>

    <!-- Menu Section -->
    <section id="menu" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="display-5">Menu Kami</h2>
                    <p class="lead">Pilihan makanan terbaik yang akan memanjakan lidah Anda</p>
                </div>
            </div>
            <div class="row mt-4">
                <?php
                include 'db.php';
                
                $sql = "SELECT * FROM menu";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4 menu-item">';
                        echo '<div class="card">';
                        echo '<img src="uploads/' . htmlspecialchars($row["image"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["title"]) . '">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($row["description"]) . '</p>';
                        echo '<div class="input-group mb-3">';
                        echo '<input type="number" class="form-control" id="menuQty' . htmlspecialchars($row["id"]) . '" min="0" value="0" onchange="calculateTotal()">';
                        echo '<span class="input-group-text">x $' . htmlspecialchars($row["price"]) . '</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12 text-center">Tidak ada item menu tersedia.</div>';
                }
                $conn->close();
                ?>
                
            </div>
            
            <div class="row mt-4">
                <div class="col text-center">
            <h4>Total Biaya: $<span id="totalCost">0</span></h4>
                    <button class="btn btn-success mt-3" onclick="placeOrder()">Buat Pesanan</button>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Parallax Section 1 -->
    <div class="parallax" style="background-image: url('img/coding.jpg');">
        <div class="text-center">
            <h2 class="display-5">Dimasak dengan Cinta</h2>
            <p class="lead">Setiap hidangan disiapkan dengan bahan-bahan segar dan perhatian penuh terhadap detail.</p>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="lunch-min.jpg" alt="Tentang Kami" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="display-4 mb-3">Tentang Kami</h2>
                    <p class="lead mb-4">Restoran Lezat didirikan dengan satu tujuan, memberikan pengalaman makan yang tak terlupakan bagi semua orang. Kami menyajikan hidangan berkualitas tinggi dengan bahan-bahan terbaik.</p>
                    <a href="#contact" class="btn btn-primary btn-lg">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Parallax Section 2 -->
    <div class="parallax" style="background-image: url('img/coding.jpg');">
        <div class="text-center">
            <h2 class="display-5">Suasana yang Nyaman</h2>
            <p class="lead">Nikmati makanan Anda dalam suasana yang santai dan ramah.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row">
                <!-- Formulir Kontak -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="display-5 mb-4">Kontak Kami</h2>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>

                <!-- Informasi Lokasi -->
                <div class="col-md-6">
                    <h2 class="display-5 mb-4">Lokasi Kami</h2>
                    <div class="d-flex flex-column justify-content-center h-100">
                        <p><strong>Alamat:</strong> Jl. keraton No.09, tegal, Indonesia</p>
                        <p><strong>Telepon:</strong> +62 8953 7816 8939</p>
                        <p><strong>Email:</strong> info@restoranlezat.com</p>
                        <div id="map" style="height: 300px; width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                            <iframe src="https://www.google.com/maps/place/SPASI+Creative+Space/@-6.8605644,109.1197884,17z/data=!4m16!1m9!3m8!1s0x2e6fb74e6ca69c15:0x8df10c95b7f2e89b!2sSPASI+Creative+Space!8m2!3d-6.8605697!4d109.1223633!9m1!1b1!16s%2Fg%2F11f6nks7sj!3m5!1s0x2e6fb74e6ca69c15:0x8df10c95b7f2e89b!8m2!3d-6.8605697!4d109.1223633!16s%2Fg%2F11f6nks7sj?entry=ttu" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <?php include 'modal.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="java.js"></script>
</body>
</html>
