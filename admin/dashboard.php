<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$bekleyen_uye_sorgu = mysqli_query($baglanti, "SELECT COUNT(*) AS toplam FROM uye_basvurulari WHERE durum='beklemede' OR durum IS NULL");
$bekleyen_uye_sayisi = mysqli_fetch_assoc($bekleyen_uye_sorgu)["toplam"];

$onaylanan_uye_sorgu = mysqli_query($baglanti, "SELECT COUNT(*) AS toplam FROM uye_basvurulari WHERE durum='onaylandi'");
$onaylanan_uye_sayisi = mysqli_fetch_assoc($onaylanan_uye_sorgu)["toplam"];
$etkinlik_sayisi = mysqli_num_rows(mysqli_query($baglanti, "SELECT * FROM etkinlikler"));
$gonullu_sayisi = mysqli_num_rows(mysqli_query($baglanti, "SELECT * FROM gonulluler"));
$faaliyet_sayisi = mysqli_num_rows(mysqli_query($baglanti, "SELECT * FROM faaliyetler"));

$son_etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY id DESC LIMIT 4");
$yaklasan_etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY tarih ASC LIMIT 3");
$son_gonulluler = mysqli_query($baglanti, "SELECT * FROM gonulluler ORDER BY id DESC LIMIT 4");
if (isset($_POST["yorum_ekle"])) {
    $adsoyad = $_POST["adsoyad"];
    $unvan = $_POST["unvan"];
    $yorum = $_POST["yorum"];

    mysqli_query($baglanti, "INSERT INTO gonullu_yorumlari (adsoyad, unvan, yorum)
    VALUES ('$adsoyad', '$unvan', '$yorum')");

    header("Location: dashboard.php");
    exit;
}

if (isset($_POST["yorum_guncelle"])) {
    $id = $_POST["yorum_id"];
    $adsoyad = $_POST["adsoyad"];
    $unvan = $_POST["unvan"];
    $yorum = $_POST["yorum"];

    mysqli_query($baglanti, "UPDATE gonullu_yorumlari SET
        adsoyad='$adsoyad',
        unvan='$unvan',
        yorum='$yorum'
        WHERE id=$id
    ");

    header("Location: dashboard.php");
    exit;
}

if (isset($_GET["yorum_sil"])) {
    $id = $_GET["yorum_sil"];

    mysqli_query($baglanti, "DELETE FROM gonullu_yorumlari WHERE id=$id");

    header("Location: dashboard.php");
    exit;
}

$gonullu_yorumlari = mysqli_query($baglanti, "SELECT * FROM gonullu_yorumlari ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Renkli Düşler | Yönetim Paneli</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
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

.brand{
    margin-bottom:28px;
}

.brand-box{
    width:58px;
    height:58px;
    border-radius:20px;
    background:linear-gradient(135deg,#f6b73c,#ef476f);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
    margin-bottom:14px;
}

.brand h3{
    font-weight:850;
    margin:0;
}

.brand p{
    color:#aab4c5;
    font-size:14px;
    margin-top:5px;
}

.menu-title{
    color:#7f8da3;
    font-size:12px;
    font-weight:800;
    margin:22px 0 10px;
    letter-spacing:.8px;
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
    background:#24314a;
    color:white;
}

.content{
    margin-left:320px;
    padding:28px 30px;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:22px;
}

.topbar h1{
    font-weight:900;
    color:#172033;
    margin:0;
}

.topbar p{
    margin:5px 0 0;
    color:#6b7280;
}

.admin-pill{
    background:white;
    border-radius:999px;
    padding:12px 18px;
    font-weight:800;
    color:#172033;
    box-shadow:0 8px 25px rgba(23,32,51,.08);
}

.hero{
    background:
      linear-gradient(120deg,rgba(23,32,51,.88),rgba(15,118,110,.78)),
      url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    border-radius:32px;
    padding:36px;
    color:white;
    margin-bottom:24px;
    min-height:270px;
    display:flex;
    align-items:end;
    justify-content:space-between;
    box-shadow:0 18px 40px rgba(23,32,51,.18);
}

.hero h2{
    font-size:36px;
    font-weight:900;
    max-width:760px;
}

.hero p{
    color:#edf2f7;
    max-width:720px;
    line-height:1.6;
}

.hero-buttons a{
    display:inline-block;
    text-decoration:none;
    padding:12px 18px;
    border-radius:15px;
    font-weight:850;
    margin-left:8px;
}

.btn-yellow{
    background:#f6b73c;
    color:#172033;
}

.btn-white{
    background:white;
    color:#172033;
}

.stat-card{
    background:white;
    border-radius:26px;
    padding:24px;
    height:100%;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    border:1px solid rgba(255,255,255,.6);
}

.stat-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.stat-icon{
    width:52px;
    height:52px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.bg-soft-1{background:#ffe4e6;}
.bg-soft-2{background:#dff7f3;}
.bg-soft-3{background:#fff3cd;}
.bg-soft-4{background:#e6f4ff;}

.stat-card h2{
    font-size:40px;
    font-weight:900;
    margin:18px 0 0;
    color:#172033;
}

.stat-card p{
    margin:5px 0 0;
    color:#6b7280;
    font-weight:650;
}

.panel{
    background:white;
    border-radius:26px;
    padding:25px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    height:100%;
}

.panel-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.panel-head h4{
    margin:0;
    font-weight:900;
    color:#172033;
}

.panel-head a{
    text-decoration:none;
    color:#0f766e;
    font-weight:800;
}

.item{
    display:flex;
    gap:14px;
    padding:14px;
    border-radius:18px;
    background:#f8fafc;
    margin-bottom:12px;
    border:1px solid #edf2f7;
}

.item-badge{
    min-width:54px;
    height:54px;
    border-radius:17px;
    background:#172033;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
}

.item h5{
    margin:0;
    font-size:16px;
    font-weight:850;
    color:#172033;
}

.item p{
    margin:4px 0 0;
    color:#64748b;
    font-size:14px;
}

.quick-link{
    display:block;
    padding:16px;
    border-radius:18px;
    background:#f8fafc;
    border:1px solid #edf2f7;
    color:#172033;
    text-decoration:none;
    font-weight:850;
    margin-bottom:12px;
}

.quick-link:hover{
    background:#fff7ed;
    color:#b45309;
}

.module-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}

.module{
    background:#f8fafc;
    border:1px solid #edf2f7;
    padding:16px;
    border-radius:18px;
}

.module strong{
    display:block;
    color:#172033;
}

.module span{
    color:#64748b;
    font-size:13px;
}

.note{
    background:#fff7ed;
    border:1px solid #fed7aa;
    color:#7c2d12;
    border-radius:20px;
    padding:18px;
    font-weight:650;
}

.empty{
    background:#f8fafc;
    border:1px dashed #cbd5e1;
    padding:18px;
    border-radius:18px;
    color:#64748b;
    font-weight:700;
}
.mini-stats{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:16px;
    margin:24px 0;
}

.mini-card{
    background:white;
    border-radius:22px;
    padding:18px;
    display:flex;
    gap:14px;
    align-items:center;
    box-shadow:0 10px 25px rgba(23,32,51,.07);
}
.submit-btn{
    background:#0f766e;
    color:white;
    border:none;
    padding:13px;
    border-radius:15px;
    font-weight:850;
    width:100%;
}
.submit-btn{
    background:#0f766e;
    color:white;
    border:none;
    padding:13px;
    border-radius:15px;
    font-weight:850;
    width:100%;
}

.show-comments-btn{
    margin-top:14px;
    width:100%;
    border:none;
    background:#fff7ed;
    color:#b45309;
    padding:12px;
    border-radius:14px;
    font-weight:850;
}

.comment-list-box{
    display:none;
    margin-top:15px;
}

.admin-comment-card{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:16px;
    padding:14px;
    margin-bottom:12px;
}

.admin-comment-card strong{
    display:block;
    color:#172033;
    font-weight:900;
}

.admin-comment-card span{
    color:#64748b;
    font-size:13px;
}

.admin-comment-card p{
    color:#475569;
    margin:8px 0;
    line-height:1.6;
}

.comment-edit summary{
    cursor:pointer;
    color:#0f766e;
    font-weight:850;
    margin-bottom:8px;
}

.comment-delete{
    display:inline-block;
    margin-top:8px;
    background:#ef476f;
    color:white;
    padding:8px 12px;
    border-radius:11px;
    text-decoration:none;
    font-weight:800;
    font-size:14px;
}

.comment-delete:hover{
    color:white;
    background:#d6335c;
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

    <div class="topbar">
        <div>
            <h1>Renkli Düşler Yönetim Merkezi
            </h1>
        
        </div>

    </div>

    <section class="hero">
        <div>
            <h2>Renkli Düşler Derneği yönetim sistemine hoş geldiniz.</h2>
           
        </div>

       
    </section>

 

       <div class="mini-stats">

    <div class="mini-card">
        <div class="mini-icon">🎨</div>
        <div>
            <span>Etkinlikler</span>
            <strong><?php echo $etkinlik_sayisi; ?></strong>
            <p>Kayıtlı etkinlik</p>
        </div>
    </div>

    <div class="mini-card">
        <div class="mini-icon">🌱</div>
        <div>
            <span>Faaliyetler</span>
            <strong><?php echo $faaliyet_sayisi; ?></strong>
            <p>Faaliyet alanı</p>
        </div>
    </div>

    <div class="mini-card">
        <div class="mini-icon">🤝</div>
        <div>
            <span>Gönüllüler</span>
            <strong><?php echo $gonullu_sayisi; ?></strong>
            <p>Gönüllü başvuru</p>
        </div>
    </div>

    <div class="mini-card">
        <div class="mini-icon">⏳</div>
        <div>
            <span>Bekleyen Üyeler</span>
            <strong><?php echo $bekleyen_uye_sayisi; ?></strong>
            <p>Onay bekliyor</p>
        </div>
    </div>

    <div class="mini-card">
        <div class="mini-icon">✅</div>
        <div>
            <span>Onaylanan Üyeler</span>
            <strong><?php echo $onaylanan_uye_sayisi; ?></strong>
            <p>Üyeliği onaylandı</p>
        </div>
    </div>


  </div>

    <div class="row g-4 mb-4">

        <div class="col-lg-8">
            <div class="panel">
                <div class="panel-head">
                    <h4>Yaklaşan / Son Etkinlikler</h4>
                    <a href="etkinlik-liste.php">Tümünü Gör</a>
                </div>

                <?php if (mysqli_num_rows($yaklasan_etkinlikler) > 0) { ?>
                    <?php while ($e = mysqli_fetch_assoc($yaklasan_etkinlikler)) { ?>
                        <div class="item">
                            <div class="item-badge">ET</div>
                            <div>
                                <h5><?php echo $e["baslik"]; ?></h5>
                                <p><?php echo $e["tarih"]; ?> · <?php echo mb_substr($e["aciklama"], 0, 90, "UTF-8"); ?>...</p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="empty">Henüz etkinlik eklenmedi. İlk etkinliği ekleyerek paneli doldurabilirsin.</div>
                <?php } ?>
            </div>
        </div>
<div class="col-lg-4">
    <div class="panel">

        <div class="panel-head">
            <h4>Gönüllüler Ne Diyor?</h4>
        </div>

        <form method="POST">

            <div class="mb-3">
                <label class="fw-bold">Ad Soyad</label>
                <input type="text" name="adsoyad" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Unvan</label>
                <input type="text" name="unvan" class="form-control" placeholder="Gönüllü Eğitmen">
            </div>

            <div class="mb-3">
                <label class="fw-bold">Yorum</label>
                <textarea name="yorum" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" name="yorum_ekle" class="submit-btn">
                Yorumu Ekle
            </button>

        </form>

        <a href="gonullu-yorumlari.php" class="show-comments-btn d-block text-center text-decoration-none">
            Mesajları Görüntüle
        </a>

    </div>
</div>
</div>
    <div class="row g-4">

       <div class="col-lg-6">

    <div class="panel">

        <div class="panel-head">
            <h4>Son Gelen Mesajlar</h4>
            <a href="mesaj-liste.php">Tüm Mesajlar</a>
        </div>

        <?php
        $son_mesajlar = mysqli_query($baglanti, "SELECT * FROM mesajlar ORDER BY id DESC LIMIT 4");
        ?>

        <?php if (mysqli_num_rows($son_mesajlar) > 0) { ?>

            <?php while ($m = mysqli_fetch_assoc($son_mesajlar)) { ?>

                <div class="item">

                    <div class="item-badge">
                        M
                    </div>

                    <div>
                        <h5><?php echo $m["konu"]; ?></h5>

                        <p>
                            <?php echo $m["adsoyad"]; ?> ·
                            <?php echo mb_substr($m["mesaj"], 0, 70, "UTF-8"); ?>...
                        </p>
                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="empty">
                Henüz iletişim mesajı bulunmuyor.
            </div>

        <?php } ?>

    </div>

</div>

        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-head">
                    <h4>Son Gönüllü Başvuruları</h4>
                    <a href="gonullu-liste.php">Başvurular</a>
                </div>

                <?php if (mysqli_num_rows($son_gonulluler) > 0) { ?>
                    <?php while ($g = mysqli_fetch_assoc($son_gonulluler)) { ?>
                        <div class="item">
                            <div class="item-badge">G</div>
                            <div>
                                <h5><?php echo $g["adsoyad"]; ?></h5>
                                <p><?php echo $g["ilgi_alani"]; ?> · <?php echo $g["telefon"]; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="empty">Henüz gönüllü başvurusu bulunmuyor.</div>
                <?php } ?>
            </div>
        </div>

    </div>

</main>

</body>
</html>