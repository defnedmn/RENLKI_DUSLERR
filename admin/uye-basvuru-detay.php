<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

if (isset($_POST["onayla"])) {
    $dernek_sayin = $_POST["dernek_sayin"];
    $dernek_karar_tarihi = $_POST["dernek_karar_tarihi"];
    $dernek_karar_sayisi = $_POST["dernek_karar_sayisi"];
    $dernek_baskani = $_POST["dernek_baskani"];
    $baskan_imza = $_POST["baskan_imza"];

    mysqli_query($baglanti, "UPDATE uye_basvurulari SET
        durum='onaylandi',
        dernek_sayin='$dernek_sayin',
        dernek_karar_tarihi='$dernek_karar_tarihi',
        dernek_karar_sayisi='$dernek_karar_sayisi',
        dernek_baskani='$dernek_baskani',
        baskan_imza='$baskan_imza'
        WHERE id=$id
    ");

    header("Location: uye-basvurulari.php");
    exit;
}

$sorgu = mysqli_query($baglanti, "SELECT * FROM uye_basvurulari WHERE id=$id");
$b = mysqli_fetch_assoc($sorgu);

$imzalar = json_decode($b["imza"], true);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Üye Başvuru Detayı</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#172033;
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

.sidebar h3{
    font-weight:900;
    margin-bottom:25px;
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
    background:#0f766e;
    color:white;
}

.content{
    margin-left:320px;
    padding:35px;
}

.form-card{
    background:white;
    border-radius:28px;
    padding:30px;
    box-shadow:0 15px 35px rgba(23,32,51,.12);
    margin-bottom:25px;
}

.title{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    padding:24px;
    border-radius:22px;
    margin-bottom:25px;
}

.section-title{
    background:#0f766e;
    color:white;
    padding:12px 18px;
    border-radius:14px;
    font-weight:900;
    margin:25px 0 18px;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:14px;
}

.info-box{
    background:#f8fafc;
    border-radius:16px;
    padding:14px;
    border:1px solid #e2e8f0;
}

.info-box span{
    display:block;
    color:#64748b;
    font-size:13px;
    font-weight:700;
}

.info-box strong{
    color:#172033;
}

.form-control{
    border-radius:14px;
    padding:12px;
}

.signature-img{
    max-width:260px;
    border:1px dashed #94a3b8;
    border-radius:12px;
    padding:8px;
    background:white;
}

.signature-box{
    border:2px dashed #94a3b8;
    border-radius:16px;
    background:white;
    overflow:hidden;
    max-width:380px;
}

.signature-box canvas{
    width:100%;
    height:120px;
    display:block;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px 28px;
    border-radius:14px;
    font-weight:900;
}

.btn-clear{
    background:#e2e8f0;
    color:#172033;
    border:none;
    padding:10px 18px;
    border-radius:12px;
    font-weight:800;
}

.btn-back{
    background:#172033;
    color:white;
    text-decoration:none;
    padding:11px 18px;
    border-radius:13px;
    font-weight:800;
}

.btn-back:hover{
    color:white;
}

.status{
    display:inline-block;
    padding:9px 14px;
    border-radius:999px;
    font-weight:900;
    background:#fff7ed;
    color:#b45309;
}

.status.ok{
    background:#dcfce7;
    color:#166534;
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

    <div class="title">
        <h2 class="mb-2">Üye Başvuru Detayı</h2>

        <?php if($b["durum"] == "onaylandi") { ?>
            <span class="status ok">Onaylandı</span>
        <?php } else { ?>
            <span class="status">Beklemede</span>
        <?php } ?>
    </div>

    <a href="uye-basvurulari.php" class="btn-back">← Başvurulara Dön</a>

    <div class="form-card mt-4">

        <div class="section-title">Üye Bilgileri</div>

        <div class="info-grid">
            <div class="info-box"><span>Ad Soyad</span><strong><?php echo $b["ad"] . " " . $b["soyad"]; ?></strong></div>
            <div class="info-box"><span>T.C. Kimlik No</span><strong><?php echo $b["tc"]; ?></strong></div>
            <div class="info-box"><span>Doğum Tarihi</span><strong><?php echo $b["dogum_tarihi"]; ?></strong></div>
            <div class="info-box"><span>Doğum Yeri</span><strong><?php echo $b["dogum_yeri"]; ?></strong></div>
            <div class="info-box"><span>Anne Adı</span><strong><?php echo $b["anne_adi"]; ?></strong></div>
            
            <div class="info-box"><span>Cinsiyet</span><strong><?php echo $b["cinsiyet"]; ?></strong></div>
            <div class="info-box"><span>Meslek</span><strong><?php echo $b["meslek"]; ?></strong></div>
            <div class="info-box"><span>Mezuniyet</span><strong><?php echo $b["mezuniyet"]; ?></strong></div>
            <div class="info-box"><span>Telefon</span><strong><?php echo $b["telefon"]; ?></strong></div>
            <div class="info-box"><span>E-posta</span><strong><?php echo $b["email"]; ?></strong></div>
            <div class="info-box"><span>Başvuru Tarihi</span><strong><?php echo $b["tarih"]; ?></strong></div>
        </div>

        <div class="info-box mt-3">
            <span>Yerleşim Yeri Adresi</span>
            <strong><?php echo $b["adres"]; ?></strong>
        </div>

        <div class="info-box mt-3">
            <span>Çalıştığı Kurum / Adresi</span>
            <strong><?php echo $b["kurum"]; ?></strong>
        </div>

        <div class="section-title">Üye İmzaları</div>

        <div class="row g-4">
            <div class="col-md-6">
                <strong>Üye Tüzük İmzası</strong><br>
                <?php if(!empty($imzalar["uye_ust_imza"])) { ?>
                    <img src="<?php echo $imzalar["uye_ust_imza"]; ?>" class="signature-img">
                <?php } ?>
            </div>

            <div class="col-md-6">
                <strong>Üye İmzası</strong><br>
                <?php if(!empty($imzalar["uye_alt_imza"])) { ?>
                    <img src="<?php echo $imzalar["uye_alt_imza"]; ?>" class="signature-img">
                <?php } ?>
            </div>
        </div>

    </div>

    <div class="form-card">

        <div class="section-title">Dernek Tarafından Doldurulacak</div>

        <?php if($b["durum"] == "onaylandi") { ?>

            <div class="info-grid">
                <div class="info-box">
                    <span>Sayın</span>
                    <strong><?php echo $b["dernek_sayin"]; ?></strong>
                </div>

                <div class="info-box">
                    <span>Karar Tarihi</span>
                    <strong><?php echo $b["dernek_karar_tarihi"]; ?></strong>
                </div>

                <div class="info-box">
                    <span>Karar Sayısı</span>
                    <strong><?php echo $b["dernek_karar_sayisi"]; ?></strong>
                </div>

                <div class="info-box">
                    <span>Dernek Başkanı</span>
                    <strong><?php echo $b["dernek_baskani"]; ?></strong>
                </div>
            </div>

            <div class="mt-4">
                <strong>Dernek Başkanı İmzası</strong><br>
                <?php if(!empty($b["baskan_imza"])) { ?>
                    <img src="<?php echo $b["baskan_imza"]; ?>" class="signature-img">
                <?php } ?>
            </div>

        <?php } else { ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="fw-bold">Sayın</label>
                    <input type="text" name="dernek_sayin" class="form-control" value="<?php echo $b["ad"] . " " . $b["soyad"]; ?>" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Karar Tarihi</label>
                        <input type="date" name="dernek_karar_tarihi" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Karar Sayısı</label>
                        <input type="text" name="dernek_karar_sayisi" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="fw-bold">Dernek Başkanı Adı Soyadı</label>
                        <input type="text" name="dernek_baskani" class="form-control" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="fw-bold">Dernek Başkanı İmza - Mühür</label>
                    <div class="signature-box">
                        <canvas id="baskan-imza"></canvas>
                    </div>

                    <button type="button" class="btn-clear mt-2" onclick="clearSignature()">
                        İmzayı Temizle
                    </button>
                </div>

                <input type="hidden" name="baskan_imza" id="baskan_imza">

                <div class="mt-4">
                    <button type="submit" name="onayla" class="btn-main">
                        Başvuruyu Onayla
                    </button>
                </div>

            </form>

        <?php } ?>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
const canvas = document.getElementById("baskan-imza");

if(canvas){
    const signaturePad = new SignaturePad(canvas);

    function resizeCanvas(){
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 120 * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }

    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();

    function clearSignature(){
        signaturePad.clear();
    }

    document.querySelector("form").addEventListener("submit", function(e){
        if(signaturePad.isEmpty()){
            e.preventDefault();
            alert("Lütfen dernek başkanı imzasını atınız.");
            return;
        }

        document.getElementById("baskan_imza").value = signaturePad.toDataURL();
    });
}
</script>

</body>
</html>