<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$uye_sorgu = mysqli_query($baglanti, "SELECT * FROM mevcut_uyeler WHERE id=$id");
$uye = mysqli_fetch_assoc($uye_sorgu);

if (isset($_POST["guncelle"])) {
    $adsoyad = $_POST["adsoyad"];

    mysqli_query($baglanti, "UPDATE mevcut_uyeler SET adsoyad='$adsoyad' WHERE id=$id");

    header("Location: uyeler-yonetim.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Üye Düzenle</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
}

.card-box{
    max-width:600px;
    margin:60px auto;
    background:white;
    padding:35px;
    border-radius:28px;
    box-shadow:0 15px 35px rgba(23,32,51,.12);
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    padding:13px 22px;
    border-radius:14px;
    font-weight:800;
}

</style>
</head>

<body>

<div class="card-box">
    <h2 class="fw-bold mb-4">Mevcut Üye Düzenle</h2>

    <form method="POST">
        <div class="mb-3">
            <label class="fw-bold">Ad Soyad</label>
            <input type="text" name="adsoyad" class="form-control" value="<?php echo $uye["adsoyad"]; ?>" required>
        </div>

        <button type="submit" name="guncelle" class="btn-main">
            Güncelle
        </button>

        <a href="uyeler-yonetim.php" class="btn btn-secondary ms-2">
            Geri Dön
        </a>
    </form>
</div>

</body>
</html>