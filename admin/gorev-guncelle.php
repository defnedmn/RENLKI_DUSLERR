<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$sorgu = mysqli_query($baglanti, "
SELECT etkinlik_gonulluleri.*, etkinlikler.baslik
FROM etkinlik_gonulluleri
INNER JOIN etkinlikler
ON etkinlik_gonulluleri.etkinlik_id = etkinlikler.id
WHERE etkinlik_gonulluleri.id=$id
");

$veri = mysqli_fetch_assoc($sorgu);

$etkinlikler = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY tarih DESC");

if(isset($_POST["guncelle"])){

    $etkinlik_id = $_POST["etkinlik_id"];
    $gorev = $_POST["gorev"];

    mysqli_query($baglanti, "
    UPDATE etkinlik_gonulluleri
    SET etkinlik_id='$etkinlik_id',
        gorev='$gorev'
    WHERE id=$id
    ");

    header("Location: gonullu-liste.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Görev Güncelle</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
}

.box{
    max-width:650px;
    margin:60px auto;
    background:white;
    border-radius:26px;
    padding:32px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.box h2{
    font-weight:900;
    margin-bottom:22px;
}

.btn-main{
    width:100%;
    background:#0f766e;
    color:white;
    border:none;
    padding:13px;
    border-radius:14px;
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

<div class="box">

    <h2>Görev Atamasını Güncelle</h2>

    <form method="POST">

        <div class="mb-3">
            <label class="fw-bold mb-2">Etkinlik</label>

            <select name="etkinlik_id" class="form-select" required>
                <?php while($e = mysqli_fetch_assoc($etkinlikler)) { ?>
                    <option value="<?php echo $e["id"]; ?>"
                        <?php if($e["id"] == $veri["etkinlik_id"]) echo "selected"; ?>>

                        <?php echo $e["baslik"]; ?> - <?php echo $e["tarih"]; ?>

                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="fw-bold mb-2">Görev</label>

            <input type="text"
                   name="gorev"
                   class="form-control"
                   value="<?php echo $veri["gorev"]; ?>"
                   required>
        </div>

        <button type="submit" name="guncelle" class="btn-main">
            Güncellemeyi Kaydet
        </button>

    </form>

    <a href="gonullu-liste.php" class="back-btn">
        ← Geri Dön
    </a>

</div>

</body>
</html>