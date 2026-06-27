<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
if(isset($_POST["gorev_ata"])){

    $gonullu_id = $_POST["gonullu_id"];
    $etkinlik_id = $_POST["etkinlik_id"];
    $gorev = $_POST["gorev"];

    mysqli_query($baglanti, "INSERT INTO etkinlik_gonulluleri
    (etkinlik_id, gonullu_id, gorev)
    VALUES
    ('$etkinlik_id', '$gonullu_id', '$gorev')");

    header("Location: gonullu-liste.php");
    exit;
}

$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY tarih DESC");
$gonulluler = mysqli_query($baglanti,
"SELECT * FROM gonulluler ORDER BY id DESC");
$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY id DESC");


if(isset($_POST["gorev_ata"])){
    $gonullu_id = $_POST["gonullu_id"];
    $etkinlik_id = $_POST["etkinlik_id"];
    $gorev = $_POST["gorev"];

    mysqli_query($baglanti, "INSERT INTO etkinlik_gonulluleri
    (gonullu_id, etkinlik_id, gorev)
    VALUES
    ('$gonullu_id', '$etkinlik_id', '$gorev')");

    header("Location: gonullu-liste.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Başvuruları</title>

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
}

.content{
    margin-left:320px;
    padding:30px;
}

.topbar{
    margin-bottom:28px;
}

.topbar h1{
    font-weight:900;
    color:#172033;
}

.topbar p{
    color:#64748b;
}

.table-box{
    background:white;
    border-radius:28px;
    padding:28px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.custom-table{
    width:100%;
    border-collapse:collapse;
}

.custom-table th{
    background:#f8fafc;
    padding:16px;
    color:#172033;
    font-weight:850;
}

.custom-table td{
    padding:18px 16px;
    border-top:1px solid #eef2f7;
    vertical-align:middle;
}

.user-badge{
    width:48px;
    height:48px;
    border-radius:50%;
    background:#fff4df;
    color:#b45309;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
}

.tag{
    background:#dcfce7;
    color:#166534;
    padding:7px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:850;
}

.btn-delete{
    background:#ef476f;
    color:white;
    text-decoration:none;
    padding:10px 14px;
    border-radius:12px;
    font-weight:800;
}

.empty{
    background:white;
    border-radius:26px;
    padding:45px;
    text-align:center;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}
.btn-approve{
    background:#0f766e;
    color:white;
    text-decoration:none;
    padding:10px 14px;
    border-radius:12px;
    font-weight:800;
    display:inline-block;
    margin-bottom:8px;
}

.btn-approve:hover{
    color:white;
    background:#115e59;
}

.approved-badge{
    background:#dcfce7;
    color:#166534;
    padding:9px 13px;
    border-radius:999px;
    font-weight:850;
    display:inline-block;
    margin-bottom:8px;
}
.assign-box{
    margin-top:10px;
}

.assign-box summary{
    cursor:pointer;
    background:#f6b73c;
    color:#172033;
    padding:9px 12px;
    border-radius:12px;
    font-weight:850;
    display:inline-block;
}

.assign-form{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:16px;
    padding:14px;
    margin-top:10px;
    min-width:260px;
}

.assign-form label{
    font-weight:800;
    font-size:13px;
    color:#334155;
}

.btn-assign{
    background:#0f766e;
    color:white;
    border:none;
    padding:10px 13px;
    border-radius:12px;
    font-weight:850;
    width:100%;
}
.assigned-event{
    background:#eef8f6;
    border-left:4px solid #0f766e;
    padding:10px 12px;
    border-radius:12px;
    margin-top:10px;
}

.assigned-event strong{
    display:block;
    color:#172033;
}

.assigned-event span{
    font-size:13px;
    color:#475569;
}
.volunteer-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:22px;
}

.volunteer-card{
    background:white;
    border-radius:26px;
    padding:24px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    border-left:5px solid #0f766e;
}

.volunteer-head{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:20px;
}

.volunteer-head h4{
    margin:0;
    font-weight:900;
    color:#172033;
}

.volunteer-head span{
    display:inline-block;
    margin-top:6px;
    background:#dcfce7;
    color:#166534;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:850;
}

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
    margin-bottom:16px;
}

.info-grid div,
.message-box{
    background:#f8fafc;
    border-radius:16px;
    padding:14px;
}

.info-grid b,
.message-box b{
    display:block;
    color:#172033;
    margin-bottom:6px;
}

.info-grid p,
.message-box p{
    color:#64748b;
    margin:0;
    line-height:1.6;
}

.message-box{
    margin-bottom:14px;
}

.card-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:16px;
}

.assign-btn{
    background:#d97706;
    color:white;
    text-decoration:none;
    padding:10px 14px;
    border-radius:12px;
    font-weight:850;
}

.assign-btn:hover,
.btn-delete:hover{
    color:white;
}

@media(max-width:992px){
    .volunteer-grid{
        grid-template-columns:1fr;
    }
}
.assign-btn{
    background:#d97706;
    color:white;
    border:none;
    text-decoration:none;
    padding:10px 14px;
    border-radius:12px;
    font-weight:850;
}

.mail-btn{
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:10px 14px;
    border-radius:12px;
    font-weight:850;
}

.assign-box{
    display:none;
    background:#fff7ed;
    border:1px solid #fed7aa;
    border-radius:18px;
    padding:18px;
    margin-top:18px;
}

.confirm-btn{
    background:#0f766e;
    color:white;
    border:none;
    padding:12px;
    border-radius:14px;
    font-weight:850;
    width:100%;
}

.assigned-box{
    background:#f8fafc;
    border-radius:18px;
    padding:16px;
    margin-top:16px;
}

.assigned-box > b{
    display:block;
    margin-bottom:12px;
}

.assigned-item{
    background:white;
    border-left:4px solid #0f766e;
    border-radius:14px;
    padding:12px;
    margin-bottom:10px;
}

.assigned-item strong{
    display:block;
    color:#172033;
}

.assigned-item span{
    color:#64748b;
    font-size:13px;
}

.assigned-item p{
    margin:6px 0 0;
    color:#475569;
}
.assign-edit-btn{
    display:inline-block;
    margin-top:10px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:8px 12px;
    border-radius:10px;
    font-size:13px;
    font-weight:850;
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
        <h1>Gönüllü Başvuruları</h1>

        <p>
            Site üzerinden yapılan gönüllü başvurularını buradan yönetebilirsin.
        </p>
    </div>

    <?php if(mysqli_num_rows($gonulluler) > 0) { ?>

        <div class="table-box">

            <div class="volunteer-grid">

<?php while($g = mysqli_fetch_assoc($gonulluler)) { ?>

    <div class="volunteer-card">

        <div class="volunteer-head">
            <div class="user-badge">
                <?php echo strtoupper(substr($g["adsoyad"],0,1)); ?>
            </div>

            <div>
                <h4><?php echo $g["adsoyad"]; ?></h4>
                <span><?php echo $g["ilgi_alani"]; ?></span>
            </div>
        </div>

        <div class="info-grid">
            <div>
                <b>E-posta</b>
                <p><?php echo $g["email"]; ?></p>
            </div>

            <div>
                <b>Telefon</b>
                <p><?php echo $g["telefon"]; ?></p>
            </div>

            <div>
                <b>Müsaitlik</b>
                <p><?php echo $g["musaitlik"]; ?></p>
            </div>

            <div>
                <b>Deneyim</b>
                <p><?php echo $g["deneyim"]; ?></p>
            </div>
        </div>

        <div class="message-box">
            <b>Kısa Mesaj</b>
            <p><?php echo $g["mesaj"]; ?></p>
        </div>

        <?php if(!empty($g["deneyim_aciklama"])) { ?>
            <div class="message-box">
                <b>Deneyim Açıklaması</b>
                <p><?php echo $g["deneyim_aciklama"]; ?></p>
            </div>
        <?php } ?>
        <?php
$atananlar = mysqli_query($baglanti, "
    SELECT etkinlik_gonulluleri.id, etkinlikler.baslik, etkinlikler.tarih, etkinlik_gonulluleri.gorev
    FROM etkinlik_gonulluleri
    INNER JOIN etkinlikler
    ON etkinlik_gonulluleri.etkinlik_id = etkinlikler.id
    WHERE etkinlik_gonulluleri.gonullu_id = ".$g["id"]."
");
?>

<?php if(mysqli_num_rows($atananlar) > 0) { ?>

<div class="assigned-box">

    <b>Atandığı Etkinlikler</b>

    <?php while($a = mysqli_fetch_assoc($atananlar)) { ?>

        <div class="assigned-item">

            <strong>
                <?php echo $a["baslik"]; ?>
            </strong>

            <span>
                <?php echo $a["tarih"]; ?>
            </span>

            <p>
                Görev: <?php echo $a["gorev"]; ?>
            </p>
            <a class="assign-edit-btn"
   href="gorev-guncelle.php?id=<?php echo $a["id"]; ?>">

    Güncelle

</a>

        </div>

    <?php } ?>

</div>

<?php } ?>

        <div class="card-actions">
           <button type="button"
        class="assign-btn"
        onclick="toggleAssign('assign-<?php echo $g["id"]; ?>')">
    Görev Ataması Yap
</button>

<a class="mail-btn"
   href="mailto:<?php echo $g["email"]; ?>?subject=Renkli Düşler Gönüllü Görev Bilgilendirmesi&body=Merhaba <?php echo urlencode($g["adsoyad"]); ?>,%0D%0A%0D%0ARenkli Düşler Çocuk Derneği gönüllülük başvurunuz değerlendirilmiştir. Sizi uygun bir etkinlikte gönüllü olarak görevlendirmek istiyoruz.%0D%0A%0D%0ADetaylı bilgi için bizimle iletişime geçebilirsiniz.%0D%0A%0D%0ASevgiler,%0D%0ARenkli Düşler Çocuk Derneği">
    Mail Gönder
</a>
<div class="assign-box" id="assign-<?php echo $g["id"]; ?>">
<form method="POST">
    <input type="hidden" name="gonullu_id" value="<?php echo $g["id"]; ?>">

    <label class="fw-bold mb-2">Etkinlik Seç</label>
    <select name="etkinlik_id" class="form-select mb-3" required>
        <option value="">Etkinlik seçiniz</option>

        <?php
        mysqli_data_seek($etkinlikler, 0);
        while($e = mysqli_fetch_assoc($etkinlikler)) {
        ?>
            <option value="<?php echo $e["id"]; ?>">
                <?php echo $e["baslik"]; ?> - <?php echo $e["tarih"]; ?>
            </option>
        <?php } ?>
    </select>

    <label class="fw-bold mb-2">Görev</label>
    <input type="text" name="gorev" class="form-control mb-3"
           placeholder="Örn: Atölye yardımcısı, kayıt masası, etkinlik desteği" required>

    <button type="submit" name="gorev_ata" class="confirm-btn">
        Onayla
    </button>
</form>

</div>



            <a class="btn-delete"
               href="gonullu-sil.php?id=<?php echo $g["id"]; ?>"
               onclick="return confirm('Başvuruyu silmek istediğine emin misin?');">
                Sil
            </a>
        </div>

    </div>

<?php } ?>

</div>

        </div>

    <?php } else { ?>

        <div class="empty">
            <h3>Henüz gönüllü başvurusu bulunmuyor.</h3>
        </div>

    <?php } ?>
    

</main>
<script>
function toggleAssign(id){
    const box = document.getElementById(id);

    if(box.style.display === "block"){
        box.style.display = "none";
    }else{
        box.style.display = "block";
    }
}
</script>

</body>
</html>