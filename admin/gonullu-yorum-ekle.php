<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["ekle"])) {
    $adsoyad = $_POST["adsoyad"];
    $unvan = $_POST["unvan"];
    $yorum = $_POST["yorum"];

    mysqli_query($baglanti, "INSERT INTO gonullu_yorumlari (adsoyad, unvan, yorum)
    VALUES ('$adsoyad', '$unvan', '$yorum')");

    header("Location: gonullu-yorum-ekle.php");
    exit;
}

$yorumlar = mysqli_query($baglanti, "SELECT * FROM gonullu_yorumlari ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Yorumu Ekle</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:"Segoe UI",Arial,sans-serif;
}

.card-box{
    max-width:800px;
    margin:40px auto;
    background:white;
    border-radius:28px;
    padding:30px;
    box-shadow:0 12px 30px rgba(23,32,51,.10);
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    border-radius:14px;
    padding:13px;
    font-weight:850;
    width:100%;
}

.comment-item{
    background:#f8fafc;
    border-radius:16px;
    padding:15px;
    margin-top:12px;
}
</style>
</head>

<body>

<div class="card-box">
    <h2 class="fw-bold mb-4">Gönüllü Yorumu Ekle</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Ad Soyad</label>
            <input type="text" name="adsoyad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Unvan</label>
            <input type="text" name="unvan" class="form-control" placeholder="Gönüllü Eğitmen">
        </div>

        <div class="mb-3">
            <label>Yorum</label>
            <textarea name="yorum" rows="4" class="form-control" required></textarea>
        </div>

        <button name="ekle" class="btn-main">Yorumu Ekle</button>
    </form>

    <hr>

    <?php while($y = mysqli_fetch_assoc($yorumlar)) { ?>
        <div class="comment-item">
            <strong><?php echo $y["adsoyad"]; ?></strong>
            <p class="mb-1"><?php echo $y["yorum"]; ?></p>
            <small><?php echo $y["unvan"]; ?></small>
        </div>
    <?php } ?>
</div>

</body>
</html>