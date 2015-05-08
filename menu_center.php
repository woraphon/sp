<? 
session_start ();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
	
	<!-- show dialog -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script>
  $(function() {
    $( "#dialog" ).dialog();
  });
  </script>

	
</head>

<body>

<?

include "conn.php";
if($_GET['login']=="chk"){

//สร้างตัวแปรเพื่อรับค่าจาก filed ที่ส่งมา
$user = $_POST ['user'];
$pass = $_POST ['pass'];


//เช็คว่า user กับ pass ที่กรอกเข้ามา มีอยู่ใน db ไหม ถ้าไม่มีให้แจ้งเตือนที่กำหนด
$sql = mysql_query ("select * from member where m_user = '$user' AND m_pass = '$pass'");
$show = mysql_fetch_assoc ($sql);
if (mysql_num_rows($sql)!=1){

echo "<div id=dialog title=ตรวจสอบการเข้าสู่ระบบ><font color=red size=3>กรุณากรอกข้อมูลให้ถูกต้อง!</font></div>";

}

else {

if($show[m_privilege]==1){


if($show[m_status]!=0){

//สร้าง session เพื่อนำไปใช้ และ เข้าสู่ระบบ

$_SESSION['m_user'] = mysql_result($sql, 0, "m_user");
$_SESSION['m_id'] = mysql_result($sql, 0, "m_id");
$_SESSION['m_status'] = mysql_result($sql, 0, "m_status");


echo "<script language=\"javascript\">";
echo "window.location='index.php';";
	echo "</script>";
	
	}
	
else {

//สร้าง session เพื่อนำไปใช้ และ เข้าสู่ระบบ

$_SESSION['a_id'] = mysql_result($sql, 0, "m_id");
$_SESSION['adminn'] = mysql_result($sql, 0, "m_user");


echo "<script language=\"javascript\">";
echo "window.location='admin/manage_admin.php';";
	echo "</script>";
	
	}	
	

}

else {echo "<div id=dialog title=ตรวจสอบการเข้าสู่ระบบ><font color=red size=3>ข้อมูลผู้เข้าระบบนี้ถูกปิดการใช้งานแล้ว!</font></div>";}	

}
}

?>
<? if(!isset($_SESSION['m_id'])){?>
<table width="100%" border="0" align="center">
  
  <tr>
    <th scope="col" style="padding:5px 0px;"><div align="center" class="header2">เข้าสู่ระบบ</div></th>
  </tr>
  <tr>
    <th scope="col" style="padding:15px 0px;">
	 <table width="60%" border="0" align="center">
          <tr>
            <th scope="col" align="center"><fieldset><form id="form1" name="form1" method="post" action="?login=chk" enctype="multipart/form-data">
      <table width="100%" border="0">
        <tr>
          <th width="36%" class="font2" scope="col"><div align="right">Username :</div></th>
          <th width="64%" scope="col"><div align="left">
            <input name="user" type="text" id="user" style="padding:3px;" size="30" required="required" />
          </div></th>
        </tr>
        <tr>
          <th class="font2" scope="col"><div align="right">Password :</div></th>
          <th scope="col"><div align="left">
            <input name="pass" type="password" id="pass" style="padding:3px;" size="30" required="required" />
          </div></th>
        </tr>
		<input type="hidden" name="code_chk" value="<? echo $text;?>" />
        <tr>
          <th scope="col"><div align="right">
            <label>
            <input name="Submit" type="submit" class="submit" value="เข้าสู่ระบบ" />
            </label>
          </div></th>
          <th scope="col"><div align="left">
            <label>
            <input name="Submit2" type="reset" class="submit" value="ล้างค่า" />
            </label>
          </div></th>
        </tr>
      </table>
       
    </form></fieldset></th>
          </tr>
        </table>
    </th>
  </tr>
  <tr>
    <th scope="col" style="padding:0px 0px;">    </th>
  </tr>
</table>
<? } else {?>
<table width="100%" border="0" align="center">
  
  <tr>
    <th scope="col" style="padding:5px 0px;"><div align="center" class="header2">ข่าวประชาสัมพันธ์
    </div></th>
  </tr>
  <tr>
    <th scope="col" style="padding:0px 0px;">
      
	  <fieldset><marquee direction="up" scrolldelay="300" onMouseOut="this.start()" onMouseOver="this.stop()">
	  <? 
// โชว์สินค้าที่อยู่ใน db โดยเรียงลำดับล่าสุดขึ้นก่อน 
 $sql = mysql_query ("select * from news order by id_news desc ");
?>
      <table width="100%" border="0" align="center" style="padding:5px 15px;">
	  <? while ($show = mysql_fetch_assoc ($sql)){?>
        <tr>
		<th width="94%" valign="top" scope="col"><div align="left">
		> <a href="view_news.php?id=<? echo $show[id_news];?>&titles=<? echo $show[title_news];?>" class="link_news" target="_blank"><?= iconv_substr ($show[title_news],0,70,"UTF-8").'...';?></a><br /><span class="font">วันที่ลงข่าว :<?= $show[date_news];?></span></div></th>
        </tr>
		<? }?>
      </table>
      
      <? if(mysql_num_rows($sql)<=0){
		echo "<center>ไม่พบข้อมูล</center><hr>";
		}?>
		</marquee></fieldset>
    </th>
  </tr>
  
</table>

<? }?>
</body>
</html>
