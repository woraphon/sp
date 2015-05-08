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
		  
		  <? $sql = mysql_query("select * from project where p_id = '$_REQUEST[id]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
            <tr>
              <th colspan="5" bgcolor="#CCCCCC" scope="col"><div align="left" class="font2 style1">ชื่อโครงการ : <? echo $show[project];?> รหัสโครงการ : <? echo $show[p_id];?></div></th>
            </tr>
            <tr>
              <th colspan="5" scope="col"><div align="left" class="style2">ข้อมูลผู้เข้าร่วมโครงการ</div></th>
            </tr>
            <tr>
              <th width="8%" bgcolor="#0099FF" class="style1" scope="col">ลำดับ</th>
              <th width="35%" bgcolor="#0099FF" class="style1" scope="col">ชื่อนักเรียนที่เข้าร่วม</th>
              <th width="18%" bgcolor="#0099FF" class="style1" scope="col">วันที่เข้าร่วม</th>
              <th width="24%" bgcolor="#0099FF" class="style1" scope="col">เดือน</th>
              <th width="15%" bgcolor="#0099FF" class="style1" scope="col">ปี</th>
              </tr>
			  <? $sql2 = mysql_query ("select * from project_detail p , student s ,  student_health d where p.student_id = s.student_id && p.s_id = d.s_id && p.p_id = '$_REQUEST[id]'");
			  $i = 1;
			  while ($show2 = mysql_fetch_assoc ($sql2)){
			  
			  ?>
            <tr>
              <th class="font2" scope="col"><span class="style2"><? echo $i++;?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[student_name];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[date];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[s_month];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[s_year];?></span></th>
              </tr>
			   <? }?>
            
			 
          </table></th>
      </tr>
    </table></fieldset><br /><? if(mysql_num_rows($sql2)==0){echo 'ไม่พบข้อมูล';} else {?>
                <input name="" type="button" value="พิมพ์" onclick="window.print();" />                <? }?></th>
  </tr>
</table>

</body>
</html>
