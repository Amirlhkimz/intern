<!DOCTYPE html>
<html>
<head>
<style>
.accordion {
    background-color: #7d1935;
    /*7d1935*/
    color: #FFFFFF;
    cursor: pointer;
    padding: 15px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    border-radius: 12px;
    font-weight: bold;
}

.active, .accordion:hover {
    background-color: #ccc;
    color: #2471A3;
}

.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<p align="center"> <b><font size="3">MENU UTAMA</font></b></p>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;"></i> Urus Mesyuarat</button>
<div class="panel">
  <p onMouseDown="window.location='Mesyuarat.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Pengurusan Mesyuarat</font></p>
  <p onMouseDown="window.location='TambahMesyuarat.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Tambah Bilangan Mesyuarat</font></p>
    <p onMouseDown="window.location='TambahUrusetia.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Tambah Urusetia</font></p>
	<p onMouseDown="window.location='TambahNamaMesyuarat.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Tambah Nama Mesyuarat</font></p>
</div>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;" ;"></i> Urus Kertas</button>
<div class="panel">
  <p onMouseDown="window.location='Utama.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Semua</font></p>
  <p onMouseDown="window.location='TambahUrusan.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Cipta Urusan Baru</font></p>
</div>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;"></i> Urus Pengumuman</button>
<div class="panel">
  <p onMouseDown="window.location='Pengumuman.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Pengurusan Pengumuman</font></p>
  <p onMouseDown="window.location='TambahPengumuman.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Tambah Pengumuman</font></p>
</div>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;"></i> Urus Tadbir Pengguna</button>
<div class="panel">
  <p onMouseDown="window.location='Pengguna.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Pengurusan Pengguna</font></p>
  <p onMouseDown="window.location='TambahPengguna.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Tambah Pengguna</font></p>
</div>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;" ></i>  Laporan</button>
<div class="panel">
  <p onMouseDown="window.location='LaporanJenisUrusanA.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Laporan Mengikut Urusan</font></p>
  <p onMouseDown="window.location='LihatLog.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Laporan Log Sistem</font></p>
</div>
<button class="accordion" onMouseDown="window.location='Petunjuk.php'"> Petunjuk Ikon</button>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    }
}
</script>

</body>
</html>
