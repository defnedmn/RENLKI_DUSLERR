<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

/* MEVCUT ÜYE EKLE */
if (isset($_POST["uye_ekle"])) {
    $adsoyad = $_POST["uye_adsoyad"];
   mysqli_query($baglanti, "INSERT INTO mevcut_uyeler (adsoyad)
VALUES ('$adsoyad')");

    header("Location: uyeler-yonetim.php");
    exit;
}
/* YÖNETİM KURULU GÜNCELLE */
if (isset($_POST["kurul_guncelle"])) {
    $id = $_POST["kurul_id"];
    $adsoyad = $_POST["kurul_adsoyad"];
    $gorev = $_POST["gorev"];
    $cinsiyet = $_POST["cinsiyet"];
   $ozgecmis = mysqli_real_escape_string($baglanti, $_POST["ozgecmis"]);

    mysqli_query($baglanti, "UPDATE yonetim_kurulu SET
        adsoyad='$adsoyad',
        gorev='$gorev',
        cinsiyet='$cinsiyet',
        ozgecmis='$ozgecmis'
        WHERE id=$id
    ");

    header("Location: uyeler-yonetim.php");
    exit;
}
/* YÖNETİM KURULU EKLE */
if (isset($_POST["kurul_ekle"])) {
$adsoyad = mysqli_real_escape_string($baglanti, $_POST["kurul_adsoyad"]);

$gorev = mysqli_real_escape_string($baglanti, $_POST["gorev"]);

$cinsiyet = mysqli_real_escape_string($baglanti, $_POST["cinsiyet"]);

$ozgecmis = mysqli_real_escape_string($baglanti, $_POST["ozgecmis"]);

    mysqli_query($baglanti, "INSERT INTO yonetim_kurulu (adsoyad, gorev, cinsiyet, ozgecmis)
    VALUES ('$adsoyad', '$gorev', '$cinsiyet', '$ozgecmis')");

    header("Location: uyeler-yonetim.php");
    exit;
}

/* SİLME */
if (isset($_GET["uye_sil"])) {
    $id = $_GET["uye_sil"];
    mysqli_query($baglanti, "DELETE FROM mevcut_uyeler WHERE id=$id");
    header("Location: uyeler-yonetim.php");
    exit;
}

if (isset($_GET["kurul_sil"])) {
    $id = $_GET["kurul_sil"];
    mysqli_query($baglanti, "DELETE FROM yonetim_kurulu WHERE id=$id");
    header("Location: uyeler-yonetim.php");
    exit;
}

$uyeler = mysqli_query($baglanti, "SELECT * FROM mevcut_uyeler ORDER BY id DESC");
$kurul = mysqli_query($baglanti, "SELECT * FROM yonetim_kurulu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Üye ve Yönetim Kurulu Yönetimi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
    background:white;
    border-radius:28px;
    padding:26px;
    margin-bottom:25px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.topbar h1{
    font-weight:900;
    margin:0;
}

.panel-card{
    background:white;
    border-radius:28px;
    padding:26px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    height:100%;
}

.panel-card h3{
    font-weight:900;
    color:#172033;
    margin-bottom:20px;
}

.form-control,
.form-select{
    border-radius:14px;
    padding:12px;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:14px;
    font-weight:850;
    width:100%;
}

.btn-delete{
    background:#ef476f;
    color:white;
    padding:8px 12px;
    border-radius:11px;
    text-decoration:none;
    font-weight:800;
    font-size:14px;
}

.btn-delete:hover{
    color:white;
    background:#d6335c;
}

.list-card{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:18px;
    padding:16px;
    margin-bottom:12px;
}

.list-card strong{
    color:#172033;
}

.role-badge{
    display:inline-block;
    background:#dcfce7;
    color:#166534;
    padding:6px 11px;
    border-radius:999px;
    font-size:12px;
    font-weight:850;
    margin-top:6px;
}

.icon-box{
    width:44px;
    height:44px;
    border-radius:50%;
    background:#172033;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}
.btn-edit{
    background:#0f766e;
    color:white;
    padding:8px 12px;
    border-radius:11px;
    text-decoration:none;
    font-weight:800;
    font-size:14px;
}

.btn-edit:hover{
    color:white;
    background:#115e59;
}
.mini-member-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:14px;
    padding:10px 12px;
    margin-bottom:8px;
    font-weight:800;
    color:#172033;
}
.edit-box summary{
    cursor:pointer;
    background:#0f766e;
    color:white;
    padding:9px 14px;
    border-radius:12px;
    font-weight:850;
    width:max-content;
}

.edit-box{
    margin-top:14px;
    padding-top:10px;
    border-top:1px solid #e2e8f0;

}
.edit-box form{
    margin-top:14px;
    background:#ffffff;
    padding:16px;
    border-radius:16px;
    border:1px solid #e2e8f0;

}
.list-card{
    overflow:hidden;
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
        <h1>Üyeler ve Yönetim Kurulu Yönetimi</h1>
        <p class="mb-0 text-muted">
            Mevcut üyeleri ve yönetim kurulu kişilerini buradan ekleyebilir, silebilir ve düzenleyebilirsin.
        </p>
    </div>

    <div class="row g-4">

        <!-- MEVCUT ÜYELER -->
        <div class="col-lg-6">
            <div class="panel-card">
                <h3>Mevcut Üyeler</h3>

                <form method="POST" class="mb-4">
                    <div class="mb-3">
                        <label class="fw-bold">Üye Ad Soyad</label>
                        <input type="text" name="uye_adsoyad" class="form-control" required>
                    </div>

                    <button type="submit" name="uye_ekle" class="btn-main">
                        Mevcut Üye Ekle
                    </button>
                </form>
<?php if(mysqli_num_rows($uyeler) > 0) { ?>
    <?php while($u = mysqli_fetch_assoc($uyeler)) { ?>

        <div class="mini-member-row">
            <span><?php echo $u["adsoyad"]; ?></span>

            <a class="btn-delete"
               href="uyeler-yonetim.php?uye_sil=<?php echo $u["id"]; ?>"
               onclick="return confirm('Bu üyeyi silmek istediğine emin misin?');">
                Sil
            </a>
        </div>

    <?php } ?>
<?php } else { ?>
    <p class="text-muted">Henüz mevcut üye eklenmedi.</p>
<?php } ?>
                 
            </div>
        </div>

        <!-- YÖNETİM KURULU -->
        <div class="col-lg-6">
            <div class="panel-card">
                <h3>Yönetim Kurulu</h3>

                <form method="POST" class="mb-4">

                    <div class="mb-3">
                        <label class="fw-bold">Ad Soyad</label>
                        <input type="text" name="kurul_adsoyad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Görev</label>
                        <input type="text" name="gorev" class="form-control" placeholder="Başkan, Genel Sekreter, Üye..." required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Cinsiyet </label>
                        <select name="cinsiyet" class="form-select" required>
                            <option value="">Seçiniz</option>
                            <option value="Kadın">Kadın</option>
                            <option value="Erkek">Erkek</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Kısa Özgeçmiş</label>
                        <textarea name="ozgecmis" class="form-control" rows="4"></textarea>
                    </div>

                    <button type="submit" name="kurul_ekle" class="btn-main">
                        Yönetim Kurulu Üyesi Ekle
                    </button>
                </form>

                <?php if(mysqli_num_rows($kurul) > 0) { ?>
                    <?php while($k = mysqli_fetch_assoc($kurul)) { ?>
                  <div class="list-card">

    <div class="d-flex justify-content-between align-items-start gap-3">

        <div class="d-flex gap-3">

            <div class="icon-box">

                <?php if($k["cinsiyet"] == "Kadın") { ?>
                    <i class="bi bi-person-standing-dress"></i>
                <?php } else { ?>
                    <i class="bi bi-person-standing"></i>
                <?php } ?>

            </div>

            <div>

                <strong><?php echo $k["adsoyad"]; ?></strong>

                <br>

                <span class="role-badge">
                    <?php echo $k["gorev"]; ?>
                </span>

                <p class="mb-0 mt-2 text-muted">
                    <?php echo mb_substr($k["ozgecmis"], 0, 90, "UTF-8"); ?>...
                </p>

            </div>

        </div>

        <div class="d-flex flex-column gap-2">

            <a class="btn-delete"
               href="uyeler-yonetim.php?kurul_sil=<?php echo $k["id"]; ?>"
               onclick="return confirm('Bu yönetim kurulu üyesini silmek istediğine emin misin?');">
                Sil
            </a>

        </div>

    </div>

    <details class="edit-box mt-3">

        <summary>Güncelle</summary>

        <form method="POST" class="mt-3">

            <input type="hidden" name="kurul_id"
                   value="<?php echo $k["id"]; ?>">

            <div class="mb-2">
                <label class="fw-bold">Ad Soyad</label>

                <input type="text"
                       name="kurul_adsoyad"
                       class="form-control"
                       value="<?php echo $k["adsoyad"]; ?>"
                       required>
            </div>

            <div class="mb-2">

                <label class="fw-bold">Görev</label>

                <input type="text"
                       name="gorev"
                       class="form-control"
                       value="<?php echo $k["gorev"]; ?>"
                       required>
            </div>

            <div class="mb-2">

                <label class="fw-bold">Cinsiyet</label>

                <select name="cinsiyet"
                        class="form-select"
                        required>

                    <option value="Kadın"
                        <?php if($k["cinsiyet"]=="Kadın") echo "selected"; ?>>
                        Kadın
                    </option>

                    <option value="Erkek"
                        <?php if($k["cinsiyet"]=="Erkek") echo "selected"; ?>>
                        Erkek
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="fw-bold">Özgeçmiş</label>

                <textarea name="ozgecmis"
                          class="form-control"
                          rows="4"><?php echo $k["ozgecmis"]; ?></textarea>

            </div>

            <button type="submit"
                    name="kurul_guncelle"
                    class="btn-main">

                Güncellemeyi Onayla

            </button>

        </form>

    </details>
</div>
    <?php } ?>
<?php } else { ?>
    <p class="text-muted">Henüz yönetim kurulu üyesi eklenmedi.</p>
<?php } ?>

</div>

            </div>
        </div>

    </div>

</main>

</body>
</html>