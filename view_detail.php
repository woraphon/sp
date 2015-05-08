<? 
session_start ();
include "conn.php";	

if($_REQUEST['s']=='save'){
@mysql_query ("update student_health set s_chk = '$_REQUEST[chk]' where s_id = '$_REQUEST[s_id]'") or die (mysql_error());
echo "<script language=\"javascript\">";
	echo "alert('บันทึกข้อมูลเรียบร้อย!');";
	echo "window.location = 'view_detail.php?s=show&id=$_REQUEST[id]'";
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
                  <label>&nbsp;ชื่อนักเรียน : <? echo $show[student_name];?> เดือน
                  <select name="month" id="month">
                    <? $month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			
			for ($i=0;$i<=11;$i++){
			?>
                    <option value="<? echo $month[$i];?>" <? if($_REQUEST['month']==$month[$i]){echo 'selected';}?>><? echo $month[$i];?></option>
                    <? }?>
                  </select>
                  </label>
ปี
<select name="year" id="year">
  <? 
			
			$year = date ('Y')+543;
			for ($i=2565;$i>=2530;$i--){
			?>
  <option value="<? echo $i;?>" <? if($i==$year){echo 'selected';}?>><? echo $i;?></option>
  <? }?>
</select>
<label>
<input type="submit" name="Submit" value="ออกรายงาน" />
</label>

                                </form>
                </div></th>
            </tr>
			<? if($_GET['s']=='show'){?>
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
              <th colspan="4" scope="col"><div align="right">
                <label></label>
                <form id="form1" name="form1" method="post" action="?s=save&s_id=<? echo $s_id;?>&id=<? echo $_REQUEST['id'];?>">
                  <label class="style1">
                  <input name="chk" type="radio" value="1" <? if($show[s_chk]==1){echo 'checked';}?> />
                  ผ่าน
                  <input name="chk" type="radio" value="2" <? if($show[s_chk]==2){echo 'checked';}?> />
                  ไม่ผ่าน&nbsp;&nbsp;</label>
                  <label>
                  <input type="submit" name="Submit2" value="บันทึก" />
                  </label>
				  <? if($show[s_chk]==2){?><hr /><a href="add_project_health.php?id=<? echo $_REQUEST['id'];?>&month=<? echo $_REQUEST['month'];?>&year=<? echo $_REQUEST['year'];?>&id2=<? echo $show[s_id];?>" target="_blank"><input type="button" name="Submit2" value="เข้าร่วมโครงการ!" /></a><? }?>
                  <label class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
          <hr /></form>
                </div></th>
              </tr>
            <tr>
              <th colspan="4" scope="col"><? if(mysql_num_rows($sql)==0){echo '<font color=red>ไม่พบข้อมูล</font>';} else {?>
                <input name="Input" type="button" value="พิมพ์" onclick="window.print();" />
                <? }?></th>
            </tr>
			<? }?>
          </table></th>
      </tr>
    </table></fieldset></th>
  </tr>
</table>

</body>
</html>
