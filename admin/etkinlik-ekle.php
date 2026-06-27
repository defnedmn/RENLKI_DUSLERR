<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["ekle"])) {
    $baslik = $_POST["baslik"];
    $kategori = $_POST["kategori"];
    $yas_araligi = $_POST["yas_araligi"];
    $tarih = $_POST["tarih"];
    $saat = $_POST["saat"];
    $konum = $_POST["konum"];
    $aciklama = $_POST["aciklama"];

    $resim_adi = "";

    if (!empty($_FILES["resim"]["name"])) {
        $resim_adi = time() . "_" . $_FILES["resim"]["name"];
        $hedef = "../uploads/" . $resim_adi;
        move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef);
    }

    $ekle = mysqli_query($baglanti, "INSERT INTO etkinlikler 
    (baslik, kategori, yas_araligi, tarih, saat, konum, aciklama, resim) 
    VALUES 
    ('$baslik', '$kategori', '$yas_araligi', '$tarih', '$saat', '$konum', '$aciklama', '$resim_adi')");

   if ($ekle) {

    $etkinlik_id = mysqli_insert_id($baglanti);

    if(isset($_POST["gonulluler"])){

        $gonulluler = array_slice($_POST["gonulluler"], 0, 3);

        foreach($gonulluler as $gonullu_id){

            mysqli_query($baglanti, "
            INSERT INTO etkinlik_gonulluleri
            (etkinlik_id, gonullu_id, gorev)
            VALUES
            ('$etkinlik_id', '$gonullu_id', 'Etkinlik Gönüllüsü')
            ");
        }
    }

    $basari = "Etkinlik başarıyla eklendi.";
} else {
        $hata = "Etkinlik eklenirken hata oluştu: " . mysqli_error($baglanti);
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Etkinlik Ekle | Renkli Düşler</title>

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

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
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

.form-card{
    background:white;
    border-radius:26px;
    padding:30px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.form-card h3{
    font-weight:900;
    color:#172033;
    margin-bottom:22px;
}

label{
    font-weight:750;
    color:#334155;
    margin-bottom:7px;
}

.form-control,
.form-select{
    border-radius:15px;
    padding:13px 15px;
    border:1px solid #dbe3ef;
}

.submit-btn{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px;
    border-radius:15px;
    font-weight:850;
    width:100%;
}

.info-card{
    background:white;
    border-radius:28px;
    padding:28px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);

    align-self:start;
    height:auto;
}
.volunteer-select-list{
    display:flex;
    flex-direction:column;
    gap:12px;
    margin-top:12px;
}

.volunteer-option{
    display:flex;
    align-items:center;
    gap:12px;
    background:#f8fafc;
    border-radius:14px;
    padding:14px;
    cursor:pointer;
    border:1px solid #e2e8f0;
    transition:.2s;
}

.volunteer-option:hover{
    background:#eef6ff;
}

.volunteer-option input{
    width:18px;
    height:18px;
}

.volunteer-option span{
    font-weight:700;
    color:#172033;
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
            <h1>Yeni Etkinlik Ekle</h1>
            <p>Etkinliğin kategori, yaş aralığı, tarih, konum ve görsel bilgilerini ekleyebilirsin.</p>
        </div>

        <a href="etkinlik-liste.php" class="btn-main">Etkinlikleri Gör</a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="form-card">

                <h3>Etkinlik Bilgileri</h3>

                <?php if (isset($basari)) { ?>
                    <div class="alert alert-success"><?php echo $basari; ?></div>
                <?php } ?>

                <?php if (isset($hata)) { ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php } ?>

                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label>Etkinlik Başlığı</label>
                        <input type="text" name="baslik" class="form-control" placeholder="Örn: Masal ve Boyama Atölyesi" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">Kategori seçiniz</option>
                                <option value="Eğitim">Eğitim</option>
                                <option value="Sanat">Sanat</option>
                                <option value="Sosyal Destek">Sosyal Destek</option>
                                <option value="Spor">Spor</option>
                                <option value="Kültür">Kültür</option>
                                <option value="Bağış">Bağış</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Yaş Aralığı</label>
                            <select name="yas_araligi" class="form-select" required>
                                <option value="">Yaş aralığı seçiniz</option>
                                <option value="4-6 yaş">4-6 yaş</option>
                                <option value="7-9 yaş">7-9 yaş</option>
                                <option value="10-12 yaş">10-12 yaş</option>
                                <option value="13-15 yaş">13-15 yaş</option>
                                <option value="Tüm yaş grupları">Tüm yaş grupları</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Etkinlik Tarihi</label>
                        <input type="date" name="tarih" class="form-control" required>
                    </div>
                    <div class="mb-3">
    <label class="fw-bold">Etkinlik Saati</label>
    <input type="time" name="saat" class="form-control">
</div>

                    <div class="mb-3">
                        <label>Etkinlik Konumu</label>
                        <input type="text" name="konum" class="form-control" placeholder="Örn: Yalova Çocuk Kültür Merkezi" required>
                    </div>

                    <div class="mb-3">
                        <label>Etkinlik Açıklaması</label>
                        <textarea name="aciklama" class="form-control" rows="7" placeholder="Etkinliğin amacı, hedef kitlesi ve içeriği..." required></textarea>
                    </div>
                 <div class="mb-4">

    <label class="fw-bold mb-3">
        Etkinlik Gönüllüleri
    </label>

    <div class="volunteer-select-list">

        <?php
        $tum_gonulluler = mysqli_query($baglanti, "SELECT * FROM gonulluler ORDER BY adsoyad ASC");

        while($g = mysqli_fetch_assoc($tum_gonulluler)) {
        ?>

            <label class="volunteer-option">

                <input type="checkbox"
                       name="gonulluler[]"
                       value="<?php echo $g["id"]; ?>">

                <span>
                    <?php echo $g["adsoyad"]; ?>
                </span>

            </label>

        <?php } ?>

    </div>

    <small class="text-muted">
        En fazla 3 gönüllü seçebilirsin.
    </small>

</div>
                    <div class="mb-4">
                        <label>Etkinlik Görseli</label>
                        <input type="file" name="resim" class="form-control">
                    </div>

                    <button type="submit" name="ekle" class="submit-btn">
                        Etkinliği Kaydet
                    </button>

                </form>

            </div>
        </div>

        <div class="col-lg-4">
       <div class="info-card">

    <div class="info-icon">
        🌈
    </div>

    <h4>
        Çocuklara Dokunan Etkinlikler Oluşturun
    </h4>

    <p>
        Eklediğiniz her etkinlik; çocukların sosyal gelişimine, özgüven kazanmasına ve yeni deneyimler edinmesine katkı sağlar.
        Açıklama kısmında etkinliğin amacı, çocukların neler kazanacağı ve etkinlik süreci hakkında kısa bilgiler vermeniz önerilir.
    </p>

    <div class="info-highlight">
        Güçlü bir etkinlik açıklaması daha fazla gönüllünün ilgisini çeker.
    </div>

</div>
    </div>

</main>

</body>
</html>