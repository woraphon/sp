<? 
session_start ();
include "conn.php";	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $title ;?></title>
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
  
  <!-- เรียกใช้ cheditor-->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>  
</head>

<body>

<? 
if($_REQUEST['admin']=="insert"){
$date = date ('d-m-Y');
@mysql_query ("insert news set title_news = '$_REQUEST[title]',detail_news = '$_REQUEST[title]',date_news = '$date'") or die (mysql_error());
	
  echo "<div id=dialog title=ตรวจสอบข้อมูล><font color=red size=3>ท่านได้ทำการเพิ่มข้อมูลเรียบร้อย
  </font></div>";
  
}




if($_REQUEST['admin']=="update"){
@mysql_query ("insert news set title_news = '$_REQUEST[title]',detail_news = '$_REQUEST[title]' where id_news = '$_REQUEST[id]'") or die (mysql_error());
	
  echo "<div id=dialog title=ตรวจสอบการแก้ไขข้อมูล><font color=red size=3>ท่านได้ทำการแก้ไขข้อมูลเรียบร้อย</font></div>";
  
}



if($_REQUEST['admin']=='del'){
@mysql_query ("delete from news where id_news = '$_REQUEST[id]'");

}
?>

<div id="Swap"><div id="Style">
<?  
include "header.php";?>
<table width="100%" border="0">
  <tr>
    <th width="19%" valign="top" scope="col"><? include "menu_left.php";?></th>
    <th width="81%" valign="top" scope="col"><? include "login.php";?>
	<fieldset>
	
	 <? 
	   //เพิ่ม
	   if($_REQUEST['admin']=="add"){
	   ?>
		  <table width="100%" border="0">
        <tr>
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">เพิ่มข่าวสาร</div></th>
        </tr>
        <? $sql = mysql_query ("select * from news where id_news = '$_REQUEST[id]'");
		$show = mysql_fetch_assoc ($sql);
		?>
		
		<form action="admin/?admin=update&amp;id=<? echo $_REQUEST[id];?>" method="post" enctype="multipart/form-data">
       
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">หัวข้อข่าว :</div>            <div align="left"></div></th>
          </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">
            <input name="title" type="text" class="inputedit" id="title" size="100" required="required" value="" style="padding:5px" />
          </div>            
            <div align="left"></div></th>
          </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">รายละเอียด</div></th>
        </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">
            <textarea name="detail" id="detail" class="ckeditor" required="required"></textarea>
          </div></th>
        </tr>
       
       
        <tr>
          <th width="32%" scope="col"><div align="right">
              <label>
              <input name="Submit" type="submit" class="submit" value="ยืนยัน" />
              </label>
          </div></th>
          <th colspan="2" scope="col"><div align="left">
              <label>
              <input name="Submit2" type="submit" class="submit" value="ล้างค่า" />
              </label>
          </div></th>
        </tr></form>
      </table>
     <? }?>  
	
	
	
	<? if($_REQUEST['admin']=='edit'){?>
      <table width="100%" border="0">
        <tr>
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">แก้ไขข้อมูล</div></th>
        </tr>
        <? $sql = mysql_query ("select * from news where id_news = '$_REQUEST[id]'");
		$show = mysql_fetch_assoc ($sql);
		?>
		
		<form action="admin/?admin=update&amp;id=<? echo $_REQUEST[id];?>" method="post" enctype="multipart/form-data">
       
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">หัวข้อข่าว :</div>            <div align="left"></div></th>
          </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">
            <input name="user2" type="text" class="inputedit" id="user2" size="100" required="required" value="<? echo $show[title_news];?>" style="padding:5px" />
          </div>            
            <div align="left"></div></th>
          </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">รายละเอียด</div></th>
        </tr>
        <tr>
          <th colspan="3" class="font3" scope="col"><div align="left">
            <textarea name="detail" id="detail" class="ckeditor" required="required"><? echo $show[detail_news];?></textarea>
          </div></th>
        </tr>
       
       
        <tr>
          <th width="32%" scope="col"><div align="right">
              <label>
              <input name="Submit" type="submit" class="submit" value="ยืนยัน" />
              </label>
          </div></th>
          <th colspan="2" scope="col"><div align="left">
              <label>
              <input name="Submit2" type="submit" class="submit" value="ล้างค่า" />
              </label>
          </div></th>
        </tr></form>
      </table>
      <? }?>
	
	
	
	<table width="100%" border="0">
              <tr>
                <th colspan="5" scope="col"><div align="left"><a href="?admin=add" class="link4">เพิ่มข่าวสาร++</a></div></th>
              </tr>
              <tr>
                <th width="9%" class="td" scope="col">ลำดับ</th>
                <th width="27%" class="td" scope="col">หัวข้อข่าว</th>
                <th width="28%" class="td" scope="col">วันที่ลงข่่าว</th>
                <th width="20%" class="td" scope="col">ผู้อ่าน</th>
                <th width="16%" class="td" scope="col">จัดการ</th>
              </tr>
			  <? $sql = mysql_query ("select * from news order by id_news asc ");
			  $i = 1;
			  while ($show = mysql_fetch_assoc ($sql)){
			  ?>
              <tr>
                <th class="font" scope="col"><? echo $i++;?></th>
                <th class="font" scope="col"><? echo $show[title_news];?></th>
                <th class="font" scope="col"><? echo $show[date_news];?></th>
                <th class="font" scope="col"><? echo $show[read_news];?></th>
                <th class="font" scope="col"><a href="?admin=edit&amp;id=<? echo $show[id_news];?>">
                <input type="button" class="submit" value="แก้ไข" /></a>&nbsp;<a href="?admin=del&amp;id=<? echo $show[id_news];?>" onclick="return confirm ('คุณแน่ใจที่จะลบข้อมูลนี้!');"><input type="button" class="submit"  value="ลบ" />
                </a></th>
              </tr>
			  <? }?>
              <tr>
                <th colspan="5" scope="col">&nbsp;</th>
              </tr>
          </table>
	
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
