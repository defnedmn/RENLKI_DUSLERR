<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$etkinlikler = mysqli_query($baglanti,
"SELECT * FROM etkinlikler ORDER BY id DESC");

$gonulluler = mysqli_query($baglanti,
"SELECT * FROM gonulluler WHERE durum='onaylandi' ORDER BY adsoyad ASC");

if(isset($_POST["ata"])){

    $etkinlik_id = $_POST["etkinlik_id"];
    $gonullu_id = $_POST["gonullu_id"];
    $gorev = $_POST["gorev"];

    mysqli_query($baglanti, "INSERT INTO etkinlik_gonulluleri
    (etkinlik_id, gonullu_id, gorev)
    VALUES
    ('$etkinlik_id', '$gonullu_id', '$gorev')");

    $basari = "Gönüllü etkinliğe başarıyla atandı.";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Atama</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f7f1e8;
    font-family:"Segoe UI",sans-serif;
}

.wrapper{
    max-width:850px;
    margin:50px auto;
}

.card-box{
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

h1{
    font-weight:900;
    margin-bottom:25px;
}

.form-control,
.form-select{
    border-radius:14px;
    padding:13px;
}

.btn-save{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px;
    border-radius:14px;
    width:100%;
    font-weight:850;
}
</style>
</head>

<body>

<div class="wrapper">

    <div class="card-box">

        <h1>Etkinliğe Gönüllü Ata</h1>

        <?php if(isset($basari)) { ?>
            <div class="alert alert-success">
                <?php echo $basari; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label>Etkinlik Seç</label>

                <select name="etkinlik_id" class="form-select" required>

                    <option value="">Seçiniz</option>

                    <?php while($e = mysqli_fetch_assoc($etkinlikler)) { ?>

                        <option value="<?php echo $e["id"]; ?>">
                            <?php echo $e["baslik"]; ?>
                        </option>

                    <?php } ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Gönüllü Seç</label>

                <select name="gonullu_id" class="form-select" required>

                    <option value="">Seçiniz</option>

                    <?php while($g = mysqli_fetch_assoc($gonulluler)) { ?>

                        <option value="<?php echo $g["id"]; ?>">
                            <?php echo $g["adsoyad"]; ?>
                        </option>

                    <?php } ?>

                </select>
            </div>

            <div class="mb-4">
                <label>Görev</label>

                <input type="text"
                       name="gorev"
                       class="form-control"
                       placeholder="Örn: Çocuk etkinliği desteği"
                       required>
            </div>

            <button type="submit" name="ata" class="btn-save">
                Gönüllüyü Ata
            </button>

        </form>

    </div>

</div>

</body>
</html>