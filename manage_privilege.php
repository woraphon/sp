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
</head>

<body>

<? 
//อัพเดทสิทธิ์การใช้งาน
if(isset($_REQUEST[id])){
@mysql_query ("update member set m_privilege = '$_REQUEST[privilege]' where m_id = '$_REQUEST[m_id]'") or die (mysql_error());

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
          <th colspan="7" scope="col" style="padding:10px 1px;"><div align="left" class="header2">กำหนดสิทธิ์ผู้ใช้งาน</div></th>
        </tr>
       
		<form action="?admin=edit" method="post" enctype="multipart/form-data">
       
	   
        <tr>
          <th width="auto" class="titelsearch" scope="col">ลำดับ</th>
          <th width="auto" class="titelsearch" scope="col">ชื่อนักเรียน</th>
          <th width="auto" class="titelsearch" scope="col">Username</th>
          <th width="auto"  class="titelsearch" scope="col">เบอร์ติดต่อ</th>
          <th width="auto" class="titelsearch" scope="col">อาจารย์ที่ปรึกษา</th>
          <th width="auto" colspan="2" class="titelsearch" style="padding:3px 3px;" scope="col">สิทธิ์การใช้งาน</th>
        </tr>
		
		     
		
        <tr>
          <th class="font2" scope="col"><? echo $i++;?></th>
          <th class="font2" scope="col"><? echo $show2[student_name];?></th>
          <th class="font2" scope="col"><? echo $show[m_user];?></th>
          <th class="font2" scope="col"><? echo $show2[student_call];?></th>
          <th width="15%" class="font2" scope="col"><? echo $show2[e_name];?></th>
          <th width="8%" colspan="2" class="font2" style="padding:3px 3px;" scope="col"><select name="privilege" id="privilege" OnChange="window.location='?m_id=<? echo $show[m_id];?>&id='+this.value;">
              <option value="1" <? if($show[m_privilege]==1){ echo 'selected';}?>>ใช้งานปกติ</option>
			  <option value="2" <? if($show[m_privilege]==2){ echo 'selected';}?>>ยกเลิกใช้งาน</option>
             
            </select></th>
        </tr>
        
        </form>
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
