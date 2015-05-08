<? 
session_start ();
include "conn.php";	

if($_REQUEST['project']=='save'){
@mysql_query ("insert project_detail set p_id = '$_REQUEST[p_id]',s_id = '$_REQUEST[s_id]' , student_id = '$_REQUEST[student_id]' , date = now()") or die (mysql_error());
echo "<script language=\"javascript\">";
	echo "alert('บันทึกข้อมูลเรียบร้อย!');";
	echo "history.back();";
	echo "</script>";	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 12px}
-->

/*** SEARCH BUTTON ***/
.submit{
	background:#663300;/* Fallback color for non-css3 browsers */
	border: 0;
	color: #eee;
	cursor: pointer;
	font: 14px Arial, Helvetica, sans-serif;
	font-weight: bold;
	height: 25px;
	margin: 4px 4px 0;
	text-shadow: 0 -1px 0 rgba(0,0,0,.3);
	width: auto;
	outline: none;
	
	/* Rounded Corners */
	border-radius: 5px; 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	/* Shadows */
	box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.4);
	-moz-box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.2);
	-webkit-box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.4);
}

.submit:hover{
	background:#660000;/* Fallback color for non-css3 browsers */
	border: 0;
	color:#FFFFFF;
	cursor: pointer;
	font: 14px Arial, Helvetica, sans-serif;
	font-weight: bold;
	height: 25px;
	margin: 4px 4px 0;
	text-shadow: 0 -1px 0 rgba(0,0,0,.3);
	width: auto;
	outline: none;
	
	/* Rounded Corners */
	border-radius: 5px; 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	/* Shadows */
	box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.4);
	-moz-box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.2);
	-webkit-box-shadow: -1px -1px 1px rgba(255,255,255,.5), 1px 1px 0 rgba(0,0,0,.4);
}
</style>
</head>

<body>
<table width="1000" border="0" align="center">
  <tr>
    <th scope="col"><fieldset><table width="100%" border="0">
      <tr>
        <th scope="col"><table width="100%" border="0">
		  
		  <? $sql = mysql_query("select * from student where student_id = '$_REQUEST[id]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
            <tr>
              <th colspan="4" bgcolor="#CCCCCC" scope="col"><div align="left" class="font2 style1">
                <form id="form2" name="form2" method="post" action="?s=show&id=<? echo $_REQUEST['id'];?>">
                  &nbsp;ชื่อนักเรียน : <? echo $show[student_name];?> เดือน :&nbsp;<? echo $_REQUEST[month];?>                  
						ปี : <? echo $_REQUEST[year];?>
<label></label>

                    </form>
                </div></th>
            </tr>
			
            <tr>
              <th width="19%" bgcolor="#0099FF" class="style1" scope="col">วัน</th>
              <th width="39%" bgcolor="#0099FF" class="style1" scope="col">รายการที่ตรวจ</th>
              <th width="17%" bgcolor="#0099FF" class="style1" scope="col">คะแนนที่ได้</th>
              <th bgcolor="#0099FF" class="style1" scope="col">วันที่ตรวจ</th>
              </tr>
			  <? 
			  $sql = mysql_query ("select * from student_health where student_id = '$_REQUEST[id]' && s_month = '$_REQUEST[month]' && s_year = '$_REQUEST[year]'");
			  
			  $show = mysql_fetch_assoc ($sql);
			  
			  $sql2 = mysql_query ("select * from student_health s ,student_health_detail d where s.s_id = d.s_id && s.student_id = '$_REQUEST[id]' && s.s_month = '$_REQUEST[month]' && s.s_year = '$_REQUEST[year]' ");
			  while ($show2 = mysql_fetch_assoc ($sql2)){
			  $s_id = $show2[s_id];
			  $student_id = $show2[student_id];
			  $total += $show2[score];
			  ?>
            <tr>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[day];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[description];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[score];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[date];?></span></th>
              </tr>
			   <? }?>
            <tr>
              <th colspan="4" class="font2" scope="col"><hr /><div align="right" class="style1">คะแนนรวมทั้งหมด : <? echo $total;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><hr /></th>
              </tr>
			 
            <tr>
              <th colspan="4" scope="col"><div align="left">
               
                <form id="form1" name="form1" method="post" action="?project=save&s_id=<? echo $s_id;?>&id=<? echo $_REQUEST['id'];?>&student_id=<? echo $student_id;?>">
                  
                  <label>
                  <span class="style1">เลือกโครงการที่จะเข้าร่วม</span>
                  <select name="p_id" id="p_id">
				  <? $sql3 = mysql_query ("select * from project");
				  while ($show3 = mysql_fetch_assoc ($sql3)){
				  ?>
				  <option value="<? echo $show3[p_id];?>"><? echo $show3[project];?></option>
				  <? }?>
                  </select>
                  </label>
                  <input name="Submit2" type="submit" class="submit" onclick="return confirm ('ยืนยันการเข้าร่วมโครงการ!');" value="เข้าร่วม!" />
                </form>
                </div></th>
              </tr>
            <tr>
              <th colspan="4" scope="col">&nbsp;</th>
            </tr>
			
          </table></th>
      </tr>
    </table></fieldset></th>
  </tr>
</table>

</body>
</html>
