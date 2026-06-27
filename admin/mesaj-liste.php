<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$mesajlar = mysqli_query($baglanti, "SELECT * FROM mesajlar ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Mesaj Yönetimi</title>
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
    overflow-y:auto;
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
}

.menu-title{
    color:#7f8da3;
    font-size:12px;
    font-weight:800;
    margin:22px 0 10px;
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
    padding:30px;
}

.topbar{
    background:white;
    border-radius:26px;
    padding:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.topbar h1{
    font-weight:900;
    margin:0;
    color:#172033;
}

.topbar p{
    color:#64748b;
    margin:5px 0 0;
}

.message-card{
    background:white;
    border-radius:20px;
    padding:22px;
    margin-bottom:16px;
    box-shadow:0 8px 22px rgba(23,32,51,.06);
    border-left:4px solid #0f766e;
    max-width:850px;
}

.meta{
    color:#64748b;
    font-size:14px;
    margin-bottom:12px;
    line-height:1.8;
}

.contact-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:18px;
}

.contact-actions a{
    padding:10px 16px;
    border-radius:12px;
    font-size:14px;
}
.message-card::before{
    display:none;
}
.btn-delete{
    background:#ef476f;
    color:white;
    padding:10px 15px;
    border-radius:13px;
    text-decoration:none;
    font-weight:800;
}

.btn-delete:hover{
    background:#d6335c;
    color:white;
}

.empty{
    background:white;
    border-radius:24px;
    padding:35px;
    text-align:center;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}
.contact-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:15px;
}

.btn-call{
    background:#0f766e;
    color:white;
    padding:10px 15px;
    border-radius:13px;
    text-decoration:none;
    font-weight:800;
}

.btn-mail{
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:13px;
    text-decoration:none;
    font-weight:800;
}

.btn-call:hover,
.btn-mail:hover{
    color:white;
    opacity:.9;
}

.info-badge{
    display:inline-block;
    background:#eef8f6;
    color:#0f766e;
    padding:6px 11px;
    border-radius:999px;
    font-weight:800;
    font-size:13px;
    margin-bottom:10px;
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
            <h1>İletişim Mesajları</h1>
            <p>Kullanıcıların gönderdiği iletişim mesajlarını buradan inceleyebilirsin.</p>
        </div>
    </div>

   <?php if(mysqli_num_rows($mesajlar) > 0) { ?>

    <?php while($m = mysqli_fetch_assoc($mesajlar)) { ?>

        <div class="message-card">

            <h4><?php echo $m["konu"]; ?></h4>

            <div class="meta">

                <?php if(!empty($m["mesaj_turu"])) { ?>
                    <span class="info-badge">
                        <?php echo $m["mesaj_turu"]; ?>
                    </span>
                    <br>
                <?php } ?>

                <b>Gönderen:</b> <?php echo $m["adsoyad"]; ?><br>
                <b>E-posta:</b> <?php echo $m["email"]; ?><br>

                <?php if(!empty($m["telefon"])) { ?>
                    <b>Telefon:</b> <?php echo $m["telefon"]; ?><br>
                <?php } ?>

                <?php if(!empty($m["donus"])) { ?>
                    <b>Geri Dönüş Tercihi:</b> <?php echo $m["donus"]; ?><br>
                <?php } ?>

                <b>Tarih:</b> <?php echo $m["tarih"]; ?>

            </div>

            <p class="message-text">
                <?php echo $m["mesaj"]; ?>
            </p>

            <div class="contact-actions">

                <?php if(!empty($m["telefon"]) && ($m["donus"] == "Telefon" || $m["donus"] == "Fark Etmez")) { ?>
                    <a class="btn-call" href="tel:<?php echo $m["telefon"]; ?>">
                        Telefon ile Ara
                    </a>
                <?php } ?>

                <?php if(!empty($m["email"]) && ($m["donus"] == "E-posta" || $m["donus"] == "Fark Etmez")) { ?>
                    <a class="btn-mail" href="mailto:<?php echo $m["email"]; ?>">
                        Mail Gönder
                    </a>
                <?php } ?>

                <a class="btn-delete"
                   href="mesaj-sil.php?id=<?php echo $m["id"]; ?>"
                   onclick="return confirm('Bu mesajı silmek istediğine emin misin?');">
                    Mesajı Sil
                </a>

            </div>

        </div>

    <?php } ?>

<?php } else { ?>

    <div class="empty">
        <h3>Henüz mesaj yok.</h3>
        <p>Kullanıcılar iletişim formundan mesaj gönderdiğinde burada görünecek.</p>
    </div>

<?php } ?>

</main>
</body>
</html>