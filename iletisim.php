<?php
include "config/db.php";

if (isset($_POST["gonder"])) {
    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $konu = $_POST["konu"];
    $mesaj_turu = $_POST["mesaj_turu"];
    $donus = $_POST["donus"];
    $mesaj = $_POST["mesaj"];

    $kaydet = mysqli_query($baglanti, "INSERT INTO mesajlar 
    (adsoyad, email, telefon, konu, mesaj_turu, donus, mesaj)
    VALUES 
    ('$adsoyad', '$email', '$telefon', '$konu', '$mesaj_turu', '$donus', '$mesaj')");

    if ($kaydet) {
        $basari = "Mesajınız başarıyla gönderildi.";
    } else {
        $hata = "Mesaj gönderilirken hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>İletişim | Renkli Düşler</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:Segoe UI, Arial, sans-serif;
}

.navbar{
    background:#172033;
}

.hero{
    background:linear-gradient(120deg,rgba(23,32,51,.9),rgba(15,118,110,.82)),
    url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    padding:90px 0;
    color:white;
}

.contact-card{
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 15px 35px rgba(23,32,51,.12);
}

.form-control{
    border-radius:15px;
    padding:13px;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px;
    border-radius:15px;
    font-weight:800;
    width:100%;
}

.info-box{
    background:linear-gradient(120deg,#172033,#0f766e);
    border-radius:30px;
    padding:30px;
    color:white;

    height:auto;
    align-self:flex-start;
}
.info-item{
    background:rgba(255,255,255,.08);
    padding:16px;
    border-radius:18px;
    margin-bottom:14px;
}
.nav-dropdown{
    position:relative;
}

.dropdown-menu-custom{
    position:absolute;
    top:42px;
    left:0;
    background:white;
    min-width:230px;
    border-radius:18px;
    padding:12px;
    display:none;
    flex-direction:column;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    z-index:9999;
}

.dropdown-menu-custom a{
    text-decoration:none;
    color:#172033;
    padding:12px;
    border-radius:12px;
    font-weight:600;
    display:block;
}

.dropdown-menu-custom a:hover{
    background:#eef8f6;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}
.map-box{
    margin-top:20px;
    border-radius:22px;
    overflow:hidden;
    height:260px;
    box-shadow:0 12px 28px rgba(0,0,0,.18);
}

.map-box iframe{
    width:100%;
    height:100%;
    border:0;
}

.social-links{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
    margin-top:18px;
}

.social-links a{
    background:rgba(255,255,255,.10);
    color:white;
    text-decoration:none;
    border-radius:14px;
    padding:11px;
    text-align:center;
    font-weight:800;
}

.social-links a:hover{
    background:#0f766e;
}
.contact-head{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    border-radius:24px;
    padding:24px;
    margin-bottom:28px;
}

.contact-head span{
    display:inline-block;
    background:rgba(255,255,255,.15);
    padding:7px 13px;
    border-radius:999px;
    font-size:13px;
    font-weight:800;
    margin-bottom:12px;
}

.contact-head h3{
    font-weight:900;
    margin-bottom:10px;
}

.contact-head p{
    color:#e2e8f0;
    line-height:1.7;
    margin:0;
}
.contact-mini-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
    margin-top:20px;
}

.mini-info-card{
    background:rgba(255,255,255,.10);
    border-radius:18px;
    padding:16px;
    text-align:center;
}

.mini-info-card strong{
    display:block;
    color:white;
    font-weight:900;
    margin-bottom:5px;
}

.mini-info-card span{
    color:#cbd5e1;
    font-size:14px;
}

.contact-input{
    border-radius:16px;
    padding:13px;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Renkli Düşler</a>
<div class="navbar-nav ms-auto align-items-center">

    <a class="nav-link" href="index.php">Ana Sayfa</a>

    <div class="nav-dropdown">
        <a class="nav-link" href="#">Dernek ▾</a>

        <div class="dropdown-menu-custom">
            <a href="index.php#hakkimizda">Dernek Hakkında</a>
            <a href="index.php#faaliyetler">Yönetim Kurulu</a>
          <a href="dernek-uyeligi.php">Dernek Üyeliği</a>
            <a href="gonullu.php">Gönüllü Başvurusu</a>
        </div>
    </div>

    <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>
    <a class="nav-link active" href="iletisim.php">İletişim</a>

</div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1 class="fw-bold display-5">Bizimle İletişime Geçin</h1>
        <p class="lead mt-3">
            Gönüllülük, bağış, etkinlik ve iş birliği konularında bize mesaj gönderebilirsiniz.
        </p>
    </div>
</section>

<section class="container py-5">
    <div class="row g-4">

        <div class="col-lg-7">
            <div class="contact-card">

               <div class="contact-head">
   
    <h3>Bizimle İletişime Geçin</h3>
    <p>
        Gönüllülük, etkinlik katılımı, iş birliği veya dernek çalışmaları hakkında
        bilgi almak için formu doldurabilirsiniz. 
    </p>
</div>

                <?php if(isset($basari)) { ?>
                    <div class="alert alert-success"><?php echo $basari; ?></div>
                <?php } ?>

                <?php if(isset($hata)) { ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php } ?>

                <form method="POST">

                    <div class="mb-3">
                        <label>Ad Soyad</label>
                        <input type="text" name="adsoyad" 
                        class="form-control" required>
                    </div>
    

<div class="mb-3">
    <label class="form-label fw-bold">Konu</label>

    <select name="konu" class="form-select contact-input">

        <option>Seçiniz</option>

        <option>Gönüllülük Başvurusu</option>

        <option>Etkinlik Bilgisi</option>

        <option>Bağış ve Destek</option>

        <option>İş Birliği Talebi</option>

        <option>Genel Bilgi</option>

    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Mesaj Türü</label>

    <select name="mesaj_turu" class="form-select contact-input">

        <option>Bilgi Talebi</option>

        <option>Öneri</option>

        <option>Destek Talebi</option>

        <option>Şikayet</option>

    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-bold d-block">
        Geri Dönüş Tercihi
    </label>

    <div class="d-flex gap-4 mt-2">

        <div>
            <input type="radio" name="donus" value="Telefon">
            Telefon
        </div>

        <div>
            <input type="radio" name="donus" value="E-posta">
            E-posta
        </div>

       
    </div>
</div>

                    <div class="mb-3">
                        <label>E-posta</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                <div class="mb-3">
    <label class="form-label fw-bold">Telefon</label>
    <input type="text" name="telefon" class="form-control contact-input"
           placeholder="05XX XXX XX XX">
</div>
                    <div class="mb-3">
                        <label>Konu</label>
                        <input type="text" name="konu" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label>Mesaj</label>
                        <textarea name="mesaj" rows="6" class="form-control" required></textarea>
                    </div>
<div class="mb-4 mt-3">

    <input type="checkbox" required>

    <span style="font-size:14px;color:#64748b;">
        KVKK ve iletişim onayını kabul ediyorum.
    </span>

</div>
                    <button type="submit" name="gonder" class="btn-main">
                        Mesaj Gönder
                    </button>

                </form>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="info-box">

    <h3 class="fw-bold mb-4">Renkli Düşler Çocuk Derneği</h3>

    <div class="info-item">
        <strong>Adres</strong>
        <p class="mb-0">
            Adnan Menderes Mahallesi, Rahmi Üstel Caddesi,<br>
            77200 Yalova Merkez / Yalova
        </p>
    </div>

    <div class="info-item">
        <strong>Telefon</strong>
        <p class="mb-0">0226 000 00 00</p>
    </div>

    <div class="info-item">
        <strong>E-posta</strong>
        <p class="mb-0">info@renklidusler.org</p>
    </div>

    <div class="contact-mini-grid">

    <div class="mini-info-card">
        <strong>Çalışma Saatleri</strong>
        <span>09:00 - 18:00</span>
    </div>

    <div class="mini-info-card">
        <strong>Ortalama Dönüş</strong>
        <span>24 Saat</span>
    </div>

</div>
    <div class="map-box">
        <iframe
            src="https://www.google.com/maps?q=Adnan%20Menderes%20Rahmi%20%C3%9Cstel%20Caddesi%2077200%20Yalova%20Merkez%20Yalova&output=embed"
            loading="lazy">
        </iframe>
    </div>

</div>
</section>

</body>
</html>