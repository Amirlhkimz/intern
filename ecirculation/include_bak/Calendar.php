 <?php
 include 'DatePicker.php';
 
 //Get form and textbox from calling paging
 $frm = $_GET['frm'];
 $txt = $_GET['txt'];
 
 ?>
<html>
<head>
<title>Pilih Tarikh</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<Script Language="JavaScript">

	function getSelDate(SelDate){
		var frm,txt;
		frm = '<?php print "$frm" ?>';
		txt = '<?php print "$txt" ?>';
		
		window.opener.document.forms[frm].elements[txt].value = SelDate;
		window.close();
	} 
</Script>

<style type="text/css">
<!--
.style1 {
	font-family: Arial;
	font-size: 10px;
}
.style2 {
	font-size: 9px;
	font-weight: bold;
}
.style3 {font-size: 12px}
.style7 {font-size: 12px; font-weight: bold; }
-->
</style>
<link href="../Style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-family: Arial;
	font-size: 12px;
}
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../myStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
  <table border="0" cellpadding="0" cellspacing="0" class="blueline">
    <!--DWLayoutTable-->
    <tr>
      <td height="109" valign="top"><div align="center">
          <table width="273" border="0" cellpadding="0" cellspacing="0" class="Section">
            <!--DWLayoutTable-->
            <tr>
              <td width="272" height="99" valign="top"><div align="center" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr class="CalanderHeader" bgcolor="#CCCCCC" >
                      <td width="68" class="CalanderHeader" valign="top">
                        <?php $prevYear = $intYear - 1; 
      print "<a href=Calendar.php?prevYear=$prevYear&prevMonth=$intMonth&frm=$frm&txt=$txt>";
      ?>
                        <div align="right"><img src="../images/leftarrow1.png" width="20" height="20" border="0" align="absmiddle"></div></td>
                      <td width="139" class="CalanderHeader">
                        <div align="center"><?php print"<B>$intYear</B>"; ?></div></td>
                      <td width="69" class="CalanderHeader">
                        <?php $nextYear = $intYear + 1;
      print "<a href=Calendar.php?nextYear=$nextYear&prevMonth=$intMonth&frm=$frm&txt=$txt>";
      ?>
                        <img src="../images/rightarrow1.png" width="20" height="20" border="0" align="absmiddle"></td>
                    </tr>
                  </table>
                </div>
                <div align="center" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="blueline" >
                      <!--DWLayoutTable-->
                      <tr bgcolor="#CCCCCC" >
                        <td width="71" class="CalanderHeader">
                          <?php 
      $prevMonth = $intMonth - 1; 
      if ($prevMonth % 12 == 0){
      	$prevMonth = 12;
     // Old  $intYear = $intYear - 1;
      	$intYear = $intYear;
      }
      
      print "<a href=Calendar.php?prevMonth=$prevMonth&curYear=$intYear&frm=$frm&txt=$txt>";
      ?>
                          <div align="right"><img src="../images/leftarrow1.png" width="20" height="20" border="0" align="absmiddle"> </div></td>
                        <td width="144" class="CalanderHeader">
                          <div align="center"><?php print"<b>$strLongMonth</b>" ?></div></td>
                        <td width="71" class="CalanderHeader">
                          <?php 
      $nextMonth = $intMonth + 1; 
      if ($nextMonth % 12 == 1){
      	$nextMonth = 1;
      	$intYear = $intYear + 1;
      }
	  print "<a href=Calendar.php?nextMonth=$nextMonth&curYear=$intYear&frm=$frm&txt=$txt>";
	  ?>
                          <img src="../images/rightarrow1.png" width="20" height="20" border="0" align="absmiddle"> </td>
                      </tr>
                  </table>
                </div>
                  <div align="center" class="style1">
                    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" class="Section"calander>
                      <tr bgcolor="#CCCCCC" onMouseOver="this.bgColor='#9999FF'" onMouseOut="this.bgColor='#CCCCCC'">
                        <td>
                          <div align="center" class="style2 style3">Ahad</div></td>
                        <td>
                          <div align="center" class="style7">Isnin</div></td>
                        <td>
                          <div align="center" class="style7">Selasa</div></td>
                        <td>
                          <div align="center" class="style7">Rabu</div></td>
                        <td>
                          <div align="center" class="style7"><b>Khamis</b></div></td>
                        <td>
                          <div align="center" class="style7">Jumaat</div></td>
                        <td>
                          <div align="center" class="style7">Sabtu</div></td>
                      </tr>
                      <?php
  for($i=0;$i<6;$i++){
  ?>
                      <tr bgcolor="#CCCCCC" onMouseOver="this.bgColor='#9999FF'" onMouseOut="this.bgColor='#CCCCCC'">
                        <?php
    for($j=0;$j<7;$j++){
    
  ?>
                        <?php if($j==0 || $j==6){
    	print "<td bgcolor=#AECFF0>";
    }else{
    	print "<td bgcolor=#AECFF0>";
    }
    ?>
                        <?php
	    	
	    	if($intAllDays >= $intStartDayOfMonth && $intDays <= $intDayInMonth){
	    $intMonth = $intMonth - 0;
	    $selDate = FormatDate($intYear,$intMonth,$intDays,"DD/MM/YYYY");
		$newDate = new DateTime($selDate);
		$formatted_date=date_format ( $newDate, 'Y-m-d' )	
	   ?>
                        <div align="center">
                          <?php if($j==0 || $j==6){ 
      		print"<a href=# onclick=getSelDate('$formatted_date')><font color=red>$intDays</font></a>"; 
      	}else{
      		if($selDate == $Today){
      			print"<a href=# onclick=getSelDate('$formatted_date')><font color=blue><B>$intDays</B></font></a>"; 
      		}else{
        		print"<a href=# onclick=getSelDate('$formatted_date')>$intDays</a>"; 
        	}
        }
        ?>
                        </div>
                        <?php
	    $intDays = $intDays + 1;
	    }
	    ?>
                        <?php
    $intAllDays = $intAllDays + 1;
    }
   ?>
                      </tr>
                      <?php  
  }
  ?>
                    </table>
                </div></td>
            </tr>
          </table>
      </div></td>
    </tr>
  </table>
</div>
</body>
</html>
