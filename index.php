<?php
include "config/db.php";

$faaliyetler = mysqli_query($baglanti, "SELECT * FROM faaliyetler ORDER BY id DESC");
$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY id DESC LIMIT 3");
$mevcut_uyeler = mysqli_query($baglanti, "SELECT * FROM mevcut_uyeler ORDER BY id DESC");
$gonullu_yorumlari = mysqli_query($baglanti, "SELECT * FROM gonullu_yorumlari ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Renkli Düşler Çocuk Derneği</title>

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



.btn-main{
    background:#f6b73c;
    color:#172033;
    padding:14px 24px;
    border-radius:16px;
    text-decoration:none;
    font-weight:850;
    display:inline-block;
}

.btn-outline-light-custom{
    background:white;
    color:#172033;
    padding:14px 24px;
    border-radius:16px;
    text-decoration:none;
    font-weight:850;
    display:inline-block;
    margin-left:10px;
}

.section-title{
    font-weight:900;
    color:#172033;
    margin-bottom:14px;
    font-size:46px;
    line-height:1.1;
}

.section-desc{
    color:#64748b;
    max-width:720px;
    margin:auto;
}

.about-box{
    background:
        linear-gradient(135deg,#fff7ed 0%, #ffffff 45%, #fff1f2 100%);

    border-radius:36px;

    padding:46px;

    position:relative;

    overflow:hidden;

    box-shadow:
        0 22px 55px rgba(244,114,182,.10);

    border:3px solid rgba(255,255,255,.7);

    backdrop-filter:blur(10px);
}
.about-box::before{
    content:"";

    position:absolute;

    top:-90px;
    right:-90px;

    width:240px;
    height:240px;

    background:
        radial-gradient(circle,
        rgba(246,183,60,.28),
        transparent 70%);

    border-radius:50%;
}

.about-box::after{
    content:"";

    position:absolute;

    bottom:-80px;
    left:-80px;

    width:220px;
    height:220px;

    background:
        radial-gradient(circle,
        rgba(244,114,182,.22),
        transparent 70%);

    border-radius:50%;
}
.about-box::before{
    content:"";

    position:absolute;

    top:-80px;
    right:-80px;

    width:220px;
    height:220px;

    background:
        radial-gradient(circle,
        rgba(246,183,60,.18),
        transparent 70%);

    border-radius:50%;
}

.about-box::after{
    content:"";

    position:absolute;

    bottom:-70px;
    left:-70px;

    width:180px;
    height:180px;

    background:
        radial-gradient(circle,
        rgba(244,114,182,.14),
        transparent 70%);

    border-radius:50%;
}

.about-img{
    border-radius:30px;
    height:420px;
    width:100%;
    object-fit:cover;
}

.service-card{
    border-radius:30px;
    padding:30px;
    height:100%;
    border:1px solid rgba(255,255,255,.7);
box-shadow:0 18px 38px rgba(23,32,51,.10);
    transition:.25s;

    position:relative;

    overflow:hidden;

    box-shadow:0 14px 35px rgba(23,32,51,.08);
}

.service-card:nth-child(1){
    background:linear-gradient(180deg,#fff7ed,#ffffff);
}

.service-card:nth-child(2){
    background:linear-gradient(180deg,#eff6ff,#ffffff);
}

.service-card:nth-child(3){
    background:linear-gradient(180deg,#fdf4ff,#ffffff);
}

.service-card:nth-child(4){
    background:linear-gradient(180deg,#ecfeff,#ffffff);
}

.service-card:nth-child(5){
    background:linear-gradient(180deg,#f0fdf4,#ffffff);
}

.service-card:nth-child(6){
    background:linear-gradient(180deg,#fef2f2,#ffffff);
}
.service-card:hover{
    transform:translateY(-8px) scale(1.01);

    box-shadow:
        0 20px 40px rgba(23,32,51,.12);
}
.service-card h4{
    font-weight:900;
    color:#172033;
    margin-bottom:14px;
    font-size:24px;
}

.service-card p{
    color:#64748b;
    line-height:1.8;
    font-size:15px;
}

.age-label{
    color:#0f766e;
    font-weight:850;
    margin-bottom:10px;
}
.row .col-lg-4:nth-child(1) .service-card{
    background:linear-gradient(180deg,#ffe7c2,#fff8ee);
}

.row .col-lg-4:nth-child(2) .service-card{
    background:linear-gradient(180deg,#dbeafe,#f5f9ff);
}

.row .col-lg-4:nth-child(3) .service-card{
    background:linear-gradient(180deg,#f5d9ff,#fdf4ff);
}

.row .col-lg-4:nth-child(4) .service-card{
    background:linear-gradient(180deg,#cffafe,#f0fdff);
}

.row .col-lg-4:nth-child(5) .service-card{
    background:linear-gradient(180deg,#dcfce7,#f4fff7);
}

.row .col-lg-4:nth-child(6) .service-card{
    background:linear-gradient(180deg,#ffe2e2,#fff5f5);
}

.event-card{
    border-radius:28px;
    overflow:hidden;

    height:100%;

    transition:.25s;

    box-shadow:0 18px 38px rgba(23,32,51,.10);

    border:1px solid rgba(255,255,255,.7);
}
.row .col-lg-4:nth-child(1) .event-card{
    background:linear-gradient(180deg,#ffe7c2,#fff8ee);
}

.row .col-lg-4:nth-child(2) .event-card{
    background:linear-gradient(180deg,#dbeafe,#f5f9ff);
}

.row .col-lg-4:nth-child(3) .event-card{
    background:linear-gradient(180deg,#f5d9ff,#fdf4ff);
}

.row .col-lg-4:nth-child(4) .event-card{
    background:linear-gradient(180deg,#cffafe,#f0fdff);
}

.row .col-lg-4:nth-child(5) .event-card{
    background:linear-gradient(180deg,#dcfce7,#f4fff7);
}

.row .col-lg-4:nth-child(6) .event-card{
    background:linear-gradient(180deg,#ffe2e2,#fff5f5);
}

.event-card:hover{
    transform:translateY(-8px) scale(1.01);

    box-shadow:
        0 24px 45px rgba(23,32,51,.14);
}

.event-card img{
    width:100%;
    height:235px;
    object-fit:cover;
}

.event-body{
    padding:24px;
}

.event-date{
    color:#0f766e;
    font-weight:850;
    margin-bottom:10px;
}

.event-body h4{
    font-weight:850;
    color:#172033;
    margin-bottom:12px;
}

.event-body p{
    color:#64748b;
    line-height:1.7;
}

.cta{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    border-radius:34px;
    padding:50px;
}

.footer{
    background:#172033;
    color:white;
    padding:35px 0;
}
.modal-bg{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
    padding:20px;
}

.modal-box{
    background:white;
    width:100%;
    max-width:720px;
    border-radius:28px;
    padding:35px;
    position:relative;
    box-shadow:0 25px 70px rgba(0,0,0,.25);
    max-height:85vh;
    overflow-y:auto;
}

.modal-box h3{
    font-weight:900;
    color:#172033;
    margin-bottom:15px;
}

.modal-box p{
    color:#475569;
    line-height:1.8;
}

.modal-close{
    position:absolute;
    right:22px;
    top:18px;
    border:none;
    background:#f1f5f9;
    width:38px;
    height:38px;
    border-radius:50%;
    font-size:22px;
    font-weight:900;
    color:#172033;
    cursor:pointer;
}

.modal-info{
    color:#0f766e;
    font-weight:850;
    margin-bottom:10px;
}




.about-content{
    position:relative;
    z-index:2;
}

.quote-card{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    border-radius:24px;
    padding:24px;
    margin-top:28px;
    box-shadow:0 12px 30px rgba(23,32,51,.12);
}

.quote-card p{
    color:#f8fafc;
    line-height:1.8;
    margin:0;
}




.quote-user strong{
    display:block;
}

.quote-user span{
    color:#cbd5e1;
    font-size:14px;
}

.about-section{
    position:relative;
}

.about-badge{
    display:inline-block;

    background:#fff1f2;

    color:#be185d;

    padding:9px 16px;

    border-radius:999px;

    font-weight:850;

    font-size:13px;

    box-shadow:0 6px 18px rgba(244,114,182,.12);
}

.about-values{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-top:24px;
}

.about-values div{
    background:#f8fafc;
    border-radius:18px;
    padding:16px;
}

.about-values strong{
    display:block;
    color:#172033;
    font-weight:900;
    margin-bottom:5px;
}

.about-values span{
    color:#64748b;
    font-size:14px;
}

.quote-card{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    border-radius:22px;
    padding:22px;
    margin-top:24px;
}

.quote-card p{
    color:white;
    margin:0;
    line-height:1.7;
}



@keyframes scrollGallery{
    from{
        transform:translateX(0);
    }
    to{
        transform:translateX(-50%);
    }
}
.about-panel-img{
    height:100%;
    min-height:430px;
}

.about-badge{
    display:inline-block;
    background:#fff4df;
    color:#b45309;
    padding:8px 16px;
    border-radius:999px;
    font-size:13px;
    font-weight:850;
}

.about-text{
    color:#475569;
    line-height:2;
    margin-top:18px;
    font-size:17px;
}

.about-side{
    background:linear-gradient(180deg,#fff7ed 0%, #fff1f2 100%);
    border-radius:32px;
    padding:24px;

    box-shadow:0 14px 35px rgba(244,114,182,.10);

    display:flex;
    flex-direction:column;
    gap:14px;

    border:2px solid rgba(255,255,255,.55);
    position:relative;
min-height:760px;
}

.side-card{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
}

.side-card strong{
    display:block;
    color:#172033;
    font-weight:900;
    margin-bottom:5px;
}

.side-card span{
    color:#64748b;
    font-size:14px;
    line-height:1.5;
}

.side-quote{
    margin-top:auto;
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    border-radius:20px;
    padding:20px;
    line-height:1.7;
    font-weight:650;
}
.side-title{
    font-weight:900;
    color:#172033;
    margin-bottom:18px;
}

.volunteer-comment{
    background:rgba(255,255,255,.72);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:16px;

    margin-bottom:14px;

    border:1px solid rgba(255,255,255,.6);

    transition:.25s;
}
.volunteer-comment:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 28px rgba(244,114,182,.14);
}
.side-title{
    font-weight:900;
    color:#be185d;
    margin-bottom:18px;
}

.volunteer-comment p{
    color:#475569;
    line-height:1.6;
    margin-bottom:10px;
    font-size:14px;
}

.volunteer-comment strong{
    display:block;
    color:#172033;
    font-weight:900;
}

.volunteer-comment span{
    color:#64748b;
    font-size:13px;
}



.support-card:hover{
    transform:translateY(-5px);
}

.support-card h4{
    font-weight:850;
    color:#172033;
}

.support-card p{
    color:#64748b;
    line-height:1.7;
    margin-top:10px;
}
.support-wave-section{
    padding:70px 0;
    background:linear-gradient(180deg,#f7f1e8 0%,#fff7ed 100%);
}

.support-wave{
    background:
        radial-gradient(circle at top left,rgba(246,183,60,.20),transparent 35%),
        radial-gradient(circle at bottom right,rgba(15,118,110,.18),transparent 35%),
        #ffffff;
    border-radius:42px;
    padding:55px;
    box-shadow:0 18px 45px rgba(23,32,51,.08);
}

.support-left{
    max-width:850px;
    margin-bottom:45px;
}

.support-mini-title{
    display:inline-block;
    color:#0f766e;
    font-weight:900;
    letter-spacing:.5px;
    margin-bottom:12px;
}

.support-left h2{
    font-size:44px;
    font-weight:900;
    color:#172033;
    max-width:760px;
}

.support-left p{
    color:#64748b;
    line-height:1.9;
    font-size:17px;
    max-width:780px;
    margin-top:18px;
}

.support-flow{
    display:flex;
    align-items:flex-start;
    gap:18px;
}

.flow-item{
    flex:1;
}

.flow-item span{
    display:inline-flex;
    width:42px;
    height:42px;
    border-radius:50%;
    background:#172033;
    color:white;
    align-items:center;
    justify-content:center;
    font-weight:900;
    margin-bottom:15px;
}

.flow-item strong{
    display:block;
    color:#172033;
    font-size:20px;
    font-weight:900;
    margin-bottom:8px;
}

.flow-item p{
    color:#64748b;
    line-height:1.6;
    margin:0;
}

.flow-line{
    width:70px;
    height:2px;
    background:#f6b73c;
    margin-top:21px;
    opacity:.9;
}

@media(max-width:992px){
    .support-flow{
        flex-direction:column;
    }

    .flow-line{
        width:2px;
        height:35px;
        margin-left:20px;
    }

    .support-left h2{
        font-size:34px;
    }

    .support-wave{
        padding:35px;
    }
}
.nav-dropdown{
    position:relative;
}

.dropdown-menu-custom{
    position:absolute;
    top:100%;
    left:0;
    min-width:230px;
    background:white;
    border-radius:0 0 18px 18px;
    box-shadow:0 16px 35px rgba(23,32,51,.16);
    padding:12px;
    display:none;
    z-index:999;
}

.dropdown-menu-custom a{
    display:block;
    color:#172033;
    text-decoration:none;
    padding:13px 15px;
    border-radius:12px;
    font-weight:700;
}

.dropdown-menu-custom a:hover{
    background:#f7f1e8;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:block;
}
.nav-dropdown {
    position: relative;
}

.dropdown-menu-custom {
    position: absolute;
    top: 45px;
    left: 0;
    background: white;
    min-width: 230px;
    border-radius: 16px;
    padding: 12px;
    display: none;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    z-index: 999;
}

.dropdown-menu-custom a {
    color: #1e293b !important;
    text-decoration: none;
    padding: 12px;
    border-radius: 10px;
    font-weight: 500;
    display: block;
}

.dropdown-menu-custom a:hover {
    background: #eef8f6;
    color: #20b2aa !important;
}

.nav-dropdown:hover .dropdown-menu-custom {
    display: flex;
}
.member-card{
    background:white;
    border-radius:18px;
    padding:18px;
    text-align:center;
    font-weight:800;
    color:#172033;
    box-shadow:0 10px 25px rgba(23,32,51,.08);
}
.footer{
    background:#172033;
    color:white;
    padding:35px 0;
    width:100%;
    margin:0;
}
.about-btn{
    display:inline-flex;
    align-items:center;
    gap:18px;

    background:linear-gradient(135deg,#ff4f8b,#ff2f74);
    color:white;
    text-decoration:none;

    padding:10px 28px 10px 10px;

    border-radius:999px;

    font-weight:900;
    font-size:20px;

    box-shadow:0 12px 25px rgba(255,79,139,.28);

    transition:.25s;
}
.about-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    gap:14px;

    background:linear-gradient(135deg,#ff4f8b,#ff2f74);
    color:white;
    text-decoration:none;

    padding:8px 22px 8px 8px;

    border-radius:999px;

    font-weight:800;
    font-size:16px;

    box-shadow:0 10px 22px rgba(255,79,139,.22);

    transition:.25s;
    align-items:center;
}

.about-btn:hover{
    transform:translateY(-2px);
    color:white;
}

.about-icon{
    width:42px;
    height:42px;
    background:white;
    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#ff2f74;
    font-size:24px;
    font-weight:900;
}

.about-text{
    color:#64748b;
    line-height:1.9;
    margin-top:16px;
}
.about-btn-text{
    display:flex;
    align-items:center;
    line-height:1;
    padding-top:1px;
}

.hero{
    background:
      linear-gradient(120deg,rgba(23,32,51,.70),rgba(15,118,110,.60)),
      url("https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop") !important;

    background-size:cover !important;
    background-position:center !important;
    min-height:100vh;
    display:flex;
    align-items:center;
    color:white;
}


.comment-group{
    display:none;
}

.comment-group.active-comment{
    display:block;
}
.comment-next{
    position:absolute;

    right:28px;
    bottom:28px;

    width:48px;
    height:48px;

    border:none;
    border-radius:50%;

    background:#be185d;
    color:white;

    font-size:24px;
    font-weight:900;

    display:flex;
    align-items:center;
    justify-content:center;

    cursor:pointer;

    box-shadow:0 10px 22px rgba(190,24,93,.28);

    z-index:5;
}
.comment-next:hover{
    transform:scale(1.08);
    background:#9d174d;
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

<section class="hero">

    <div class="container">

        <div class="row">

            <div class="col-lg-8">

               

                    <h1>
                        Çocukların geleceğine
                        umutla dokunuyoruz.
                    </h1>

                    <p>
                        Renkli Düşler Çocuk Derneği olarak çocukların eğitim,
                        sosyal gelişim ve kültürel etkinliklere erişimini
                        destekleyen çalışmalar yürütüyoruz.
                    </p>

                  
                 

                </div>

            </div>

           

        </div>

    </div>

</section>

<section class="container py-5" id="hakkimizda">

    <div class="row g-4 align-items-stretch">

        <div class="col-lg-4">

            <img class="about-img about-panel-img"
                 src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?q=80&w=1200&auto=format&fit=crop">

        </div>

        <div class="col-lg-5">

            <div class="about-box h-100">

                <span class="about-badge">
                    Renkli Düşler Çocuk Derneği
                </span>

                <h2 class="section-title mt-3">
                    Dernek Hakkında
                </h2>

                <p class="about-text">
                    Renkli Düşler Çocuk Derneği; çocukların eğitim, sosyal gelişim,
                    kültür-sanat ve gönüllülük çalışmalarına daha kolay ulaşabilmesi
                    için faaliyetler yürüten bir sosyal sorumluluk oluşumudur.
                </p>

                <p class="about-text">
                    Derneğimiz, çocukların kendilerini güvenli bir ortamda ifade edebilmelerini,
                    yeni beceriler kazanmalarını ve sosyal hayata daha aktif katılmalarını destekler.
                </p>

                <p class="about-text">
                    Eğitim destekleri, sanat atölyeleri, tiyatro çalışmaları, çevre farkındalığı
                    etkinlikleri ve gönüllü katılım programlarıyla çocukların gelişimine katkı sağlamayı hedefleriz.
                </p>
<a href="dernek-hakkinda.php" class="about-btn">
    <span class="about-icon">»</span>

    <span class="about-btn-text">
        Hakkımızda
    </span>
</a>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="about-side h-100">

                <h4 class="side-title">
                    Gönüllüler Ne Diyor?
                </h4>

         <div class="volunteer-slider">

    <?php
    $yorumListesi = [];

    while($y = mysqli_fetch_assoc($gonullu_yorumlari)) {
        $yorumListesi[] = $y;
    }

    $yorumGruplari = array_chunk($yorumListesi, 3);
    ?>

    <?php foreach($yorumGruplari as $index => $grup) { ?>

        <div class="comment-group <?php echo $index == 0 ? 'active-comment' : ''; ?>">

            <?php foreach($grup as $y) { ?>

                <div class="volunteer-comment">

                    <p>
                        “<?php echo $y["yorum"]; ?>”
                    </p>

                    <strong>
                        <?php echo $y["adsoyad"]; ?>
                    </strong>

                    <span>
                        <?php echo $y["unvan"]; ?>
                    </span>

                </div>

            <?php } ?>

        </div>

    <?php } ?>

    <button class="comment-next" onclick="changeComments()">
        »
    </button>

</div>

   

</div>

    </div>

   

</div>
            </div>

        </div>

    </div>

</section>


<section class="container py-5">
    <div class="text-center mb-5">
        <h2 class="section-title">Faaliyet Alanlarımız</h2>
        <p class="section-desc">
            Derneğimizin çocukların gelişimini desteklemek için yürüttüğü temel çalışma alanları.
        </p>
    </div>

    <div class="row g-4">

        <?php if (mysqli_num_rows($faaliyetler) > 0) { ?>

            <?php while ($f = mysqli_fetch_assoc($faaliyetler)) { ?>

                <div class="col-lg-4 col-md-6">
                 
<div class="service-card" onclick="openModal(
    '<?php echo addslashes($f["baslik"]); ?>',
    'Yaş Grubu: <?php echo addslashes($f["yas_grubu"]); ?>',
    '<?php echo addslashes($f["aciklama"]); ?>'
)">
                        <h4><?php echo $f["baslik"]; ?></h4>

                        <?php if (!empty($f["yas_grubu"])) { ?>
                            <p class="age-label">
                                Yaş Grubu: <?php echo $f["yas_grubu"]; ?>
                            </p>
                        <?php } ?>

                        <p>
                            <?php echo mb_substr($f["aciklama"], 0, 150, "UTF-8"); ?>...
                        </p>

                    </div>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">
                <div class="alert alert-warning">
                    Henüz faaliyet alanı eklenmedi. 
                </div>
            </div>

        <?php } ?>

    </div>

</section>

<section class="container py-5">

    <div class="text-center mb-5">
        <h2 class="section-title">Son Etkinlikler</h2>
        <p class="section-desc">
          
        </p>
    </div>

    <div class="row g-4">

        <?php if (mysqli_num_rows($etkinlikler) > 0) { ?>

            <?php while ($e = mysqli_fetch_assoc($etkinlikler)) { ?>

                <div class="col-lg-4 col-md-6">
                <div class="event-card" onclick="openModal(
    '<?php echo addslashes($e["baslik"]); ?>',
    'Tarih: <?php echo addslashes($e["tarih"]); ?> | Saat: <?php echo substr($e["saat"], 0, 5); ?> | Yaş Grubu: <?php echo addslashes($e["yas_araligi"]); ?>',
    '<?php echo addslashes($e["aciklama"]); ?>'
)">

                        <?php if (!empty($e["resim"])) { ?>
                            <img src="uploads/<?php echo $e["resim"]; ?>">
                        <?php } else { ?>
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop">
                        <?php } ?>

                        <div class="event-body">

                            <p class="event-date">
                                <?php echo $e["tarih"]; ?>
                            </p>
                            <?php if (!empty($e["saat"])) { ?>
    <br>
    Saat: <?php echo substr($e["saat"], 0, 5); ?>
<?php } ?>

                            <?php if (!empty($e["yas_araligi"])) { ?>
                                <p class="event-date">
                                    Yaş Grubu: <?php echo $e["yas_araligi"]; ?>
                                </p>
                            <?php } ?>

                            <h4><?php echo $e["baslik"]; ?></h4>

                            <p>
                                <?php echo mb_substr($e["aciklama"], 0, 120, "UTF-8"); ?>...
                            </p>

                        </div>

                    </div>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">
                <div class="alert alert-warning">
                    Henüz etkinlik eklenmedi. Admin panelinden etkinlik ekleyebilirsin.
                </div>
            </div>

        <?php } ?>

    </div>

    <div class="text-center mt-4">
        <a href="etkinlikler.php" class="btn-main">Tüm Etkinlikleri Gör</a>
    </div>

</section>

<section class="support-wave-section">

    <div class="container">

        <div class="support-wave">

            <div class="support-left">
                <span class="support-mini-title">Dayanışma Alanı</span>

                <h2>
                    Küçük bir destek, bir çocuğun gününü değiştirebilir.
                </h2>

                <p>
                    Renkli Düşler’de destek yalnızca bağış yapmak değildir; bir kitap,
                    bir oyuncak, bir kırtasiye ürünü ya da gönüllü olarak ayırılan zaman
                    çocukların gelişim yolculuğunda değerli bir katkıya dönüşür.
                </p>
            </div>

            <div class="support-flow">

                <div class="flow-item">
                    <span>01</span>
                    <strong>Kitap</strong>
                    <p>Okuma alışkanlığı ve hayal gücünü destekler.</p>
                </div>

                <div class="flow-line"></div>

                <div class="flow-item">
                    <span>02</span>
                    <strong>Oyuncak</strong>
                    <p>Oyun yoluyla sosyal ve duygusal gelişime katkı sağlar.</p>
                </div>

                <div class="flow-line"></div>

                <div class="flow-item">
                    <span>03</span>
                    <strong>Kırtasiye</strong>
                    <p>Eğitim sürecinde ihtiyaç duyulan temel materyalleri sağlar.</p>
                </div>

                <div class="flow-line"></div>

                <div class="flow-item">
                    <span>04</span>
                    <strong>Gönüllülük</strong>
                    <p>Etkinliklerde çocuklarla doğrudan temas kurmayı mümkün kılar.</p>
                </div>

            </div>

        </div>

    </div>

</section>

<section class="container py-5">

    <div class="cta text-center">

        <h2 class="fw-bold">
            Sen de çocukların hayatına dokunabilirsin.
        </h2>

        <p class="mt-3">
            Gönüllü olarak etkinliklerimize destek verebilir veya dernek çalışmalarımız hakkında bilgi alabilirsin.
        </p>

        <div class="mt-4">
            <a href="gonullu.php" class="btn-main">Gönüllü Başvurusu Yap</a>
    
        </div>

    </div>

</section>

<footer class="footer">
    <div class="container text-center">
        <p class="mb-0">
            © 2026 Renkli Düşler Çocuk Derneği. Tüm hakları saklıdır.
        </p>
    </div>
</footer>

<div class="modal-bg" id="customModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()">×</button>

        <h3 id="modalTitle"></h3>

        <div class="modal-info" id="modalInfo"></div>

        <p id="modalText"></p>
    </div>
</div>

<script>
function openModal(title, info, text){
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalInfo").innerText = info;
    document.getElementById("modalText").innerText = text;
    document.getElementById("customModal").style.display = "flex";
}

function closeModal(){
    document.getElementById("customModal").style.display = "none";
}

document.getElementById("customModal").addEventListener("click", function(e){
    if(e.target.id === "customModal"){
        closeModal();
    }
});

let commentIndex = 0;

function changeComments(){
    const groups = document.querySelectorAll(".comment-group");

    if(groups.length === 0){
        return;
    }

    groups[commentIndex].classList.remove("active-comment");

    commentIndex++;

    if(commentIndex >= groups.length){
        commentIndex = 0;
    }

    groups[commentIndex].classList.add("active-comment");
}
</script>



</body>
</html>