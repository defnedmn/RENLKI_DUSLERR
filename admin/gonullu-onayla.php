<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    mysqli_query($baglanti, "UPDATE gonulluler SET durum='onaylandi' WHERE id=$id");
}

header("Location: gonullu-liste.php");
exit;
?>