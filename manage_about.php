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
if($_REQUEST['admin']=="update"){

$sql = mysql_query ("select * from manual where 1");
if(mysql_num_rows($sql)>=1){
@mysql_query ("update manual set detail = '$_REQUEST[detail]'") or die (mysql_error());

echo "<div id=dialog title=ตรวจสอบการแก้ไขข้อมูล><font color=red size=3>ท่านได้ทำการแก้ไขข้อมูลเรียบร้อย</font></div>";

}
else {
@mysql_query ("insert manual set detail = '$_REQUEST[detail]'") or die (mysql_error());

echo "<div id=dialog title=ตรวจสอบการเพิ่มข้อมูล><font color=red size=3>ท่านได้ทำการเพิ่มข้อมูลเรียบร้อย</font></div>";
}	
  
  
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
	<table width="100%" border="0">
        <tr>
          <th scope="col" style="padding:10px 1px;"><div align="left" class="header2">คู่มือการใช้งานระบบ</div></th>
        </tr>
        <? $sql = mysql_query ("select * from manual");
		$show = mysql_fetch_assoc ($sql);
		?>
		
		<form action="?admin=update" method="post" enctype="multipart/form-data">
        <tr>
          <th class="font3" scope="col" ><div align="left">
              <textarea name="detail" id="textarea2" required="required" class="ckeditor"><?= $show['detail'];?>
            </textarea>
              </div></th>
          </tr>
        
       
        <tr>
          <th scope="col" style="padding:5px;"><div align="left">
              <label>
              <input name="Submit" type="submit" class="submit" value="ยืนยัน" />
              </label>
          </div>            <div align="left">
              <label></label>
              </div></th>
          </tr></form>
      </table>
      </fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
