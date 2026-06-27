<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $resim_sorgu = mysqli_query($baglanti, "SELECT resim FROM etkinlikler WHERE id=$id");
    $resim = mysqli_fetch_assoc($resim_sorgu);

    if (!empty($resim["resim"])) {
        $dosya_yolu = "../uploads/" . $resim["resim"];

        if (file_exists($dosya_yolu)) {
            unlink($dosya_yolu);
        }
    }

    mysqli_query($baglanti, "DELETE FROM etkinlikler WHERE id=$id");
}

header("Location: etkinlik-liste.php");
exit;
?>