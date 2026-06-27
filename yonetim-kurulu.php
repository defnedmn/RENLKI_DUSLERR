<?php
include "config/db.php";

$kurul = mysqli_query($baglanti, "SELECT * FROM yonetim_kurulu ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Yönetim Kurulu | Renkli Düşler</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f7f1e8;
    font-family:"Segoe UI",Arial,sans-serif;
    color:#172033;
}

/* NAVBAR */

.navbar{
    background:#172033;
}

.nav-link{
    color:white !important;
    font-weight:700;
}

.nav-link:hover{
    color:#67e8f9 !important;
}

/* HERO */

.hero{
    background:
    linear-gradient(rgba(15,23,42,.78),rgba(15,118,110,.72)),
    url("https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=1600&auto=format&fit=crop");

    background-size:cover;
    background-position:center;
    padding:140px 0 120px;
    color:white;
    position:relative;
}

.hero::after{
    content:"";
    position:absolute;
    inset:0;
    backdrop-filter:blur(2px);
}

.hero .container{
    position:relative;
    z-index:2;
}

.hero h1{
    font-size:64px;
    font-weight:900;
    margin-bottom:20px;
}

.hero p{
    max-width:760px;
    font-size:20px;
    line-height:1.7;
}

/* SECTION */

.section-title{
    text-align:center;
    margin-bottom:50px;
}

.section-title h2{
    font-weight:900;
    color:#172033;
}

.section-title p{
    color:#64748b;
}

/* CARD */
.board-card{
    background:rgba(255,255,255,.92);
    backdrop-filter:blur(12px);
    border-radius:32px;
    padding:35px 25px;
    text-align:center;
    box-shadow:0 20px 45px rgba(15,23,42,.10);
    transition:.35s;
    height:100%;
    border:1px solid rgba(255,255,255,.6);
    overflow:hidden;
    position:relative;
}

