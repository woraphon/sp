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
 <!-- ปฏิทินเลือกวันที่ -->
<link rel="stylesheet" type="text/css" href="jquery-ui-1.7.2.custom/css/smoothness/jquery-ui-1.7.2.custom.css">  
<script type="text/javascript" src="jquery-ui-1.7.2.custom/js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="jquery-ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script>  
<script type="text/javascript">  
$(function(){  
    $("#dateInput").datepicker({  
          dateFormat: 'dd-mm-yy',  
         
//      buttonImage: 'http://jqueryui.com/demos/datepicker/images/calendar.gif',  
        buttonImageOnly: false,  
        changeMonth: true,  
        changeYear: true  
    });  
	
      
        });  
</script>  



</head>

<body>

<? 
if($_REQUEST['admin']=="edit"){

@mysql_query ("update member set m_user = '$_REQUEST[user]',m_pass = '$_REQUEST[pass]' where m_id = '$_SESSION[m_id]'") or die (mysql_error());

@mysql_query ("update student set  student_id = '$_REQUEST[s_id]',student_name = '$_REQUEST[name]',student_birth = '$_REQUEST[birth]',student_sex = '$_REQUEST[sex]',student_class = '$_REQUEST[class]',student_address = '$_REQUEST[address]', student_call = '$_REQUEST[tel]' , e_id = '$_REQUEST[e_id]' where m_id = '$_SESSION[m_id]'") or die (mysql_error());
	
 echo "<script language=\"javascript\">";
	echo "alert('แก้ไขข้อมูลเรียบร้อย!');";
	echo "history.back();";
	echo "</script>";	
  
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
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">แก้ไขข้อมูล</div></th>
        </tr>
       
		<form action="?admin=edit" method="post" enctype="multipart/form-data">
       <? $sql = mysql_query ("select * from member where m_id = '$_SESSION[m_id]'");
	   $show = mysql_fetch_assoc ($sql);
	   
	   $sql2 = mysql_query ("select * from student where m_id = '$show[m_id]'");
	   $show2 = mysql_fetch_assoc ($sql2);
	   ?>
	   
        <tr>
          <th width="33%" class="font3" scope="col"><div align="right">รหัสนักศึกษา :</div></th>
          <th width="67%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="s_id" type="text" class="inputedit" id="s_id" size="20" required="required" value="<? echo $show2[student_id];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Username :</div></th>
          <th width="67%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="user" type="text" class="inputedit" id="user" size="20" required="required" value="<? echo $show[m_user];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Password :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="pass" type="password" class="inputedit" id="pass" size="20" required="required" value="<? echo $show[m_pass];?>" style="padding:5px" />
          </div></th>
        </tr>
		
        <tr>
          <th class="font3" scope="col"><div align="right">ชื่อ-นามสกุล :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="name" type="text" class="inputedit" id="name" size="40" required="required" value="<? echo $show2[student_name];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">วันเกิด :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label></label>
            <input name="birth" type="date" class="inputedit" id="birth"  size="40" required="required" style="padding:5px" value="<? echo $show2[student_birth];?>"/>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">เพศ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label><input name="sex" type="radio" value="ชาย" <? if($show2[student_sex]=='ชาย'){echo 'checked';}?> /></label><span class="font2">ชาย </span>
            <label>
          <input name="sex" type="radio" value="หญิง" <? if($show2[student_sex]=='หญิง'){echo 'checked';}?> /></label>
          <span class="font2">หญิง</span>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">ชั้น :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="class" type="text" class="inputedit" id="class" size="20" required="required" value="<? echo $show2[student_class];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th valign="top" class="font3" scope="col"><div align="right">ที่อยู่ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <textarea name="address" cols="40" rows="5" class="inputedit" id="address" style="padding:5px" required="required"><? echo $show2[student_address];?></textarea>
          </div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">เบอร์โทร :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="tel" type="text" class="inputedit" id="tel" size="20" required="required" value="<? echo $show2[student_call];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">รหัสครูที่ปรึกษา :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <select name="e_id" id="e_id">
              <? $sql3 = mysql_query ("select * from employee order by e_id asc");
							   $num = mysql_num_rows($sql3);
					for ($i=1;$i<=$num;$i++) {
				$show3=mysql_fetch_array($sql3);
				if ($show3[e_id]==$show2[e_id]) {
					$select="selected";
				}else{
					$select="";
	}
	echo "<option value=$show3[e_id] $select>$show3[e_no]&nbsp;$show3[e_name]</option>";
                                }?>
                    </select>
          </div></th>
        </tr>
       
        <tr>
          <th scope="col"><div align="right">
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
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
