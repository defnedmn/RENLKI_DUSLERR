<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Etkinlik Yönetimi</title>

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

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:#3b4a66;
    border-radius:10px;
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
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(300px, 360px));
    gap:24px;
    align-items:start;
}
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}

.topbar h1{
    font-weight:900;
    color:#172033;
    margin:0;
}

.topbar p{
    color:#64748b;
    margin:5px 0 0;
}

.btn-main{
    background:#f6b73c;
    color:#172033;
    padding:12px 18px;
    border-radius:14px;
    text-decoration:none;
    font-weight:850;
}

.event-card{
    background:white;
    border-radius:26px;
    overflow:hidden;
    height:fit-content;
}

.event-card:hover{
    transform:translateY(-6px);
}

.event-card img{
    width:100%;
    height:230px;
    object-fit:cover;
}

.event-body{
    padding:24px;
}

.badge-cat{
    display:inline-block;
    background:#fff4df;
    color:#b45309;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:850;
    margin-bottom:15px;
}

.event-body h4{
    font-weight:900;
    color:#172033;
    margin-bottom:12px;
}

.event-meta{
    color:#64748b;
    font-size:14px;
    margin-bottom:12px;
}

.event-text{
    color:#475569;
    line-height:1.6;
    min-height:85px;
}

.actions{
    display:flex;
    gap:10px;
    margin-top:18px;
}

.btn-edit{
    flex:1;
    background:#0f766e;
    color:white;
    padding:12px;
    border-radius:14px;
    text-align:center;
    text-decoration:none;
    font-weight:850;
}

.btn-delete{
    flex:1;
    background:#ef476f;
    color:white;
    padding:12px;
    border-radius:14px;
    text-align:center;
    text-decoration:none;
    font-weight:850;
}

.empty{
    background:white;
    border-radius:26px;
    padding:40px;
    text-align:center;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}




.event-team{
    margin-top:18px;
    padding-top:16px;
    border-top:1px solid #edf2f7;
}

.team-title{
    font-size:14px;
    font-weight:900;
    color:#172033;
    margin-bottom:12px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:24px;
}

.event-card{
    background:white;
    border-radius:26px;
    overflow:hidden;
    height:fit-content;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.event-team{
    margin-top:18px;
    background:#f8fafc;
    border-radius:18px;
    padding:14px;
    border:1px solid #e2e8f0;
}

.team-title{
    font-size:13px;
    font-weight:900;
    color:#172033;
    margin-bottom:12px;
}

.team-chip{
    display:flex;
    align-items:center;
    gap:10px;
    background:white;
    border-radius:12px;
    padding:8px 10px;
    margin-bottom:8px;
}

.team-chip:last-child{
    margin-bottom:0;
}

.team-chip span{
    width:30px;
    height:30px;
    border-radius:50%;
    background:#0f766e;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:900;
}

.team-chip strong{
    display:block;
    color:#172033;
    font-size:13px;
}

.team-chip small{
    color:#64748b;
    font-size:12px;
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
            <h1>Etkinlik Yönetimi</h1>
            <p>Etkinlikleri görüntüleyebilir, güncelleyebilir veya silebilirsin.</p>
        </div>

        <a href="etkinlik-ekle.php" class="btn-main">
            Yeni Etkinlik Ekle
        </a>
    </div>

    <?php if (mysqli_num_rows($etkinlikler) > 0) { ?>
    <div class="cards">

       
<?php while ($e = mysqli_fetch_assoc($etkinlikler)) { ?>

    <div class="event-card">

       <?php if (!empty($e["resim"])) { ?>

    <img src="../uploads/<?php echo $e["resim"]; ?>">

<?php } ?>

        <div class="event-body">

            <div class="badge-cat">
                <?php echo $e["kategori"]; ?>
            </div>

            <h4><?php echo $e["baslik"]; ?></h4>

            <div class="event-meta">
                📅 <?php echo $e["tarih"]; ?><br>
                📍 <?php echo $e["konum"]; ?>
            </div>

            <div class="event-text">
                <?php echo mb_substr($e["aciklama"], 0, 110, "UTF-8"); ?>...
            </div>

            <div class="actions">
                <a class="btn-edit"
                   href="etkinlik-guncelle.php?id=<?php echo $e["id"]; ?>">
                    Güncelle
                </a>

                <a class="btn-delete"
                   href="etkinlik-sil.php?id=<?php echo $e["id"]; ?>"
                   onclick="return confirm('Bu etkinliği silmek istediğine emin misin?');">
                    Sil
                </a>
            </div>

            <?php
            $atananlar = mysqli_query($baglanti, "
                SELECT gonulluler.adsoyad, etkinlik_gonulluleri.gorev
                FROM etkinlik_gonulluleri
                INNER JOIN gonulluler
                ON etkinlik_gonulluleri.gonullu_id = gonulluler.id
                WHERE etkinlik_gonulluleri.etkinlik_id = ".$e["id"]."
            ");
            ?>

            <?php if($atananlar && mysqli_num_rows($atananlar) > 0) { ?>

                <div class="event-team">
                    <div class="team-title">Gönüllü Ekibi</div>

                    <?php while($a = mysqli_fetch_assoc($atananlar)) { ?>

                        <div class="team-chip">
                            <span><?php echo strtoupper(substr($a["adsoyad"],0,1)); ?></span>

                            <div>
                                <strong><?php echo $a["adsoyad"]; ?></strong>
                                <small><?php echo $a["gorev"]; ?></small>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            <?php } ?>

        </div>

    </div>

<?php } ?>

</div>

<?php } else { ?>

        <div class="empty">
            <h3>Henüz etkinlik eklenmedi.</h3>
            <p>İlk etkinliği ekleyerek etkinlik yönetim alanını doldurabilirsin.</p>
        </div>

    <?php } ?>

</main>

</body>
</html>