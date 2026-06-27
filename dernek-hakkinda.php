<?php include "config/db.php"; ?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Dernek Hakkında</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#172033;
}

.navbar{
    background:#172033;
    padding:16px 0;
}

.navbar-brand{
    font-weight:900;
    font-size:22px;
}

.nav-link{
    color:white !important;
    font-weight:700;
    margin-left:14px;
}

.nav-link.active{
    color:#f6b73c !important;
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
    border-radius:16px;
    padding:12px;
    display:none;
    flex-direction:column;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    z-index:999;
}

.dropdown-menu-custom a{
    color:#1e293b !important;
    text-decoration:none;
    padding:12px;
    border-radius:10px;
    font-weight:700;
    display:block;
}

.dropdown-menu-custom a:hover{
    background:#eef8f6;
    color:#0f766e !important;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}

.about-hero{
    min-height:430px;
    background:
      linear-gradient(120deg,rgba(23,32,51,.72),rgba(15,118,110,.60)),
      url("https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    color:white;
    display:flex;
    align-items:center;
}

.about-hero h1{
    font-size:56px;
    font-weight:900;
    max-width:760px;
    margin-bottom:18px;
}

.about-hero p{
    font-size:18px;
    max-width:680px;
    line-height:1.8;
    color:#f1f5f9;
}

.content-box{
    background:white;
    border-radius:34px;
    padding:45px;
    margin-top:-70px;
    position:relative;
    z-index:5;
    box-shadow:0 18px 45px rgba(23,32,51,.10);
}

.title{
    font-size:40px;
    font-weight:900;
    color:#172033;
    margin-bottom:20px;
}

.text{
    color:#64748b;
    line-height:2;
    font-size:17px;
}.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    margin-top:35px;
}

.info-card{
    background:linear-gradient(180deg,#fff7ed,#ffffff);
    border-radius:24px;
    padding:26px;
    box-shadow:0 10px 28px rgba(23,32,51,.07);
}

.info-card h4,
.value-box h4{
    font-weight:900;
    color:#172033;
}

.info-card p,
.value-box p{
    color:#64748b;
    line-height:1.7;
    margin:0;
}

.values-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-top:28px;
}

.value-box{
    background:white;
    border-radius:24px;
    padding:24px;
    box-shadow:0 10px 28px rgba(23,32,51,.07);
}

.value-box span{
    display:inline-flex;
    width:42px;
    height:42px;
    border-radius:50%;
    background:#0f766e;
    color:white;
    align-items:center;
    justify-content:center;
    font-weight:900;
    margin-bottom:14px;
}

.timeline{
    margin-top:30px;
    border-left:4px solid #0f766e;
    padding-left:24px;
}

.timeline-item{
    background:#f8fafc;
    border-radius:20px;
    padding:18px;
    margin-bottom:16px;
}

.timeline-item strong{
    color:#0f766e;
    font-size:20px;
    font-weight:900;
}

.timeline-item p{
    color:#64748b;
    margin:6px 0 0;
}

@media(max-width:992px){
    .info-grid,
    .values-grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">Renkli Düşler Derneği</a>

       <div class="navbar-nav ms-auto align-items-center">

    <a class="nav-link active" href="index.php">Ana Sayfa</a>

    <div class="nav-dropdown">
        <a class="nav-link" href="#">Dernek ▾</a>

        <div class="dropdown-menu-custom">
         <a href="dernek-hakkinda.php">Dernek Hakkında</a>
<a href="yonetim-kurulu.php">Yönetim Kurulu</a>
<a href="dernek-uyeligi.php">Dernek Üyeliği</a>
            <a href="gonullu.php">Gönüllü Başvurusu</a>
        </div>
    </div>

    <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>
   
    <a class="nav-link" href="iletisim.php">İletişim</a>
  
</div>
</div>
</nav>
<section class="about-hero">
    <div class="container">
        <h1>Renkli Düşler Çocuk Derneği</h1>
        <p>
            Çocukların eğitim, sanat ve sosyal gelişim yolculuğuna umutla eşlik ediyoruz.
        </p>
    </div>
</section>

<div class="container pb-5">

  <h2 class="title">Biz Kimiz?</h2>

<p class="text">
    Renkli Düşler Çocuk Derneği, çocukların sosyal, kültürel ve eğitsel gelişimini desteklemek amacıyla kurulmuş, gönüllülük esasına dayalı bir sivil toplum kuruluşudur. Derneğimiz; çocukların kendilerini güvenli, değerli ve özgür hissedebilecekleri alanlar oluşturmayı hedefler.
</p>

<p class="text">
    Eğitimde fırsat eşitliğini destekleyen, kültür-sanat faaliyetlerini yaygınlaştıran ve çocukların sosyal hayata daha aktif katılmasını sağlayan çalışmalar yürütürüz. Her çocuğun ilgi alanlarını keşfetme, yeteneklerini geliştirme ve kendini ifade etme hakkına sahip olduğuna inanırız.
</p>

<div class="info-grid">

    <div class="info-card">
        <h4>Misyonumuz</h4>
        <p>
            Çocukların eğitim, sanat, kültür ve sosyal gelişim alanlarında desteklenmesini sağlamak; onların özgüvenli, üretken ve duyarlı bireyler olarak yetişmesine katkıda bulunmak.
        </p>
    </div>

    <div class="info-card">
        <h4>Vizyonumuz</h4>
        <p>
            Her çocuğun eşit imkanlarla büyüyebildiği, kendini ifade edebildiği ve hayallerini gerçekleştirebildiği daha kapsayıcı bir toplumun oluşmasına katkı sunmak.
        </p>
    </div>

</div>

<h2 class="title mt-5">Kuruluş Hikayemiz</h2>

<p class="text">
    Renkli Düşler Çocuk Derneği, çocukların eğitim ve sosyal gelişim süreçlerinde daha fazla desteğe ihtiyaç duyduğunu gören gönüllü bir ekip tarafından hayata geçirilmiştir. Başlangıçta küçük çaplı kitap bağışı, kırtasiye desteği ve atölye çalışmalarıyla başlayan faaliyetlerimiz zamanla daha düzenli ve sürdürülebilir bir yapıya dönüşmüştür.
</p>

<p class="text">
    Derneğimizin temel çıkış noktası, çocukların yalnızca akademik başarıyla değil; oyun, sanat, sosyal iletişim, özgüven ve dayanışma duygusuyla da geliştiği düşüncesidir. Bu nedenle çalışmalarımızı çocukların bütüncül gelişimini destekleyecek şekilde planlıyoruz.
</p>

<h2 class="title mt-5">Değerlerimiz</h2>

<div class="values-grid">

    <div class="value-box">
        <span>01</span>
        <h4>Güven</h4>
        <p>Çocukların kendilerini rahatça ifade edebilecekleri güvenli ortamlar oluştururuz.</p>
    </div>

    <div class="value-box">
        <span>02</span>
        <h4>Eşitlik</h4>
        <p>Her çocuğun fırsatlara adil biçimde ulaşması gerektiğine inanırız.</p>
    </div>

    <div class="value-box">
        <span>03</span>
        <h4>Gönüllülük</h4>
        <p>Dayanışma kültürünü güçlendiren gönüllü katılımı çalışmalarımızın merkezine alırız.</p>
    </div>

    <div class="value-box">
        <span>04</span>
        <h4>Üretkenlik</h4>
        <p>Çocukların hayal gücünü, merakını ve üretme isteğini destekleyen etkinlikler düzenleriz.</p>
    </div>

</div>

<h2 class="title mt-5">Çalışma Alanlarımız</h2>

<p class="text">
    Derneğimiz; eğitim destekleri, masal okuma etkinlikleri, boyama ve sanat atölyeleri, drama çalışmaları, sosyal sorumluluk projeleri, çevre farkındalığı etkinlikleri ve gönüllü destek programları gibi farklı alanlarda faaliyet yürütür.
</p>

<p class="text">
    Etkinliklerimizde çocukların yalnızca katılımcı değil, aynı zamanda düşünen, üreten, soru soran ve kendini ifade eden bireyler olmalarını önemseriz. Bu nedenle her çalışmamızda çocukların yaş gruplarına, gelişim düzeylerine ve ihtiyaçlarına uygun içerikler hazırlamaya özen gösteririz.
</p>

<div class="timeline">

    <div class="timeline-item">
        <strong>2023</strong>
        <p>Gönüllü ekip oluşturuldu ve ilk çocuk etkinlikleri planlandı.</p>
    </div>

    <div class="timeline-item">
        <strong>2024</strong>
        <p>Masal okuma, boyama ve drama atölyeleri düzenli hale getirildi.</p>
    </div>

    <div class="timeline-item">
        <strong>2025</strong>
        <p>Gönüllü başvuru sistemi ve etkinlik yönetimi dijital ortama taşındı.</p>
    </div>

    <div class="timeline-item">
        <strong>2026</strong>
        <p>Dernek çalışmalarının daha geniş kitlelere ulaşması hedeflendi.</p>
    </div>

</div>

<h2 class="title mt-5">Gelecek Hedeflerimiz</h2>

<p class="text">
    Önümüzdeki dönemde daha fazla çocuğa ulaşmak, gönüllü ağımızı genişletmek, eğitim ve sanat temelli atölyelerimizi artırmak ve çocukların gelişimini destekleyen sürdürülebilir projeler üretmek istiyoruz.
</p>

<p class="text">
    Renkli Düşler olarak amacımız; çocukların hayatına dokunan, toplumsal dayanışmayı güçlendiren ve her çocuğun kendini değerli hissettiği bir destek alanı oluşturmaktır.
</p>

    </div>

</div>

</body>
</html>