<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$faaliyetler = mysqli_query($baglanti, "SELECT * FROM faaliyetler ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Faaliyet Alanları</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f5efe6;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#263238;
}

.sidebar{
    position:fixed;
    top:18px;
    left:18px;
    bottom:18px;
    width:285px;
    background:#172033;
    border-radius:30px;
    padding:28px;
    color:white;
       overflow-y:auto;
}
.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:#3b4a66;
    border-radius:10px;
}
.logo-box{
    width:60px;
    height:60px;
    border-radius:22px;
    background:linear-gradient(135deg,#f6b73c,#ef476f);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
    margin-bottom:14px;
}

.sidebar h3{
    font-weight:900;
    margin:0;
}

.sidebar p{
    color:#aab4c5;
    font-size:14px;
}

.menu-title{
    color:#7f8da3;
    font-size:12px;
    font-weight:800;
    margin:25px 0 12px;
}

.sidebar a{
    display:block;
    color:#dbe4f0;
    text-decoration:none;
    padding:14px 15px;
    border-radius:16px;
    margin-bottom:8px;
    font-weight:650;
}

.sidebar a:hover,
.sidebar a.active{
    background:#24314a;
}

.content{
    margin-left:325px;
    padding:35px;
}

.top-area{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.top-area h1{
    font-weight:900;
    color:#172033;
    margin:0;
    font-size:42px;
}

.top-area p{
    color:#64748b;
    margin-top:7px;
}

.add-btn{
    background:#0f766e;
    color:white;
    text-decoration:none;
    padding:14px 20px;
    border-radius:16px;
    font-weight:800;
}

.card-box{
    background:white;
    border-radius:28px;
    padding:28px;
    height:100%;
    box-shadow:0 18px 40px rgba(23,32,51,.08);
}

.card-box h4{
    font-weight:900;
    color:#172033;
    margin-bottom:14px;
}

.card-box p{
    color:#64748b;
    line-height:1.7;
    min-height:120px;
}

.btn-edit{
    background:#f6b73c;
    color:#172033;
    text-decoration:none;
    padding:10px 15px;
    border-radius:13px;
    font-weight:800;
}

.btn-delete{
    background:#ef476f;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    border-radius:13px;
    font-weight:800;
}

.empty{
    background:white;
    border-radius:28px;
    padding:45px;
    text-align:center;
    box-shadow:0 18px 40px rgba(23,32,51,.08);
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-box">RD</div>
        <h3>Renkli Düşler</h3>
        <p>Çocuk Derneği Yönetim Sistemi</p>
    </div>

    <div class="menu-title">PANEL</div>

    <a href="dashboard.php">Ana Sayfa</a>
    <a href="etkinlik-ekle.php">Etkinlik Ekle</a>
    <a href="etkinlik-liste.php">Etkinlikleri Yönet</a>
    <a href="faaliyet-liste.php">Faaliyet Alanları</a>
    <a href="gonullu-liste.php">Gönüllü Başvuruları</a>
    <a href="uye-basvurulari.php">Üye Başvuruları</a>
    <a href="uyeler-yonetim.php">Üyeler / Yönetim Kurulu</a>
    <a href="mesaj-liste.php">İletişim Mesajları</a>

    <div class="menu-title">SİSTEM</div>

    <a href="../index.php">Siteyi Görüntüle</a>
    <a href="logout.php">Çıkış Yap</a>
</aside>

<main class="content">

    <div class="top-area">
        <div>
            <h1>Faaliyet Alanları</h1>
            <p>Derneğin ana sayfada görünen faaliyet alanlarını buradan yönetebilirsin.</p>
        </div>

        <a href="faaliyet-ekle.php" class="add-btn">
            Yeni Faaliyet Ekle
        </a>
    </div>

    <?php if (mysqli_num_rows($faaliyetler) > 0) { ?>

        <div class="row g-4">

            <?php while ($f = mysqli_fetch_assoc($faaliyetler)) { ?>

                <div class="col-lg-4 col-md-6">

                    <div class="card-box">

                        <h4><?php echo $f["baslik"]; ?></h4>

                        <p><?php echo $f["aciklama"]; ?></p>

                        <div class="d-flex gap-2 mt-3">

                            <a href="faaliyet-duzenle.php?id=<?php echo $f["id"]; ?>"
                               class="btn-edit">
                                Düzenle
                            </a>

                            <a href="faaliyet-sil.php?id=<?php echo $f["id"]; ?>"
                               class="btn-delete"
                               onclick="return confirm('Bu faaliyet alanını silmek istediğine emin misin?');">
                                Sil
                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="empty">
            <h3>Henüz faaliyet alanı eklenmedi.</h3>
            <p>Yeni faaliyet ekleyerek bu alanı doldurabilirsin.</p>
        </div>

    <?php } ?>

</main>

</body>
</html>