<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["sil"])) {
    $id = $_GET["sil"];
    mysqli_query($baglanti, "DELETE FROM gonullu_yorumlari WHERE id=$id");
    header("Location: gonullu-yorumlari.php");
    exit;
}

if (isset($_POST["guncelle"])) {
    $id = $_POST["id"];
    $adsoyad = mysqli_real_escape_string($baglanti, $_POST["adsoyad"]);
    $unvan = mysqli_real_escape_string($baglanti, $_POST["unvan"]);
    $yorum = mysqli_real_escape_string($baglanti, $_POST["yorum"]);

    mysqli_query($baglanti, "UPDATE gonullu_yorumlari SET
        adsoyad='$adsoyad',
        unvan='$unvan',
        yorum='$yorum'
        WHERE id=$id
    ");

    header("Location: gonullu-yorumlari.php");
    exit;
}

$yorumlar = mysqli_query($baglanti, "SELECT * FROM gonullu_yorumlari ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Gönüllü Yorumları</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#172033;
}

.wrapper{
    max-width:950px;
    margin:40px auto;
    padding:0 20px;
}

.top-box{
    background:white;
    border-radius:26px;
    padding:24px;
    margin-bottom:24px;
    box-shadow:0 10px 28px rgba(23,32,51,.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.top-box h1{
    font-weight:900;
    margin:0;
}

.top-box p{
    margin:6px 0 0;
    color:#64748b;
}

.back-btn{
    background:#172033;
    color:white;
    text-decoration:none;
    padding:12px 18px;
    border-radius:14px;
    font-weight:800;
}

.back-btn:hover{
    color:white;
    background:#0f172a;
}

.comment-card{
    background:white;
    border-radius:22px;
    padding:22px;
    margin-bottom:18px;
    box-shadow:0 10px 28px rgba(23,32,51,.08);
    border-left:5px solid #0f766e;
}

.comment-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:18px;
}

.comment-name{
    font-size:20px;
    font-weight:900;
    color:#172033;
}

.comment-role{
    color:#64748b;
    font-size:14px;
    margin-top:3px;
}

.comment-text{
    margin:16px 0 0;
    color:#475569;
    line-height:1.7;
}

.action-buttons{
    display:flex;
    gap:10px;
}

.btn-edit{
    border:none;
    background:#0f766e;
    color:white;
    padding:9px 14px;
    border-radius:12px;
    font-weight:800;
}

.btn-delete{
    background:#ef476f;
    color:white;
    text-decoration:none;
    padding:9px 14px;
    border-radius:12px;
    font-weight:800;
}

.btn-delete:hover{
    color:white;
    background:#d6335c;
}

.edit-form{
    display:none;
    margin-top:18px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:18px;
    padding:18px;
}

.edit-form label{
    font-weight:750;
    margin-bottom:6px;
}

.update-btn{
    background:#0f766e;
    color:white;
    border:none;
    border-radius:14px;
    padding:12px;
    font-weight:850;
    width:100%;
}

.cancel-btn{
    background:#e2e8f0;
    color:#172033;
    border:none;
    border-radius:14px;
    padding:12px;
    font-weight:850;
    width:100%;
}

.empty{
    background:white;
    border-radius:22px;
    padding:30px;
    text-align:center;
    box-shadow:0 10px 28px rgba(23,32,51,.08);
}

@media(max-width:768px){
    .top-box,
    .comment-header{
        flex-direction:column;
    }
}
</style>
</head>

<body>

<div class="wrapper">

    <div class="top-box">
        <div>
            <h1>Gönüllü Yorumları</h1>
            <p>Ana sayfadaki “Gönüllüler Ne Diyor?” yorumlarını buradan yönetebilirsin.</p>
        </div>

        <a href="dashboard.php" class="back-btn">Panele Dön</a>
    </div>

    <?php if(mysqli_num_rows($yorumlar) > 0) { ?>

        <?php while($y = mysqli_fetch_assoc($yorumlar)) { ?>

            <div class="comment-card">

                <div class="comment-header">

                    <div>
                        <div class="comment-name">
                            <?php echo $y["adsoyad"]; ?>
                        </div>

                        
                    </div>

                    <div class="action-buttons">
                        <button type="button"
                                class="btn-edit"
                                onclick="toggleEdit('edit-<?php echo $y['id']; ?>')">
                            Düzenle
                        </button>

                        <a class="btn-delete"
                           href="gonullu-yorumlari.php?sil=<?php echo $y["id"]; ?>"
                           onclick="return confirm('Bu yorumu silmek istediğine emin misin?');">
                            Sil
                        </a>
                    </div>

                </div>

               
                <form method="POST"
                      class="edit-form"
                      id="edit-<?php echo $y['id']; ?>">

                    <input type="hidden" name="id" value="<?php echo $y["id"]; ?>">

                    <div class="mb-3">
                        <label>Ad Soyad</label>
                        <input type="text"
                               name="adsoyad"
                               class="form-control"
                               value="<?php echo $y["adsoyad"]; ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Unvan</label>
                        <input type="text"
                               name="unvan"
                               class="form-control"
                               value="<?php echo $y["unvan"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Yorum</label>
                        <textarea name="yorum"
                                  class="form-control"
                                  rows="4"
                                  required><?php echo $y["yorum"]; ?></textarea>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <button type="submit"
                                    name="guncelle"
                                    class="update-btn">
                                Güncelle
                            </button>
                        </div>

                        <div class="col-md-6">
                            <button type="button"
                                    class="cancel-btn"
                                    onclick="toggleEdit('edit-<?php echo $y['id']; ?>')">
                                Vazgeç
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="empty">
            Henüz gönüllü yorumu eklenmedi.
        </div>

    <?php } ?>

</div>

<script>
function toggleEdit(id){
    const form = document.getElementById(id);

    if(form.style.display === "block"){
        form.style.display = "none";
    }else{
        form.style.display = "block";
    }
}
</script>

</body>
</html>