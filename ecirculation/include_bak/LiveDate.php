<script>
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
</script>
<link href="../myStyle.css" rel="stylesheet" type="text/css">
Tarikh: 
                      <script>document.write(""+daym+"/"+month+"/"+year+"")</script>
                      Masa: <span id="tP">&nbsp;</span> 
                      <script type="text/javascript">
							function tS(){ x=new Date(); x.setTime(x.getTime()); return x; } 
							function lZ(x){ return (x>9)?x:'0'+x; } 
							function tH(x){ if(x==0){ x=12; } return (x>12)?x-=12:x; } 
							function dT(){ document.getElementById('tP').innerHTML=eval(oT); setTimeout('dT()',1000); } 
							function aP(x){ return (x>11)?'PM':'AM'; } 
							var oT="tH(tS().getHours())+':'+lZ(tS().getMinutes())+':'+lZ(tS().getSeconds())+' '+aP(tS().getHours())";
							if(!document.all){ window.onload=dT; }else{ dT(); }
							</script>
