<?php
include "config/db.php";

$arama = "";

if (isset($_GET["arama"])) {
    $arama = $_GET["arama"];

    $sorgu = mysqli_query($baglanti,
        "SELECT * FROM etkinlikler 
        WHERE baslik LIKE '%$arama%' 
        OR kategori LIKE '%$arama%'
        OR konum LIKE '%$arama%'
        ORDER BY id DESC");
} else {
    $sorgu = mysqli_query($baglanti, "SELECT * FROM etkinlikler ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Etkinlikler - Renkli Düşler</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f7f1e8;
    font-family:"Segoe UI", Arial, sans-serif;
    color:#263238;
}

.navbar{
    background:#172033;
    padding:16px 0;
}

.navbar-brand{
    font-weight:900;
}

.nav-link{
    font-weight:650;
}

.hero{
    background:
    linear-gradient(120deg,rgba(23,32,51,.88),rgba(15,118,110,.78)),
    url("https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=1600&auto=format&fit=crop");
    background-size:cover;
    background-position:center;
    padding:95px 0;
    color:white;
}

.hero h1{
    font-size:52px;
    font-weight:900;
}

.hero p{
    max-width:720px;
    color:#edf2f7;
    font-size:18px;
}

.search-box{
    background:white;
    padding:16px;
    border-radius:24px;
    margin-top:-38px;
    position:relative;
    z-index:5;
    box-shadow:0 12px 30px rgba(23,32,51,.10);
}

.search-input{
    border:none;
    padding:15px;
    border-radius:16px;
    width:100%;
    background:#f8fafc;
}

.search-input:focus{
    outline:none;
}

.search-btn{
    background:#0f766e;
    color:white;
    border:none;
    padding:14px 20px;
    border-radius:16px;
    font-weight:850;
}

.event-card{
    background:white;
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
    transition:.25s;
    height:100%;
    cursor:pointer;
}

.event-card:hover{
    transform:translateY(-6px);
}

.event-card img{
    width:100%;
    height:240px;
    object-fit:cover;
}

.event-body{
    padding:24px;
}

.badge-cat{
    display:inline-block;
    background:#fff4df;
    color:#b45309;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:850;
    margin-bottom:14px;
}

.event-body h4{
    font-weight:900;
    color:#172033;
}

.meta{
    color:#64748b;
    font-size:14px;
    margin-bottom:14px;
}

.event-text{
    color:#475569;
    line-height:1.6;
    min-height:90px;
}

.empty{
    background:white;
    border-radius:28px;
    padding:50px;
    text-align:center;
    box-shadow:0 12px 30px rgba(23,32,51,.08);
}

.footer{
    background:#172033;
    color:white;
    padding:25px 0;
}

.modal-bg{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
    padding:20px;
}

.modal-box{
    background:white;
    width:100%;
    max-width:720px;
    border-radius:28px;
    padding:35px;
    position:relative;
    box-shadow:0 25px 70px rgba(0,0,0,.25);
    max-height:85vh;
    overflow-y:auto;
}

.modal-box h3{
    font-weight:900;
    color:#172033;
    margin-bottom:15px;
    padding-right:45px;
}

.modal-box p{
    color:#475569;
    line-height:1.8;
}

.modal-close{
    position:absolute;
    right:22px;
    top:18px;
    border:none;
    background:#f1f5f9;
    width:38px;
    height:38px;
    border-radius:50%;
    font-size:22px;
    font-weight:900;
    color:#172033;
    cursor:pointer;
}

.modal-info{
    color:#0f766e;
    font-weight:850;
    margin-bottom:10px;
}
.nav-dropdown{
    position:relative;
}

.dropdown-menu-custom{
    position:absolute;
    top:42px;
    left:0;
    background:white;
    min-width:230px;
    border-radius:18px;
    padding:12px;
    display:none;
    flex-direction:column;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    z-index:9999;
}

.dropdown-menu-custom a{
    text-decoration:none;
    color:#172033;
    padding:12px;
    border-radius:12px;
    font-weight:600;
}

.dropdown-menu-custom a:hover{
    background:#eef8f6;
    color:#0f766e;
}

.nav-dropdown:hover .dropdown-menu-custom{
    display:flex;
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            Renkli Düşler
        </a>

       <div class="navbar-nav ms-auto align-items-center">

    <a class="nav-link" href="index.php">Ana Sayfa</a>

    <div class="nav-dropdown">
        <a class="nav-link" href="#">Dernek ▾</a>

        <div class="dropdown-menu-custom">
            <a href="index.php#hakkimizda">Dernek Hakkında</a>
            <a href="index.php#faaliyetler">Yönetim Kurulu</a>
          <a href="dernek-uyeligi.php">Dernek Üyeliği</a>
            <a href="gonullu.php">Gönüllü Başvurusu</a>
        </div>
    </div>

    <a class="nav-link active" href="etkinlikler.php">Etkinlikler</a>

    <a class="nav-link" href="iletisim.php">İletişim</a>
   

</div>

    </div>
</nav>

<section class="hero">
    <div class="container">
        <h1>Etkinliklerimiz</h1>

        <p class="mt-3">
            Çocukların eğitim, sosyal gelişim, kültür-sanat ve dayanışma alanlarında
            gelişimini destekleyen etkinlikleri buradan inceleyebilirsiniz.
        </p>
    </div>
</section>

<section class="container">
    <div class="search-box">

        <form method="GET">
            <div class="row g-3 align-items-center">

                <div class="col-lg-10">
                    <input type="text"
                           name="arama"
                           class="search-input"
                           placeholder="Etkinlik adı, kategori veya konum ara..."
                           value="<?php echo $arama; ?>">
                </div>

                <div class="col-lg-2">
                    <button class="search-btn w-100">
                        Ara
                    </button>
                </div>

            </div>
        </form>

    </div>
</section>

<section class="container py-5">

    <?php if (mysqli_num_rows($sorgu) > 0) { ?>

        <div class="row g-4">

            <?php while ($etkinlik = mysqli_fetch_assoc($sorgu)) { ?>

                <div class="col-lg-4 col-md-6">

                    <div class="event-card"
                         onclick="openModal(
                            '<?php echo addslashes($etkinlik["baslik"]); ?>',
                            'Kategori: <?php echo addslashes($etkinlik["kategori"]); ?> | Tarih: <?php echo addslashes($etkinlik["tarih"]); ?> | Saat: <?php echo substr($etkinlik["saat"],0,5); ?> | Konum: <?php echo addslashes($etkinlik["konum"]); ?> | Yaş Grubu: <?php echo addslashes($etkinlik["yas_araligi"]); ?>',
                            '<?php echo addslashes($etkinlik["aciklama"]); ?>'
                         )">

                        <?php if (!empty($etkinlik["resim"])) { ?>
                            <img src="uploads/<?php echo $etkinlik["resim"]; ?>">
                        <?php } else { ?>
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop">
                        <?php } ?>

                        <div class="event-body">

                            <div class="badge-cat">
                                <?php echo $etkinlik["kategori"]; ?>
                            </div>

                            <h4>
                                <?php echo $etkinlik["baslik"]; ?>
                            </h4>

                            <div class="meta">
                                'Kategori: <?php echo addslashes($etkinlik["kategori"]); ?> | Tarih: <?php echo $etkinlik["tarih"]; ?>

<?php if(!empty($etkinlik["saat"])) { ?>
    <br>
    Saat: <?php echo substr($etkinlik["saat"],0,5); ?>
<?php } ?>

<br>

<?php echo $etkinlik["konum"]; ?>
                                Yaş Grubu: <?php echo $etkinlik["yas_araligi"]; ?>
                            </div>

                            <div class="event-text">
                                <?php echo mb_substr($etkinlik["aciklama"], 0, 120, "UTF-8"); ?>...
                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="empty">
            <h3>Etkinlik bulunamadı.</h3>
            <p>Arama kriterlerinize uygun etkinlik bulunmuyor.</p>
        </div>

    <?php } ?>

</section>

<div class="modal-bg" id="customModal">
    <div class="modal-box">

        <button class="modal-close" onclick="closeModal()">×</button>

        <h3 id="modalTitle"></h3>

        <div class="modal-info" id="modalInfo"></div>

        <p id="modalText"></p>

    </div>
</div>

<footer class="footer">
    <div class="container text-center">
        © 2026 Renkli Düşler Çocuk Derneği
    </div>
</footer>

<script>
function openModal(title, info, text){
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalInfo").innerText = info;
    document.getElementById("modalText").innerText = text;
    document.getElementById("customModal").style.display = "flex";
}

function closeModal(){
    document.getElementById("customModal").style.display = "none";
}

document.getElementById("customModal").addEventListener("click", function(e){
    if(e.target.id === "customModal"){
        closeModal();
    }
});
</script>

</body>
</html>