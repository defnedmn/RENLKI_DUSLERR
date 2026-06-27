<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$bekleyenler = mysqli_query($baglanti, "SELECT * FROM uye_basvurulari WHERE durum='beklemede' OR durum IS NULL ORDER BY id DESC");
$onaylananlar = mysqli_query($baglanti, "SELECT * FROM uye_basvurulari WHERE durum='onaylandi' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Üye Başvuruları</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#172033;
}

.sidebar{
    position:fixed;
    top:18px;
    left:18px;
    bottom:18px;
    width:285px;
    background:#172033;
    border-radius:28px;
    padding:26px;
    color:white;
    box-shadow:0 18px 45px rgba(23,32,51,.25);
    overflow-y:auto;
}
.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:#3b4a66;
    border-radius:10px;
}

.sidebar h3{
    font-weight:900;
    margin-bottom:25px;
}

.sidebar a{
    display:block;
    color:#dbe4f0;
    text-decoration:none;
    padding:13px 14px;
    border-radius:15px;
    margin-bottom:8px;
    font-weight:650;
}

.sidebar a:hover,
.sidebar a.active{
    background:#0f766e;
    color:white;
}

.content{
    margin-left:320px;
    padding:35px;
}

.page-title{
    font-weight:900;
    color:#172033;
    margin-bottom:8px;
}

.page-desc{
    color:#64748b;
    margin-bottom:25px;
}

.section-card{
    background:white;
    border-radius:28px;
    padding:26px;
    box-shadow:0 15px 35px rgba(23,32,51,.10);
    margin-bottom:30px;
}

.section-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.section-head h3{
    margin:0;
    font-weight:900;
}

.badge-count{
    background:#0f766e;
    color:white;
    padding:8px 14px;
    border-radius:999px;
    font-weight:900;
}

.application-card{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-left:7px solid #f97316;
    border-radius:22px;
    padding:22px;
    margin-bottom:18px;
}

.application-card.approved{
    border-left-color:#0f766e;
}

.application-top{
    display:flex;
    justify-content:space-between;
    gap:15px;
    align-items:flex-start;
}

.application-card h4{
    font-weight:900;
    color:#172033;
    margin-bottom:5px;
}

.status{
    padding:8px 13px;
    border-radius:999px;
    font-weight:900;
    white-space:nowrap;
}

.status.wait{
    background:#fff7ed;
    color:#b45309;
}

.status.ok{
    background:#dcfce7;
    color:#166534;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-top:18px;
}

.info-box{
    background:white;
    border-radius:15px;
    padding:13px;
    border:1px solid #edf2f7;
}

.info-box span{
    display:block;
    color:#64748b;
    font-size:13px;
    font-weight:700;
}

.info-box strong{
    color:#172033;
}

.btn-detail{
    display:inline-block;
    margin-top:18px;
    background:#172033;
    color:white;
    text-decoration:none;
    padding:11px 20px;
    border-radius:13px;
    font-weight:850;
}

.btn-detail:hover{
    background:#0f766e;
    color:white;
}

.empty{
    background:#f8fafc;
    border:1px dashed #cbd5e1;
    padding:30px;
    border-radius:22px;
    text-align:center;
    color:#64748b;
    font-weight:800;
}

@media(max-width:900px){
    .sidebar{
        position:static;
        width:auto;
        margin:18px;
    }

    .content{
        margin-left:0;
        padding:18px;
    }

    .info-grid{
        grid-template-columns:1fr;
    }

    .application-top{
        flex-direction:column;
    }
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

    <h1 class="page-title">Üye Başvuruları</h1>
    <p class="page-desc">
        Bekleyen başvuruları inceleyebilir, dernek yönetimi alanını doldurup başvuruyu onaylayabilirsiniz.
    </p>

    <div class="section-card">
        <div class="section-head">
            <h3>Başvurusu Bulunan Kişiler</h3>
            <span class="badge-count"><?php echo mysqli_num_rows($bekleyenler); ?> başvuru</span>
        </div>

        <?php if(mysqli_num_rows($bekleyenler) > 0) { ?>

            <?php while($b = mysqli_fetch_assoc($bekleyenler)) { ?>

                <div class="application-card">
                    <div class="application-top">
                        <div>
                            <h4><?php echo $b["ad"] . " " . $b["soyad"]; ?></h4>
                            <p class="mb-0 text-muted">Başvuru henüz onaylanmadı.</p>
                        </div>

                        <span class="status wait">Beklemede</span>
                    </div>

                    <div class="info-grid">
                        <div class="info-box">
                            <span>Telefon</span>
                            <strong><?php echo $b["telefon"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>E-posta</span>
                            <strong><?php echo $b["email"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Meslek</span>
                            <strong><?php echo $b["meslek"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>T.C. Kimlik No</span>
                            <strong><?php echo $b["tc"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Cinsiyet</span>
                            <strong><?php echo $b["cinsiyet"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Başvuru Tarihi</span>
                            <strong><?php echo $b["tarih"]; ?></strong>
                        </div>
                    </div>

                    <a class="btn-detail" href="uye-basvuru-detay.php?id=<?php echo $b["id"]; ?>">
                        Başvuruyu İncele / Onayla
                    </a>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="empty">
                Bekleyen üye başvurusu bulunmuyor.
            </div>

        <?php } ?>
    </div>

    <div class="section-card">
        <div class="section-head">
            <h3>Başvurusu Onaylanan Kişiler</h3>
            <span class="badge-count"><?php echo mysqli_num_rows($onaylananlar); ?> kişi</span>
        </div>

        <?php if(mysqli_num_rows($onaylananlar) > 0) { ?>

            <?php while($b = mysqli_fetch_assoc($onaylananlar)) { ?>

                <div class="application-card approved">
                    <div class="application-top">
                        <div>
                            <h4><?php echo $b["ad"] . " " . $b["soyad"]; ?></h4>
                            <p class="mb-0 text-muted">
                                Yönetim kararı ile üyeliği onaylandı.
                            </p>
                        </div>

                        <span class="status ok">Onaylandı</span>
                    </div>

                    <div class="info-grid">
                        <div class="info-box">
                            <span>Telefon</span>
                            <strong><?php echo $b["telefon"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>E-posta</span>
                            <strong><?php echo $b["email"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Karar Tarihi</span>
                            <strong><?php echo $b["dernek_karar_tarihi"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Karar Sayısı</span>
                            <strong><?php echo $b["dernek_karar_sayisi"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Dernek Başkanı</span>
                            <strong><?php echo $b["dernek_baskani"]; ?></strong>
                        </div>

                        <div class="info-box">
                            <span>Durum</span>
                            <strong>Onaylandı</strong>
                        </div>
                    </div>

                    <a class="btn-detail" href="uye-basvuru-detay.php?id=<?php echo $b["id"]; ?>">
                        Onaylı Formu Görüntüle
                    </a>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="empty">
                Henüz onaylanan üye başvurusu bulunmuyor.
            </div>

        <?php } ?>
    </div>

</main>

</body>
</html>