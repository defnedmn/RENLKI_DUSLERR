<?php
session_start();
include "../config/db.php";

if (isset($_POST["giris"])) {
    $kullanici_adi = $_POST["kullanici_adi"];
    $sifre = $_POST["sifre"];

    $sorgu = mysqli_query($baglanti, "SELECT * FROM admin WHERE kullanici_adi='$kullanici_adi' AND sifre='$sifre'");

    if (mysqli_num_rows($sorgu) > 0) {
        $_SESSION["admin"] = $kullanici_adi;
        header("Location: dashboard.php");
        exit;
    } else {
        $hata = "Kullanıcı adı veya şifre hatalı!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Giriş</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="admin-login-body">

<div class="login-card">

    <div class="text-center mb-4">
        <div class="login-icon">🎈</div>
        <h2>Renkli Düşler</h2>
        <p>Admin Panel Girişi</p>
    </div>

    <?php if (isset($hata)) { ?>
        <div class="alert alert-danger">
            <?php echo $hata; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Kullanıcı Adı</label>
            <input type="text" name="kullanici_adi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Şifre</label>
            <input type="password" name="sifre" class="form-control" required>
        </div>

        <button type="submit" name="giris" class="btn btn-warning w-100">
            Giriş Yap
        </button>

    </form>

    <div class="text-center mt-3">
        <a href="../index.php">← Siteye Dön</a>
    </div>

</div>

</body>
</html>