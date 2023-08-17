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
</style><table width="954" border="0" cellpadding="0" cellspacing="0" background="images/10241_255.jpg" class="personalinfo">
                <tr>
                  <td width="413" height="19" valign="top"><div>Selamat datang : <?php echo $_SESSION["Gelaran"].' '.$_SESSION["NamaPenuh"];?></div></td>
                  <td width="278" valign="top"><div align="center"><?php include 'include/LiveDate.php'; ?></div></td>
                  <td width="261" valign="top"><div align="right">| <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php"> Keluar sistem </a> |</div></td>
                </tr>
            </table>