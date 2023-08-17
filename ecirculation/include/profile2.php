      <link href="../myStyle.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
body {
  margin-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
}
-->
</style>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<table class="table" border="0">
				          <tr bgcolor="#7d1935">
                  <td width="300" height="50" valign="top"><div> <i style="font-size:50px;"></i><font size="3" color="white"><b><?php echo strtoupper($_SESSION["Gelaran"].' '.$_SESSION["NamaPenuh"]);?></b> </font></div></td>
                  <td width="335"><div align="center"><font size="3"><b><?php include '../include/LiveDate.php'; ?></b></font></div></td>
                  <td width="329" valign="top"><div align="right">
                    <a title="Tukar Katalaluan" href="#" onclick="popUpWindow('<?php printf("../TukarPass.php"); ?>',800,200,400,300)"> <font size="4" color="white">| Tukar Katalaluan</a></font>
                    <a title="Daftar Keluar" href="../Logout.php"> <font size="3" color="white">| Daftar Keluar |</font></a> </div></td>
                </tr>
            </table>
