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

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;" ;"></i> Urus Kertas</button>
<div class="panel">
  <p onmousedown="window.location='ListUrusan3.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Semua Urusan</font></p>
  <p onmousedown="window.location='ListUrusan2.php?stat=baru'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Urusan Baru</font></p>
  <p onmousedown="window.location='ListUrusan2.php?stat=pertimbangan'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Urusan Belum Selesai</font></p>
  <p onmousedown="window.location='ListUrusan2.php?stat=selesai'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Lihat Urusan Selesai</font></p>
</div>

<button class="accordion"><i class="fa fa-plus" style="font-size:10px;" ></i>  Laporan</button>
<div class="panel">
  <p onmousedown="window.location='LaporanJenisUrusanS.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Laporan Mengikut Jenis Urusan</font></p>
  <p onmousedown="window.location='LaporanAktivitiS.php'" style="cursor:pointer"><font size="2" onmouseover="this.color='DeepSkyBlue';" onmouseout="this.color='DarkSlateGray';"><i class="fa fa-bars"></i> Laporan Aktiviti</font></p>
</div>
<button class="accordion" onmousedown="window.location='Petunjuk.php'"> Petunjuk Ikon</button>

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
