<?php

$baglanti = mysqli_connect("localhost", "root", "", "renkli_dusler");

if (!$baglanti) {
    die("Veritabanı bağlantı hatası!");
}

$baglanti = mysqli_connect("localhost", "root", "", "renkli_dusler");

if (!$baglanti) {
    die("Veritabanı bağlantı hatası: " . mysqli_connect_error());
}

mysqli_set_charset($baglanti, "utf8");

?>