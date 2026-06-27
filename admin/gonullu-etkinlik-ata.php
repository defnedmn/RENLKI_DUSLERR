<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$gonullu_id = $_GET["id"];

$gonullu_sorgu = mysqli_query($baglanti, "SELECT * FROM gonulluler WHERE id=$gonullu_id");
$gonullu = mysqli_fetch_assoc($gonullu_sorgu);

$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY tarih DESC");

if (isset($_POST["ata"])) {
    $etkinlik_id = $_POST["etkinlik_id"];
    $gorev = $_POST["gorev"];

    mysqli_query($baglanti, "INSERT INTO etkinlik_gonulluleri
    (etkinlik_id, gonullu_id, gorev)
    VALUES
    ('$etkinlik_id', '$gonullu_id', '$gorev')");

    header("Location: gonullu-liste.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Etkinlik Atama</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#172033;
}

.card-box{
    max-width:700px;
    margin:60px auto;
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 12px 30px rgba(23,32,51,.10);
}

.card-box h2{
    font-weight:900;
}

.info{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    margin:20px 0;
}

.btn-main{
    background:#0f766e;
    color:white;
    border:none;
    width:100%;
    padding:14px;
    border-radius:15px;
    font-weight:850;
}

.back-btn{
    display:inline-block;
    margin-top:14px;
    color:#0f766e;
    font-weight:850;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="card-box">

    <h2>Gönüllüye Etkinlik Ata</h2>

    <div class="info">
        <b>Gönüllü:</b> <?php echo $gonullu["adsoyad"]; ?><br>
        <b>İlgi Alanı:</b> <?php echo $gonullu["ilgi_alani"]; ?><br>
        <b>Müsaitlik:</b> <?php echo $gonullu["musaitlik"]; ?>
    </div>

    <form method="POST">

        <div class="mb-3">
            <label class="fw-bold">Etkinlik Seç</label>
            <select name="etkinlik_id" class="form-select" required>
                <option value="">Seçiniz</option>

                <?php while($e = mysqli_fetch_assoc($etkinlikler)) { ?>
                    <option value="<?php echo $e["id"]; ?>">
                        <?php echo $e["baslik"]; ?> - <?php echo $e["tarih"]; ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Görevi</label>
            <input type="text" name="gorev" class="form-control"
                   placeholder="Örn: Etkinlik desteği, kayıt masası, atölye yardımcısı" required>
        </div>

        <button type="submit" name="ata" class="btn-main">
            Etkinliğe Ata
        </button>

    </form>

    <a href="gonullu-liste.php" class="back-btn">← Geri Dön</a>

</div>

</body>
</html>