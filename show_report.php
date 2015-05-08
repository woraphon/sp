<? 
session_start ();
include "conn.php";	
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
		  
		  <? $sql = mysql_query("select * from student_health s , student d where s.student_id = d.student_id && s.student_id = '$_REQUEST[m_id]' && s_month = '$_REQUEST[month]' && s_year = '$_REQUEST[year]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
            <tr>
              <th colspan="4" bgcolor="#CCCCCC" scope="col"><div align="left" class="font2 style1">ชื่อนักเรียน : <? echo $show[student_name];?> เดือน : <? echo $_REQUEST[month];?> ปี : <? echo $_REQUEST[year];?></div></th>
            </tr>
            <tr>
              <th width="19%" bgcolor="#0099FF" class="style1" scope="col">วัน</th>
              <th width="39%" bgcolor="#0099FF" class="style1" scope="col">รายการที่ตรวจ</th>
              <th width="17%" bgcolor="#0099FF" class="style1" scope="col">คะแนนที่ได้</th>
              <th bgcolor="#0099FF" class="style1" scope="col">วันที่ตรวจ</th>
              </tr>
			  <? $sql2 = mysql_query ("select * from student_health s ,student_health_detail d where s.s_id = d.s_id && s.student_id = '$_REQUEST[m_id]' && s.s_month = '$_REQUEST[month]' && s.s_year = '$_REQUEST[year]' ");
			  while ($show2 = mysql_fetch_assoc ($sql2)){
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
              <th colspan="4" scope="col"><? if(mysql_num_rows($sql)==0){echo 'ไม่พบข้อมูล';} else {?><input name="" type="button" value="พิมพ์" onclick="window.print();" /><? }?></th>
              </tr>
          </table></th>
      </tr>
    </table></fieldset></th>
  </tr>
</table>

</body>
</html>
