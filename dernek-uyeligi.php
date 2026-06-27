<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Dernek Üyeliği | Renkli Düşler</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include "config/db.php";

$mevcut_uyeler = mysqli_query($baglanti, "SELECT * FROM mevcut_uyeler ORDER BY id DESC");
?>

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
    color:white !important;
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

.hero{
    background:
    linear-gradient(120deg,rgba(23,32,51,.88),rgba(15,118,110,.78)),
    url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    padding:90px 0;
    color:white;
}

.hero h1{
    font-size:48px;
    font-weight:900;
}

.content-card{
    background:white;
    border-radius:28px;
    padding:40px;
    box-shadow:0 15px 35px rgba(23,32,51,.12);
    margin-top:-45px;
    position:relative;
    z-index:5;
}

.section-title{
    background:#0f766e;
    color:white;
    padding:16px 22px;
    border-radius:18px;
    font-weight:900;
    margin-bottom:25px;
}

.info-text{
    color:#475569;
    line-height:1.8;
    font-size:16px;
}

.btn-main{
    display:inline-block;
    background:#0f766e;
    color:white;
    text-decoration:none;
    padding:14px 28px;
    border-radius:16px;
    font-weight:850;
    margin:25px 0;
}

.btn-main:hover{
    background:#115e59;
    color:white;
}

.bank-table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
    overflow:hidden;
    border-radius:18px;
}

.bank-table td{
    border:1px solid #e2e8f0;
    padding:16px;
    color:#334155;
}

.bank-table td:first-child{
    background:#f8fafc;
    font-weight:800;
    width:35%;
}

.members-title{
    text-align:center;
    font-weight:900;
    color:#172033;
    margin:45px 0 25px;
}

.member-list{
    columns:4;
    list-style:none;
    padding:0;
    margin:0;
    text-align:center;
}

.member-list li{
    color:#475569;
    margin-bottom:8px;
    font-weight:600;
}

.footer{
    background:#172033;
    color:white;
    text-align:center;
    padding:25px 0;
    margin-top:60px;
}

@media(max-width:768px){
    .member-list{
        columns:2;
    }

    .hero h1{
        font-size:36px;
    }

    .content-card{
        padding:25px;
    }
}
.active-dropdown{
    background:#eef8f6 !important;
    color:#0f766e !important;
    border-radius:14px;
    font-weight:800 !important;
}
.member-card{
    background:#ffffff;
    border:1px solid #e2e8f0;
    border-radius:14px;
    padding:10px 14px;
    text-align:center;
    font-weight:700;
    color:#172033;
    box-shadow:0 4px 12px rgba(23,32,51,.05);
    font-size:15px;
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
                <a class="nav-link active" href="#">Dernek ▾</a>

                <div class="dropdown-menu-custom">
                    <a href="index.php#hakkimizda">Dernek Hakkında</a>
                    <a href="index.php#faaliyetler">Yönetim Kurulu</a>
                    <a class="active-dropdown" href="dernek-uyeligi.php">
    Dernek Üyeliği
</a>
                    <a href="gonullu.php">Gönüllü Başvurusu</a>
                </div>
            </div>

            <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>
            <a class="nav-link" href="iletisim.php">İletişim</a>

        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1>Dernek Üyeliği</h1>
        <p class="lead mt-3">
            Renkli Düşler Çocuk Derneği ailesine katılarak çocukların eğitim, sosyal gelişim ve kültürel etkinliklerine destek olabilirsiniz.
        </p>
    </div>
</section>

<section class="container">
    <div class="content-card">

        <div class="section-title">
            Dernek Üyeliği Başvurusu
        </div>

        <p class="info-text">
            Değerli Çocuk Dostu;
        </p>

        <p class="info-text">
            Derneğimize üyelik için başvuran kişilerin üyelik durumu, yönetim kurulu onayı sonrasında gerçekleşir.
            Üyelik başvurusu için aşağıdaki bilgileri inceleyebilir ve başvuru formunu doldurabilirsiniz.
        </p>

        <p class="info-text">
            Başvuru sürecinde kimlik bilgileri, iletişim bilgileri ve üyelik talebine ilişkin bilgiler alınır.
            Başvurular dernek yönetimi tarafından değerlendirilir.
        </p>

        <a href="uye-basvuru-formu.php" class="btn-main">
    Dernek Üyelik Başvuru Formu İçin Tıklayınız
</a>

        <table class="bank-table">
            <tr>
                <td>Banka Adı</td>
                <td>Garanti Bankası A.Ş.</td>
            </tr>
            <tr>
                <td>Şube Adı / Kodu</td>
                <td>183</td>
            </tr>
            <tr>
                <td>Hesap Adı</td>
                <td>Renkli Düşler Çocuk Derneği</td>
            </tr>
            <tr>
                <td>Hesap No</td>
                <td>6296389</td>
            </tr>
            <tr>
                <td>IBAN</td>
                <td>TR85 0006 2000 1830 0006 2963 89</td>
            </tr>
        </table>

      <h3 class="members-title">Mevcut Üyeler</h3>

<div class="row g-3">

    <?php while($u = mysqli_fetch_assoc($mevcut_uyeler)) { ?>

      <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <div class="member-card">
                <?php echo $u["adsoyad"]; ?>
            </div>
        </div>

    <?php } ?>

</div>
</section>

<footer class="footer">
    © 2026 Renkli Düşler Çocuk Derneği
</footer>

</body>
</html>