.board-card::before{
    content:"";
    position:absolute;
    top:-80px;
    right:-80px;
    width:180px;
    height:180px;
    background:linear-gradient(135deg,#67e8f9,#0f766e);
    opacity:.08;
    border-radius:50%;
}

.board-card:hover{
    transform:translateY(-10px) scale(1.02);
    box-shadow:0 25px 55px rgba(15,23,42,.18);
}

.avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    margin:auto;
    background:linear-gradient(135deg,#0f766e,#172033);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:50px;
    margin-bottom:22px;
    box-shadow:0 10px 30px rgba(15,118,110,.35);
    border:5px solid rgba(255,255,255,.8);
}

.board-card h4{
    font-weight:900;
    margin-bottom:8px;
    color:#172033;
    font-size:24px;
}

.role{
    color:#0f766e;
    font-weight:800;
    margin-bottom:22px;
    font-size:15px;
    letter-spacing:.4px;
}

.bio-btn{
    background:linear-gradient(135deg,#0f766e,#14b8a6);
    color:white;
    border:none;
    border-radius:16px;
    padding:12px 24px;
    font-weight:800;
    transition:.25s;
    box-shadow:0 10px 25px rgba(20,184,166,.25);
}

.bio-btn:hover{
    transform:translateY(-2px);
    background:linear-gradient(135deg,#115e59,#0f766e);
}
.role{
    color:#0f766e;
    font-weight:800;
    margin-bottom:18px;
}



.bio-btn:hover{
    background:#115e59;
}

/* FOOTER */

.footer{
    background:#172033;
    color:white;
    margin-top:90px;
    padding:20px 0;
}

.footer h5{
    font-weight:900;
}
{
    border-radius:14px;
    font-weight:800 !important;
}
.nav-dropdown{
    position:relative;
}

.dropdown-menu-custom{
    position:absolute;
    top:42px;
    left:0;
    background:white;
    min-width:300px;
    border-radius:24px;
    padding:18px;
    display:none;
    flex-direction:column;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    z-index:9999;
}

.dropdown-menu-custom a{
    text-decoration:none;
    color:#172033;
    padding:15px 18px;
    border-radius:16px;
    font-weight:700;
    display:block;
    transition:.2s;
}

.dropdown-menu-custom a:hover,
.dropdown-menu-custom a.active-dropdown{
    background:#eef8f6;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}
.navbar-brand{
    color:white !important;
}

.navbar-nav{
    gap:18px;
}

.nav-dropdown{
    position:relative;
}

.dropdown-menu-custom{
    position:absolute;
    top:42px;
    left:0;
    background:white;
    min-width:300px;
    border-radius:24px;
    padding:18px;
    display:none;
    flex-direction:column;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    z-index:9999;
}

.dropdown-menu-custom a{
    text-decoration:none;
    color:#172033;
    padding:15px 18px;
    border-radius:16px;
    font-weight:700;
    display:block;
}

.dropdown-menu-custom a:hover,
.dropdown-menu-custom a.active-dropdown{
    background:#eef8f6;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}
.modal-body{
    white-space:normal;
    word-break:break-word;
    overflow-wrap:break-word;
    line-height:1.8;
}
</style>
</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            Renkli Düşler
        </a>

        <div class="navbar-nav ms-auto align-items-center">

            <a class="nav-link" href="index.php">Ana Sayfa</a>

            <div class="nav-dropdown">
                <a class="nav-link active" href="#">Dernek ▾</a>

                <div class="dropdown-menu-custom">
                    <a href="index.php#hakkimizda">Dernek Hakkında</a>
                    <a class="active-dropdown" href="yonetim-kurulu.php">Yönetim Kurulu</a>
                    <a href="dernek-uyeligi.php">Dernek Üyeliği</a>
                    <a href="gonullu.php">Gönüllü Başvurusu</a>
                </div>
            </div>

            <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>
            <a class="nav-link" href="iletisim.php">İletişim</a>

        </div>

    </div>
</nav>

<!-- HERO -->

<section class="hero">
<div class="container">

<h1>Yönetim Kurulu</h1>

<p class="mt-3">
Renkli Düşler Çocuk Derneği yönetim ekibi; eğitim,
sosyal gelişim ve gönüllülük alanlarında çocukların
geleceği için çalışmalar yürütmektedir.
</p>

</div>
</section>

<!-- CONTENT -->

<section class="container py-5">

<div class="section-title">
<h2>Kurul Üyeleri</h2>

<p>
Derneğimizin yönetim kadrosunu inceleyebilirsiniz.
</p>
</div>

<div class="row g-4">
<div class="row g-4">

<?php while($k = mysqli_fetch_assoc($kurul)) { ?>

    <div class="col-lg-3 col-md-6">

        <div class="board-card">

            <div class="avatar">

                <?php if($k["cinsiyet"] == "Kadın") { ?>
                    <i class="bi bi-person-standing-dress"></i>
                <?php } else { ?>
                    <i class="bi bi-person-standing"></i>
                <?php } ?>

            </div>

            <h4><?php echo $k["adsoyad"]; ?></h4>

            <div class="role">
                <?php echo $k["gorev"]; ?>
            </div>

            <button class="bio-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#bio<?php echo $k["id"]; ?>">
                Özgeçmiş
            </button>

        </div>

    </div>

    <!-- MODAL -->

    <div class="modal fade" id="bio<?php echo $k["id"]; ?>">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <?php echo $k["adsoyad"]; ?>
                    </h5>

                    <button class="btn-close"
                    data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">
                    <?php echo nl2br($k["ozgecmis"]); ?>
                </div>

            </div>

        </div>

    </div>

<?php } ?>

</div>

<div class="modal fade" id="bio1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Ayşe Kara</h5>
<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Prof. Dr. Ayşe Kara , 1948 yılında Kadirli/Adana’da doğdu. 1971 yılında İstanbul Üniversitesi Tıp Fakültesinden mezun oldu. Çocuk sağlığı ve hastalıkları alanında uzmanlaşarak Türkiye’nin ilk neonatologları arasında yer aldı.

Karadeniz Üniversitesi Tıp Fakültesi’nin kuruluş çalışmalarında görev aldı, yenidoğan sağlığı alanında önemli projeler yürüttü ve çok sayıda çocuk doktoru ile neonatoloji uzmanı yetiştirdi.<br></br>

41 yılı aşkın meslek hayatı boyunca çocuk sağlığı alanında yüzlerce bilimsel çalışma, eğitim projesi ve sosyal sorumluluk faaliyetinde bulundu. Emeklilik sonrası da anne ve çocuk sağlığına yönelik çalışmalarını sürdürmüş, 2016 yılında Renkli Düşler Derneği kurucu üyeleri arasında yer almıştır.
</div>
</div>
</div>
</div>
<!-- MODAL 2 -->

<div class="modal fade" id="bio2">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Mehmet Yılmaz</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Prof. Dr. Mehmet Yılmaz ÜL 1975 yılında Siirt’in merkez İlçesinde doğdu. 1992 yılında Siirt Lisesi’nden, 1998
yılında İstanbul Üniversitesi İstanbul Tıp Fakültesi’nden mezun oldu. Çocuk Sağlığı ve Hastalıkları
alanında ihtisasını 1998-2002 yılları arasında İstanbul Üniversitesi İstanbul Tıp Fakültesi Çocuk Sağlığı
ve Hastalıkları Ana Bilim Dalında yaptı. 2003-2006 yıllarında Şişli Hamidiye Etfal Eğitim ve Araştırma
Hastanesinde Neonatoloji yan dal ihtisasını tamamladı.<br></br>
 2007 yılında Şişli Hamidiye Etfal Eğitim ve
Araştırma Hastanesinde Neonatoloji Uzmanı olarak çalışmaya başladı. 2010 yılında Klinik Şef
Muavinliği ve 2012 yılında Doçent ünvanını aldı. 2013 yılında Eğitim Görevlisi ve Klinik İdari
Sorumlusu oldu. 2016 YILINDA Klinik Eğitim Sorumlusu ve 2018 yılında Profesörlük ünvanını aldı. Yurt
dışı ve yurt içinde yayınlanan 250’nin üzerinde bilimsel makalesi bulunmaktadır. 2016 yılında kurulan
Renkli Düşler Derneğinin Kurucu Üyesi oldu, yönetim kurulunca ilk başkanı olarak görevlendirildi ve
halen bu görevini sürdürmektedir
</div>

</div>
</div>
</div>

<!-- MODAL 3 -->

<div class="modal fade" id="bio3">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Elif Demir</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
İstanbul Üniversitesi Tıp Fakültesini bitirdikten sonra Gazi Universitesi Tıp Fakültesi,
Çocuk Sağlığı ve Hastalıkları Ana Bilim Dalı'nda uzmanlık eğitimini tamamladım. 2000-2002
yılarında Gazi Universitesi Tıp Fakültesi, Çocuk Sağlığı ve Hastalıkları Ana Bilim Dalı'nda
başasistan olarak görev aldım. Ankara Universitesi Tıp Fakültesi, Çocuk Sağlığı ve Hastalıkları
Ana Bilim Dalı'nda Çocuk Enfeksiyon yandal ihtisasımı yaptım.<br></br> Yandal ihtisası sonrası Türk
Eğitim Vakfı Üstün Başarı Bursunu kazandım ve Harvard University, Boston Children Hospital’
de 3 yıl Clinical Research Fellowship pozisyonunda immunsupresif hasta enfeksiyonları, pediatrik
AIDS, konjenital enfeksiyonlar üzerine çalıştım. Yandal mecburi hizmetini Şişli Etfal Eğitim ve
Araştırma Hastanesi, Çocuk Enfeksiyon Kliniği'nde 1200 gün olarak tamamladım. 2013 yılında
Doçentlik, 2020 yılında Profesörlük ünvanını aldım.
Halen aynı hastanede, Sağlık Bilimleri Üniversitesi kadrosunda Çocuk Enfeksiyon
Kliniği Eğitim ve İdari Sorumlusu olarak görev yapmaktayım. Uluslararası dergilerde 65, ulusal
dergilerde 44 adet yayınım ve 17 adet ulusal ve uluslararası kitap bölüm yazarlığım vardır. 
</div>

</div>
</div>
</div>

<!-- MODAL 4 -->

<div class="modal fade" id="bio4">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Ahmet Koç</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Prof. Dr. Ahmet Koç Baş, 1969 yılında İstanbul’da doğdu. Trakya Üniversitesi Tıp Fakültesi’nden mezun olduktan sonra çocuk sağlığı ve hastalıkları alanında uzmanlığını tamamladı.
Neonatoloji alanında uzmanlaşarak Sağlık Bakanlığı bünyesindeki ilk yenidoğan uzmanlarından biri oldu. Şişli Hamidiye Etfal Eğitim ve Araştırma Hastanesi’nde yenidoğan uzmanı, eğitim görevlisi ve klinik eğitim sorumlusu olarak görev yaptı.<br></br>
Akademik kariyeri boyunca 150’den fazla bilimsel çalışma ve bildiride yer aldı, birçok ödül aldı ve çocuk sağlığı alanında önemli projelerde görev üstlendi. 2016 yılında kurulan Renkli Düşler Derneği’nin kurucu üyeleri arasında yer aldı ve çalışmalarını yenidoğan sağlığı alanında sürdürmektedir..
</div>

</div>
</div>
</div>

<!-- MODAL 5 -->

<div class="modal fade" id="bio5">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Zeynep Arslan</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Doç Dr Zeynep Arslan Balıkesir’ in Dursunbey ilçesinde doğdu. İlk öğrenimini Dursunbey’de orta
öğrenimini Balıkesir’de tamamladı. 1994 yılında İ.Ü İstanbul Tıp Fakültesinden mezun oldu. Çocuk
Sağlığı ve Hastalıkları ihtisasını 1994-1998 yılları arasında İstanbul Üniversitesi İstanbul Tıp Fakültesi
Çocuk Sağlığı ve Hastalıkları ABD da tamamladı. 1998-2014 yılları arasında çeşitli özel sağlık
kuruluşlarında çocuk hekimi ve idareci olarak çalıştı. 2014 yılında Haseki Eğitim ve araştırma
Hastanesine uzman olarak başladı.
<br></br> 2020 yılında doçent ünvanı aldı. Haseki çocuk kliniği idari
sorumlusu olarak çalıştı. Halen aynı klinikte görev yapmaktadır. Yurtiçi ve yurtdışında yüzün üstünde
makalesi vardır. Adli Tıp Kurumu 8. İhtisas dairesinde de görev yapmakta olup, Haseki Klinik
araştırmalar etik kurul üyesidir. 2024 yılından dernek yönetim kurulunda göreve başladı.
</div>

</div>
</div>
</div>

<!-- MODAL 6 -->

<div class="modal fade" id="bio6">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Burak Şahin</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Prof. Dr. Burak Şahin, 1967 yılında Çorlu’da doğdu. İstanbul Üniversitesi İstanbul Tıp Fakültesi’nden mezun olduktan sonra çocuk sağlığı ve hastalıkları alanında uzmanlık eğitimini tamamladı.

1999 yılından itibaren Haydarpaşa Numune Eğitim ve Araştırma Hastanesi’nde görev aldı; başasistanlık, klinik şefliği ve eğitim sorumluluğu gibi önemli görevlerde bulundu. 2021 yılında profesör unvanını aldı.<br></br>

Çocuk enfeksiyon hastalıkları, çocuk göğüs hastalıkları, immünoloji ve alerji alanlarında çalışmalar yürüttü. Akademik kariyeri boyunca birçok kurul ve etik komitede görev aldı, bilimsel yayın ve eğitim faaliyetlerinde aktif rol üstlendi. Halen Sağlık Bilimleri Üniversitesi bünyesinde çocuk kliniği idari ve eğitim sorumlusu olarak görev yapmaktadır.

</div>

</div>
</div>
</div>

<!-- MODAL 7 -->

<div class="modal fade" id="bio7">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Selin Aydın</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Doç. Dr. A. Selin Aydın, 1972 yılında Samsun’da doğdu. İstanbul Üniversitesi İstanbul Tıp Fakültesi’nden mezun olduktan sonra çocuk sağlığı ve hastalıkları alanında uzmanlık eğitimini tamamladı.

Çocuk gastroenteroloji, hepatoloji ve beslenme alanında uzmanlaşarak Şişli Hamidiye Etfal Eğitim ve Araştırma Hastanesi’nde görev aldı. 2015 yılında doçent unvanını aldı ve akademik çalışmalarını çocuk sağlığı alanında sürdürdü.<br></br>

Ulusal ve uluslararası birçok bilimsel yayına, kongre sunumuna ve eğitim programına katkı sağlayan Doç. Dr. A. Merve Usta, çocuk gastroenterolojisi alanındaki çalışmalarına halen aktif olarak devam etmektedir.

</div>

</div>
</div>
</div>

<!-- MODAL 8 -->

<div class="modal fade" id="bio8">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Can Öztürk</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
1978 yılında İstanbul’da doğdum. 1994 yılında Nişantaşı Anadolu Lisesi’nden, 2000 yılında ise
İstanbul Üniversitesi Cerrahpaşa Tıp Fakültesi’nden mezun oldum. Çocuk Sağlığı ve Hastalıkları
alanında uzmanlık eğitimimi 2004 yılında Cerrahpaşa Tıp Fakültesi Çocuk Sağlığı ve Hastalıkları
Ana Bilim Dalı'nda tamamladım. 2004-2008 yıllarında İstanbul Özel Alman Hastanesi ve Özel Ulus
Klinilk Çocuk ve Ergen Sağlığı merkezinde özel hekimlik yaptım.<br></br>
2008-2012 yılları arasında Şişli Hamidiye Etfal Eğitim ve Araştırma Hastanesinde Neonatoloji
yan dal ihtisasımı tamamladıktan sonra 2012-2015 yılları arasında Gaziantep Çocuk Hastanesi’nde
devlet hizmeti yükümlülüğümü yerine getirdim. Mecburi hizmetimin ardından 2015 yılında tekrar
Şişli Hamidiye Etfal Eğitim ve Araştırma Hastanesine dönerek yenidoğan uzmanı olarak görev aldım.
2020 yılında Doçent ünvanı aldım. 2016 yılında kurulan Çocuk Dostları Derneğinin Kurucu
Üyesiyim. Halen Şişli Hamidiye Etfal Eğitim ve Araştırma Hastanesi Yenidoğan Kliniği’nde
çalışmaktayım. 
</div>

</div>
</div>
</div>

<!-- FOOTER -->

<footer class="footer">
<div class="container text-center">

<h5>Renkli Düşler Çocuk Derneği</h5>

<p class="mb-0">
Çocukların geleceği için birlikte çalışıyoruz.
</p>

</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>