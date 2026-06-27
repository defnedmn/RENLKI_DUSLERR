<?php
include "config/db.php";

if (!isset($_GET["id"])) {
    header("Location: etkinlikler.php");
    exit;
}

$id = $_GET["id"];

$sorgu = mysqli_query($baglanti, "SELECT * FROM etkinlikler WHERE id=$id");
$etkinlik = mysqli_fetch_assoc($sorgu);

if (!$etkinlik) {
    header("Location: etkinlikler.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title><?php echo $etkinlik["baslik"]; ?> | Renkli Düşler</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#263238;
}

.navbar{
    background:#172033;
    padding:16px 0;
}

.navbar-brand{
    font-weight:900;
}

.nav-link{
    font-weight:650;
}

.detail-hero{
    background:linear-gradient(120deg,rgba(23,32,51,.9),rgba(15,118,110,.78));
    padding:80px 0;
    color:white;
}

.detail-hero h1{
    font-weight:900;
    max-width:850px;
}

.badge-cat{
    display:inline-block;
    background:#f6b73c;
    color:#172033;
    padding:8px 16px;
    border-radius:999px;
    font-weight:850;
    margin-bottom:18px;
}

.detail-card{
    background:white;
    border-radius:30px;
    padding:35px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    margin-top:-45px;
    position:relative;
    z-index:3;
}

.detail-img{
    width:100%;
    height:420px;
    object-fit:cover;
    border-radius:26px;
    margin-bottom:28px;
}

.info-box{
    background:#f8fafc;
    border-radius:22px;
    padding:22px;
    margin-bottom:20px;
}

.info-box strong{
    display:block;
    color:#172033;
    margin-bottom:5px;
}

.detail-text{
    font-size:18px;
    line-height:1.8;
    color:#475569;
}

.btn-main{
    background:#0f766e;
    color:white;
    padding:13px 20px;
    border-radius:15px;
    text-decoration:none;
    font-weight:850;
    display:inline-block;
}

.btn-main:hover{
    background:#115e59;
    color:white;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Renkli Düşler</a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Ana Sayfa</a>
            <a class="nav-link active" href="etkinlikler.php">Etkinlikler</a>
            <a class="nav-link" href="gonullu.php">Gönüllü Ol</a>
            <a class="nav-link" href="iletisim.php">İletişim</a>
        </div>
    </div>
</nav>

<section class="detail-hero">
    <div class="container">
        <span class="badge-cat">
            <?php echo $etkinlik["kategori"]; ?>
        </span>

        <h1>
            <?php echo $etkinlik["baslik"]; ?>
        </h1>
    </div>
</section>

<section class="container pb-5">

    <div class="detail-card">

        <?php if (!empty($etkinlik["resim"])) { ?>
            <img class="detail-img" src="uploads/<?php echo $etkinlik["resim"]; ?>">
        <?php } else { ?>
            <img class="detail-img" src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop">
        <?php } ?>

        <div class="row g-4">

            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Etkinlik Açıklaması</h3>

                <p class="detail-text">
                    <?php echo $etkinlik["aciklama"]; ?>
                </p>

                <a href="etkinlikler.php" class="btn-main mt-3">
                    Tüm Etkinliklere Dön
                </a>
            </div>

            <div class="col-lg-4">

                <div class="info-box">
                    <strong>Etkinlik Tarihi</strong>
                    <?php echo $etkinlik["tarih"]; ?>
                </div>

                <div class="info-box">
                    <strong>Etkinlik Konumu</strong>
                    <?php echo $etkinlik["konum"]; ?>
                </div>

                <div class="info-box">
                    <strong>Kategori</strong>
                    <?php echo $etkinlik["kategori"]; ?>
                    
                </div>

            </div>

        </div>

    </div>

</section>

</body>
</html>