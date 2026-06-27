<?php
include "config/db.php";

if(isset($_POST["gonder"])){

    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $ilgi_alani = $_POST["ilgi_alani"];
    $musaitlik = $_POST["musaitlik"];
    $deneyim = $_POST["deneyim"];
    $deneyim_aciklama = $_POST["deneyim_aciklama"];
    $mesaj = $_POST["mesaj"];

    $ekle = mysqli_query($baglanti, "INSERT INTO gonulluler
    (adsoyad, email, telefon, ilgi_alani, musaitlik, deneyim, deneyim_aciklama, mesaj)
    VALUES
    ('$adsoyad', '$email', '$telefon', '$ilgi_alani', '$musaitlik', '$deneyim', '$deneyim_aciklama', '$mesaj')");

    if($ekle){
        $basari = "Başvurunuz başarıyla gönderildi.";
    }else{
        die("SQL HATASI: " . mysqli_error($baglanti));
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Ol | Renkli Düşler</title>

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

.hero{
    background:
    linear-gradient(120deg,rgba(23,32,51,.9),rgba(15,118,110,.8)),
    url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    padding:95px 0;
    color:white;
}

.hero h1{
    font-weight:900;
    font-size:52px;
}

.hero p{
    max-width:720px;
    color:#edf2f7;
    font-size:18px;
    line-height:1.7;
}

.form-card{
    background:white;
    border-radius:30px;
    padding:36px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.form-card h3{
    font-weight:900;
    color:#172033;
}

.form-control,
.form-select{
    border-radius:15px;
    padding:13px 15px;
    border:1px solid #dbe3ef;
}

label{
    font-weight:750;
    margin-bottom:7px;
    color:#334155;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px;
    border-radius:15px;
    font-weight:850;
    width:100%;
}

.info-box{
    background:#172033;
    color:white;
    border-radius:30px;
    padding:36px;
    height:100%;
}

.info-box h3{
    font-weight:900;
}

.info-item{
    background:rgba(255,255,255,.08);
    padding:16px;
    border-radius:18px;
    margin-bottom:14px;
}

.footer{
    background:#172033;
    color:white;
    padding:25px 0;
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
.dropdown-menu-custom a{
    text-decoration:none;
    color:#172033;
    padding:14px 16px;
    border-radius:14px;
    font-weight:650;
    display:block;
    transition:.2s;
}

.dropdown-menu-custom a:hover{
    background:#eef8f6 !important;
    color:#0f766e !important;
}

.dropdown-menu-custom a:hover{
    background:#eef8f6;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}
.active-dropdown{
    background:#eef8f6 !important;
    color:#0f766e !important;
    border-radius:14px;
    font-weight:800 !important;
}
.volunteer-info-box{
    background:linear-gradient(180deg,#172033,#0f766e);
    color:white;
    border-radius:30px;
    padding:30px;
    box-shadow:0 18px 45px rgba(23,32,51,.16);
}

.info-badge{
    display:inline-block;
    background:rgba(255,255,255,.14);
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:850;
    margin-bottom:14px;
}

.volunteer-info-box h3{
    font-weight:900;
    margin-bottom:22px;
}

.process-list{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.process-item{
    display:flex;
    gap:14px;
    align-items:flex-start;
}

.process-item > span{
    min-width:42px;
    height:42px;
    background:#f6b73c;
    color:#172033;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
}

.process-item strong{
    display:block;
    font-weight:900;
    margin-bottom:4px;
}

.process-item p{
    color:#e2e8f0;
    line-height:1.6;
    margin:0;
    font-size:14px;
}

.volunteer-duty-box{
    margin-top:26px;
    background:rgba(255,255,255,.10);
    border-radius:22px;
    padding:22px;
}

.volunteer-duty-box h4{
    font-weight:900;
    margin-bottom:12px;
}

.volunteer-duty-box p{
    color:#e2e8f0;
    line-height:1.7;
    font-size:14px;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Renkli Düşler</a>

    <div class="navbar-nav ms-auto align-items-center">

    <a class="nav-link" href="index.php">Ana Sayfa</a>

    <div class="nav-dropdown">
        <a class="nav-link active" href="#">
            Dernek ▾
        </a>

        <div class="dropdown-menu-custom">
            <a href="index.php#hakkimizda">Dernek Hakkında</a>
            <a href="yonetim-kurulu.php">Yönetim Kurulu</a>
            <a href="dernek-uyeligi.php">Dernek Üyeliği</a>
           <a class="active-dropdown" href="gonullu.php">
    Gönüllü Başvurusu
</a>
        </div>
    </div>

    <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>

    <a class="nav-link" href="iletisim.php">İletişim</a>

</div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1>Gönüllü Ol</h1>
        <p class="mt-3">
            Çocukların eğitim, sosyal gelişim ve kültürel etkinliklere erişimini desteklemek için
            sen de Renkli Düşler gönüllü ekibine katılabilirsin.
        </p>
    </div>
</section>

<section class="container py-5">
    <div class="row g-4">

        <div class="col-lg-7">
            <div class="form-card">

                <h3 class="mb-4">Gönüllü Başvuru Formu</h3>

                <?php if (isset($basari)) { ?>
                    <div class="alert alert-success"><?php echo $basari; ?></div>
                <?php } ?>

                <?php if (isset($hata)) { ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php } ?>

            <form method="POST" action="gonullu.php">

                    <div class="mb-3">
                        <label>Ad Soyad</label>
                        <input type="text" name="adsoyad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>E-posta</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
    <label class="fw-bold">Müsaitlik Durumu</label>

    <select name="musaitlik" class="form-select" required>
        <option value="">Seçiniz</option>
        <option value="Hafta içi destek verebilirim">Hafta içi destek verebilirim</option>
        <option value="Hafta sonu destek verebilirim">Hafta sonu destek verebilirim</option>
        <option value="Hem hafta içi hem hafta sonu destek verebilirim">Hem hafta içi hem hafta sonu destek verebilirim</option>
        <option value="Online destek verebilirim">Online destek verebilirim</option>
    </select>
</div>

<div class="mb-3">
    <label class="fw-bold">Daha Önce Gönüllülük Deneyiminiz Oldu mu?</label>

    <select name="deneyim" class="form-select" required>
        <option value="">Seçiniz</option>
        <option value="Evet">Evet</option>
        <option value="Hayır">Hayır</option>
    </select>
</div>

<div class="mb-3">
    <label class="fw-bold">Varsa Kısaca Deneyiminizi Yazın</label>
    <textarea name="deneyim_aciklama" class="form-control" rows="3"
              placeholder="Daha önce katıldığınız gönüllülük çalışmaları varsa kısaca yazabilirsiniz."></textarea>
</div>

                    <div class="mb-3">
                        <label>Telefon</label>
                        <input type="text" name="telefon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>İlgi Alanı</label>
                        <select name="ilgi_alani" class="form-select" required>
                            <option value="">Seçiniz</option>
                            <option value="Eğitim Desteği">Eğitim Desteği</option>
                            <option value="Sanat Atölyeleri">Sanat Atölyeleri</option>
                            <option value="Sosyal Etkinlikler">Sosyal Etkinlikler</option>
                            <option value="Kitap ve Oyuncak Bağışı">Kitap ve Oyuncak Bağışı</option>
                            <option value="Organizasyon Desteği">Organizasyon Desteği</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Kısa Mesaj</label>
                        <textarea name="mesaj" rows="5" class="form-control" placeholder="Neden gönüllü olmak istiyorsunuz?" required></textarea>
                    </div>

                    <button type="submit" name="gonder" class="btn-main">
                        Başvuruyu Gönder
                    </button>

                </form>

            </div>
        </div>

        <div class="col-lg-5">
           <div class="volunteer-info-box">

    <span class="info-badge">Gönüllülük Süreci</span>

    <h3>Başvurudan Etkinliğe Uzanan Süreç</h3>

    <div class="process-list">

        <div class="process-item">
            <span>01</span>
            <div>
                <strong>Başvuru Formunu Doldur</strong>
                <p>İletişim bilgilerini, ilgi alanını ve müsaitlik durumunu bizimle paylaş.</p>
            </div>
        </div>

        <div class="process-item">
            <span>02</span>
            <div>
                <strong>Ekibimiz Başvurunu İnceler</strong>
                <p>Başvurun, dernek ekibi tarafından gönüllülük alanlarına göre değerlendirilir.</p>
            </div>
        </div>

        <div class="process-item">
            <span>03</span>
            <div>
                <strong>Tanışma ve Yönlendirme</strong>
                <p>Uygun görülmesi halinde seninle iletişime geçilir ve süreç hakkında bilgi verilir.</p>
            </div>
        </div>

        <div class="process-item">
            <span>04</span>
            <div>
                <strong>Etkinliklere Katılım</strong>
                <p>Masal okuma, sanat atölyesi, eğitim desteği veya sosyal etkinliklerde görev alabilirsin.</p>
            </div>
        </div>

    </div>

    <div class="volunteer-duty-box">
        <h4>Gönüllüler Ne Yapar?</h4>

        <p>
            Gönüllülerimiz; çocuk etkinliklerinde destek olur, atölye çalışmalarına eşlik eder,
            etkinlik hazırlıklarında görev alır ve çocukların güvenli, keyifli bir ortamda
            vakit geçirmesine katkı sağlar.
        </p>

        <p>
            Her gönüllü kendi ilgi alanı ve müsaitlik durumuna göre değerlendirilir.
            Böylece herkes katkı sağlayabileceği en uygun alanda yer alır.
        </p>
    </div>

</div>
</div>
</div>
</section>

<footer class="footer">">
    <div class="container text-center">
        © 2026 Renkli Düşler Çocuk Derneği
    </div>
</footer>

</body>
</html>