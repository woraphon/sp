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
          <th scope="col" style="padding:10px 1px;"><div align="left" class="header2">ค้นหาข้อมูลนักเรียน</div></th>
        </tr>
       
		
       
	   
        <tr>
          <th class="font3" scope="col"><form id="form1" name="form1" method="post" action="?search=show">
            <label> ระบุข้อมูลที่ต้องการค้นหา  </label>
            	<select name="position" id="position">
              		<option value="1">รหัสนักเรียน</option>
              		<option value="2">ชื่อนักเรียน</option>
            	</select>
            <label>
            <input name="txt_search" type="text" id="txt_search" style="padding:3px;" size="30" required="required" />
            </label>
                    <label>
                    <input name="Submit" type="submit" class="submit" value="ค้นหา" />
                    </label>
          </form>
          </th>
          </tr>
		
		
		
        <tr>
          <th class="font3" scope="col">
          <? if($_REQUEST['search']=='show'){?>
          <table width="100%" border="0">
            <tr>
              <th width="auto" class="count" scope="col">รหัสนักเรียน</th>
              <th width="auto" class="count" scope="col">ชื่อ-นามสกุล</th>
              <th width="auto" class="count" scope="col">วันเกิด</th>
              <th width="auto" class="count" scope="col">เพศ</th>
              <th width="auto" class="count" scope="col">ระดับชั้น</th>
              <th width="auto" class="count" scope="col">อาจารย์ที่ปรึกษา</th>
              <th width="-1" class="count" scope="col">เบอร์ติดต่อ</th>
              <th width="-1" class="count" scope="col">ข้อมูลสุขภาพ</th>
            </tr>
			  <? $sql = mysql_query ("select * from student where student_id like '%$_REQUEST[txt_search]%' or student_name like '%$_REQUEST[txt_search]%' or student_call like '%$_REQUEST[txt_search]%' order by s_id desc");
			  while ($show = mysql_fetch_assoc ($sql)){
			  
			  $sql2 = mysql_query ("select * from employee where e_id = '$show[e_id]'");
			  
			  $show2 = mysql_fetch_assoc ($sql2);
			  
			  ?>
            <tr>
              <th class="font2" scope="col"><? echo $show[student_id];?></th>
              <th class="font2" scope="col"><? echo $show[student_name];?></th>
              <th class="font2" scope="col"><? echo $show[student_birth];?></th>
              <th class="font2" scope="col"><? echo $show[student_sex];?></th>
              <th class="font2" scope="col"><? echo $show[student_class];?></th>
              <th class="font2" scope="col"><? echo $show2[e_name];?></th>
              <th class="font2" scope="col"><? echo $show[student_call];?></th>
              <th class="font2" scope="col"><a href="view_detail.php?id=<? echo $show[student_id];?>" target="_blank"><input type="button" class="submit" value="คลิก" />
              </a></th>
            </tr>
			<? }?>
            <tr>
              <th colspan="8" class="font2" scope="col"><? if(mysql_num_rows($sql)==0){echo 'ไม่พบข้อมูล';}?></th>
              </tr>
			  
            <tr>
              <th colspan="8" scope="col">&nbsp;</th>
              </tr>
          </table>
		  <? }?>
		  </th>
          </tr>
      
        
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
