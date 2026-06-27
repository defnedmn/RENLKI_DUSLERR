<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    mysqli_query($baglanti, "DELETE FROM etkinlik_gonulluleri WHERE gonullu_id=$id");
    mysqli_query($baglanti, "DELETE FROM gonulluler WHERE id=$id");
}

header("Location: gonullu-liste.php");
exit;
?>