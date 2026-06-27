<?php
include "config/db.php";

if (isset($_POST["basvur"])) {
    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $tc = $_POST["tc"];
    $dogum_tarihi = $_POST["dogum_tarihi"];
    $dogum_yeri = $_POST["dogum_yeri"];
    $anne_adi = $_POST["anne_adi"];
    $tabiiyet = $_POST["tabiiyet"];
    $cinsiyet = $_POST["cinsiyet"];
    $meslek = $_POST["meslek"];
    $mezuniyet = $_POST["mezuniyet"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];
    $adres = $_POST["adres"];
    $kurum = $_POST["kurum"];
    $imza = $_POST["imza"];

    $kaydet = mysqli_query($baglanti, "INSERT INTO uye_basvurulari 
    (ad, soyad, tc, dogum_tarihi, dogum_yeri, anne_adi, tabiiyet, cinsiyet, meslek, mezuniyet, telefon, email, adres, kurum, imza)
    VALUES 
    ('$ad', '$soyad', '$tc', '$dogum_tarihi', '$dogum_yeri', '$anne_adi', '$tabiiyet', '$cinsiyet', '$meslek', '$mezuniyet', '$telefon', '$email', '$adres', '$kurum', '$imza')");

    if ($kaydet) {
        $basari = "Üyelik başvurunuz başarıyla gönderildi.";
    } else {
        $hata = "Başvuru gönderilirken hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Üye Başvuru Formu | Renkli Düşler</title>

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
    color:white !important;
    font-weight:900;
}

.nav-link{
    color:white !important;
    font-weight:650;
}

.form-wrapper{
    max-width:1050px;
    margin:45px auto;
    background:white;
    border-radius:30px;
    overflow:hidden;
    box-shadow:0 18px 45px rgba(23,32,51,.14);
}

.form-header{
    background:linear-gradient(120deg,#172033,#0f766e);
    color:white;
    padding:35px;
    text-align:center;
}

.form-header h1{
    font-weight:900;
    margin:0;
}

.form-content{
    padding:38px;
}

.form-box{
    border:1px solid #dbe4ea;
    border-radius:22px;
    background:#f8fafc;
    padding:24px;
    margin-bottom:25px;
}

.section-title{
    background:#0f766e;
    color:white;
    padding:13px 18px;
    border-radius:14px;
    font-weight:900;
    margin-bottom:18px;
}

label{
    font-weight:700;
    margin-bottom:6px;
}

.form-control,
.form-select{
    border-radius:12px;
    padding:11px 13px;
    border:1px solid #cbd5e1;
}

.form-control:focus,
.form-select:focus{
    border-color:#0f766e;
    box-shadow:0 0 0 .2rem rgba(15,118,110,.15);
}

.inline-input{
    display:inline-block;
    width:150px;
    height:36px;
    padding:6px 10px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    margin:0 4px;
}

.note{
    background:#fff7ed;
    border-left:6px solid #f97316;
    padding:15px;
    border-radius:14px;
    font-weight:600;
    color:#7c2d12;
    margin-top:18px;
}

.signature-box{
    border:2px dashed #94a3b8;
    border-radius:16px;
    background:white;
    overflow:hidden;
    max-width:360px;
    margin-left:auto;
}

.signature-box canvas{
    width:100%;
    height:105px;
    display:block;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:15px 34px;
    border-radius:16px;
    font-weight:900;
}

.btn-clear{
    background:#e2e8f0;
    color:#172033;
    border:none;
    padding:9px 16px;
    border-radius:12px;
    font-weight:800;
    font-size:14px;
}

.footer-text{
    text-align:center;
    color:#64748b;
    margin-top:20px;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Renkli Düşler</a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Ana Sayfa</a>
            <a class="nav-link" href="dernek-uyeligi.php">Dernek Üyeliği</a>
            <a class="nav-link" href="etkinlikler.php">Etkinlikler</a>
            <a class="nav-link" href="iletisim.php">İletişim</a>
        </div>
    </div>
</nav>

<div class="form-wrapper">

    <div class="form-header">
        <h1>Üye Başvuru Formu</h1>
        <p class="mb-0 mt-2">Renkli Düşler Çocuk Derneği üyelik başvuru ekranı</p>
    </div>

    <div class="form-content">

        <h4 class="fw-bold text-center mb-4">
            RENKLİ DÜŞLER ÇOCUK DERNEĞİ BAŞKANLIĞINA
        </h4>

        <?php if(isset($basari)) { ?>
            <div class="alert alert-success"><?php echo $basari; ?></div>
        <?php } ?>

        <?php if(isset($hata)) { ?>
            <div class="alert alert-danger"><?php echo $hata; ?></div>
        <?php } ?>

        <form method="POST">

            <div class="form-box">
                <p>
                    Derneğinizin tüzüğünü okudum. Tüzükte belirtilen şartlara uyarak üye olmak istiyorum.
                    Bu inançla verilecek tüm görevleri yapacağımı, yüklendiğim ödentileri zamanında,
                    tam ve eksiksiz ödeyeceğimi ve aşağıdaki bilgilerin doğruluğunu kabul ve taahhüt ediyorum.
                    Tarih:
                    <input type="date" name="basvuru_tarihi" class="inline-input">
                </p>

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label>Adı Soyadı</label>
                        <input type="text" name="ust_adsoyad" class="form-control">
                    </div>

                    <div class="col-md-6 text-end">
                        <label>Üye İmzası</label>
                        <div class="signature-box">
                            <canvas id="uye-imza-1"></canvas>
                        </div>
                        <button type="button" class="btn-clear mt-2" onclick="clearPad('uye1')">
                            Temizle
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-box">
                <div class="section-title">Üye Bilgileri</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Adı</label>
                        <input type="text" name="ad" class="form-control" required>
                    </div>

                

                    <div class="col-md-6">
                        <label>Soyadı</label>
                        <input type="text" name="soyad" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Cinsiyeti</label>
                        <select name="cinsiyet" class="form-select" required>
                            <option value="">Seçiniz</option>
                            <option value="Kadın">Kadın</option>
                            <option value="Erkek">Erkek</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>T.C. Kimlik No</label>
                        <input type="text" name="tc" class="form-control" maxlength="11" required>
                    </div>

                    <div class="col-md-6">
                        <label>Mesleği</label>
                        <input type="text" name="meslek" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Doğum Tarihi</label>
                        <input type="date" name="dogum_tarihi" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Mezuniyet / Okul / Dönem</label>
                        <input type="text" name="mezuniyet" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Doğum Yeri</label>
                        <input type="text" name="dogum_yeri" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Cep Telefonu</label>
                        <input type="text" name="telefon" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Anne Adı</label>
                        <input type="text" name="anne_adi" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>E-posta Adresi</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label>Yerleşim Yeri Adresi</label>
                        <textarea name="adres" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="col-md-12">
                        <label>Çalıştığı Kurum / Adresi</label>
                        <textarea name="kurum" class="form-control" rows="2"></textarea>
                    </div>
                </div>

               

            <div class="form-box">
                <div class="section-title">Dernek Tarafından Doldurulacak</div>

                <div class="mb-3">
                    <label>Sayın</label>
                    <input type="text" name="dernek_sayin" class="form-control" placeholder="Başvuru sahibinin adı soyadı">
                </div>

                <p>
                    Yukarıdaki dilekçeniz ile yapmış olduğunuz üyelik müracaatınız,
                    Yönetim Kurulumuzun
                    <input type="date" name="dernek_karar_tarihi" class="inline-input">
                    tarih ve
                    <input type="text" name="dernek_karar_sayisi" class="inline-input" placeholder="Karar sayısı">
                    sayılı kararı ile kabul edilmiştir. Bu tarihten itibaren tüzük gereğince üyelik şartlarının yerine getirilmesini rica ederim.
                </p>

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label>Dernek Başkanı Adı Soyadı</label>
                        <input type="text" name="dernek_baskani" class="form-control">
                    </div>

                    <div class="col-md-6 text-end">
                        <label>Dernek Başkanı İmza - Mühür</label>
                        <div class="signature-box">
                            <canvas id="baskan-imza"></canvas>
                        </div>
                        <button type="button" class="btn-clear mt-2" onclick="clearPad('baskan')">
                            Temizle
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-box">
                <div class="section-title">Üye Tarafından Doldurulacak</div>

                <p>
                    Yönetim Kurulunun
                    <input type="date" name="uye_karar_tarihi" class="inline-input">
                    tarih ve
                    <input type="text" name="uye_karar_sayisi" class="inline-input" placeholder="Karar sayısı">
                    sayılı kararı ile derneğin üyeliğine kabul edildiğimi tebellüğ ederek,
                    dernek tüzüğünde belirtilen üyelik şartları ve yükümlülüklerini yerine getireceğimi
                    beyan ve taahhüt ederim.
                    Tarih:
                    <input type="date" name="uye_taahhut_tarihi" class="inline-input">
                </p>

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label>Adı Soyadı</label>
                        <input type="text" name="alt_adsoyad" class="form-control">
                    </div>

                    <div class="col-md-6 text-end">
                        <label>Üye İmzası</label>
                        <div class="signature-box">
                            <canvas id="uye-imza-2"></canvas>
                        </div>
                        <button type="button" class="btn-clear mt-2" onclick="clearPad('uye2')">
                            Temizle
                        </button>
                    </div>
                </div>
            </div>

            <input type="hidden" name="imza" id="imza">

            <div class="text-center mt-4">
                <button type="submit" name="basvur" class="btn-main">
                    Başvuruyu Gönder
                </button>
            </div>

        </form>

        <div class="footer-text">
            © 2026 Renkli Düşler Çocuk Derneği
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
const pads = {
    uye1: new SignaturePad(document.getElementById("uye-imza-1")),
    baskan: new SignaturePad(document.getElementById("baskan-imza")),
    uye2: new SignaturePad(document.getElementById("uye-imza-2"))
};

function resizeCanvas(canvas, pad){
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = 105 * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    pad.clear();
}

function resizeAll(){
    resizeCanvas(document.getElementById("uye-imza-1"), pads.uye1);
    resizeCanvas(document.getElementById("baskan-imza"), pads.baskan);
    resizeCanvas(document.getElementById("uye-imza-2"), pads.uye2);
}

window.addEventListener("resize", resizeAll);
resizeAll();

function clearPad(type){
    pads[type].clear();
}

document.querySelector("form").addEventListener("submit", function(e){
    if(pads.uye1.isEmpty()){
        e.preventDefault();
        alert("Lütfen üst bölümdeki üye imzasını atınız.");
        return;
    }

    if(pads.uye2.isEmpty()){
        e.preventDefault();
        alert("Lütfen alt bölümdeki üye imzasını atınız.");
        return;
    }

    document.getElementById("imza").value = JSON.stringify({
        uye_ust_imza: pads.uye1.toDataURL(),
        baskan_imza: pads.baskan.isEmpty() ? "" : pads.baskan.toDataURL(),
        uye_alt_imza: pads.uye2.toDataURL()
    });
});
</script>

</body>
</html>