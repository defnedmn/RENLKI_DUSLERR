<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: faaliyet-liste.php");
    exit;
}

$id = $_GET["id"];

$sorgu = mysqli_query($baglanti, "SELECT * FROM faaliyetler WHERE id='$id'");
$faaliyet = mysqli_fetch_assoc($sorgu);

if (!$faaliyet) {
    header("Location: faaliyet-liste.php");
    exit;
}

if (isset($_POST["guncelle"])) {
  $baslik = $_POST["baslik"];
$yas_grubu = $_POST["yas_grubu"];
$aciklama = $_POST["aciklama"];

    $guncelle = mysqli_query($baglanti, "UPDATE faaliyetler SET 
        baslik='$baslik',
        yas_grubu='$yas_grubu',
        aciklama='$aciklama'
        WHERE id='$id'
    ");

    if ($guncelle) {
        header("Location: faaliyet-liste.php");
        exit;
    } else {
        $hata = "Güncelleme sırasında hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Faaliyet Düzenle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f5efe6;
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
    border-radius:30px;
    padding:28px;
    color:white;
}

.logo-box{
    width:60px;
    height:60px;
    border-radius:22px;
    background:linear-gradient(135deg,#f6b73c,#ef476f);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:900;
    margin-bottom:14px;
}

.sidebar h3{
    font-weight:900;
    margin:0;
}

.sidebar p{
    color:#aab4c5;
    font-size:14px;
}

.menu-title{
    color:#7f8da3;
    font-size:12px;
    font-weight:800;
    margin:25px 0 12px;
}

.sidebar a{
    display:block;
    color:#dbe4f0;
    text-decoration:none;
    padding:14px 15px;
    border-radius:16px;
    margin-bottom:8px;
    font-weight:650;
}

.sidebar a:hover,
.sidebar a.active{
    background:#24314a;
}

.content{
    margin-left:325px;
    padding:35px;
}

.top-area{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.top-area h1{
    font-weight:900;
    color:#172033;
    margin:0;
    font-size:42px;
}

.top-area p{
    color:#64748b;
    margin-top:7px;
}

.back-btn{
    background:#172033;
    color:white;
    text-decoration:none;
    padding:14px 20px;
    border-radius:16px;
    font-weight:800;
}

.form-box{
    background:white;
    border-radius:34px;
    padding:40px;
    box-shadow:0 18px 40px rgba(23,32,51,.08);
}

.form-box h3{
    font-weight:900;
    color:#172033;
    margin-bottom:30px;
}

.form-label{
    font-weight:800;
    margin-bottom:10px;
    color:#172033;
}

.form-control{
    border-radius:18px;
    padding:16px;
    border:1px solid #dbe3ef;
    background:#f8fafc;
}

.form-control:focus{
    box-shadow:none;
    border-color:#0f766e;
}

textarea.form-control{
    min-height:230px;
    resize:none;
}

.submit-btn{
    background:#0f766e;
    color:white;
    border:none;
    width:100%;
    padding:18px;
    border-radius:18px;
    font-weight:900;
    font-size:17px;
}

.submit-btn:hover{
    background:#115e59;
}

.alert{
    border-radius:18px;
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

    <div class="top-area">

        <div>
            <h1>Faaliyet Düzenle</h1>
            <p>Mevcut faaliyet başlığı ve açıklamasını buradan güncelleyebilirsin.</p>
        </div>

        <a href="faaliyet-liste.php" class="back-btn">
            Listeye Dön
        </a>

    </div>

    <div class="form-box">

        <h3>Faaliyet Bilgileri</h3>

        <?php if(isset($hata)) { ?>
            <div class="alert alert-danger">
                <?php echo $hata; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-4">
                <label class="form-label">Faaliyet Başlığı</label>
                <div class="mb-4">
    <label class="form-label">Hedef Yaş Grubu</label>

    <select name="yas_grubu" class="form-control" required>
        <option value="4-6 yaş" <?php if($faaliyet["yas_grubu"]=="4-6 yaş") echo "selected"; ?>>4-6 yaş</option>
        <option value="7-9 yaş" <?php if($faaliyet["yas_grubu"]=="7-9 yaş") echo "selected"; ?>>7-9 yaş</option>
        <option value="10-12 yaş" <?php if($faaliyet["yas_grubu"]=="10-12 yaş") echo "selected"; ?>>10-12 yaş</option>
        <option value="13-15 yaş" <?php if($faaliyet["yas_grubu"]=="13-15 yaş") echo "selected"; ?>>13-15 yaş</option>
        <option value="Tüm yaş grupları" <?php if($faaliyet["yas_grubu"]=="Tüm yaş grupları") echo "selected"; ?>>Tüm yaş grupları</option>
    </select>
</div>

                <input type="text"
                       name="baslik"
                       class="form-control"
                       value="<?php echo $faaliyet["baslik"]; ?>"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Faaliyet Açıklaması</label>

                <textarea name="aciklama"
                          class="form-control"
                          required><?php echo $faaliyet["aciklama"]; ?></textarea>
            </div>

            <button type="submit"
                    name="guncelle"
                    class="submit-btn">
                Değişiklikleri Kaydet
            </button>

        </form>

    </div>

</main>

</body>
</html>