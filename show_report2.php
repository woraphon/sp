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
<table width="650" border="0" align="center">
  <tr>
    <th scope="col"><fieldset><table width="100%" border="0">
      <tr>
        <th scope="col"><table width="100%" border="1" style="border:1px solid #000000;">
		 
            <tr>
              <th colspan="2" bgcolor="#CCCCCC" scope="col"><div align="center" class="font2 style1">แบบสรุปการตรวจสุขภาพนักเรียน</div></th>
            </tr>
            <tr>
              <th colspan="2" bgcolor="#CCCCCC" class="style1" scope="col">ปีการศึกษา <? echo $_REQUEST['year'];?></th>
            </tr>
            <tr>
              <th width="40%" bgcolor="#0099FF" class="style1" scope="col">เดือน</th>
              <th width="60%" bgcolor="#0099FF" class="style1" scope="col">นักเรียนสุขภาพดี (ร้อยละ) </th>
              </tr>
			  
			  <? 
			  //หาจำนวนนักเรียนทั้งหมด
			  $s = mysql_query ("select * from student");
			  $row = mysql_num_rows ($s);
			  
			  $sql = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'มกราคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show = mysql_fetch_assoc ($sql)){
			  $score += $show[score];
			  $total = $score * $row / 100 ;
			  }
			  
			  $sql2 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'กุมภาพันธ์' && s.s_year = '$_REQUEST[year]'");
			  while ($show2 = mysql_fetch_assoc ($sql2)){
			  $score2 += $show2[score];
			  $total2 = $score2 * $row / 100 ;
			  }
			  
			  $sql3 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'มีนาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show3 = mysql_fetch_assoc ($sql3)){
			  $score3 += $show3[score];
			  $total3 = $score3 * $row / 100 ;
			  }
			  
			  $sql4 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'เมษายน' && s.s_year = '$_REQUEST[year]'");
			  while ($show4 = mysql_fetch_assoc ($sql4)){
			  $score4 += $show4[score];
			  $total4 = $score4 * $row / 100 ;
			  }
			  
			  $sql5 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'พฤษภาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show5 = mysql_fetch_assoc ($sql2)){
			  $score5 += $show5[score];
			  $total5 = $score5 * $row / 100 ;
			  }
			  
			  $sql6 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'มิถุนายน' && s.s_year = '$_REQUEST[year]'");
			  while ($show6 = mysql_fetch_assoc ($sql6)){
			  $score6 += $show6[score];
			  $total6 = $score6 * $row / 100 ;
			  }
			  
			  $sql7 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'กรกฏาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show7 = mysql_fetch_assoc ($sql7)){
			  $score7 += $show7[score];
			  $total7 = $score7 * $row / 100 ;
			  }
			  
			  $sql8 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'สิงหาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show8 = mysql_fetch_assoc ($sql8)){
			  $score8 += $show8[score];
			  $total8 = $score8 * $row / 100 ;
			  }
			  
			  $sql9 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'กันยายน' && s.s_year = '$_REQUEST[year]'");
			  while ($show9 = mysql_fetch_assoc ($sql9)){
			  $score9 += $show9[score];
			  $total9 = $score9 * $row / 100 ;
			  }
			  
			  $sql10 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'ตุลาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show10 = mysql_fetch_assoc ($sql10)){
			  $score10 += $show10[score];
			  $total10 = $score10 * $row / 100 ;
			  }
			  
			  $sql11 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'พฤศจิกายน' && s.s_year = '$_REQUEST[year]'");
			  while ($show11 = mysql_fetch_assoc ($sql11)){
			  $score11 += $show11[score];
			  $total11 = $score11 * $row / 100 ;
			  }
			  
			  $sql12 = mysql_query ("select * from student_health s , student_health_detail d where s.s_id = d.s_id && s.s_month = 'ธันวาคม' && s.s_year = '$_REQUEST[year]'");
			  while ($show12 = mysql_fetch_assoc ($sql12)){
			  $score12 += $show12[score];
			  $total12 = $score12 * $row / 100 ;
			  }
			  
			  
			  //รวมผล
			  $score_total = $score + $score2 + $score3 + $score4 + $score5 + $score6 +$score7 +$score8 + $score9 + $score10 + $score11 + $score12;
			  
			  $score_total2 = $total + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12;
			  
			  ?>
			  
            <tr>
              <th class="style2" scope="col">มกราคม 2558 <span class="style2"></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $total;?></span></th>
              </tr>
            <tr>
              <th class="style2" scope="col">กุมภาพันธ์ 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total2;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">มีนาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total3;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">เมษายน 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total4;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">พฤษภาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total5;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">มิถุนายน 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total6;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">กรกฏาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total7;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">สิงหาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total8;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">กันยายน 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total9;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">ตุลาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total10;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">พฤศจิกายน 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total11;?></span></th>
            </tr>
            <tr>
              <th class="style2" scope="col">ธันวาคม 2558</th>
              <th class="font2" scope="col"><span class="style2"><? echo $total12;?></span></th>
            </tr>
			 
            <tr>
              <th bgcolor="#CCCCCC" class="style1" scope="col">รวมทั้งปี</th>
              <th bgcolor="#CCCCCC" class="style1" scope="col"><? echo $score_total;?></th>
            </tr>
            <tr>
              <th bgcolor="#CCCCCC" class="style1" scope="col">เฉลี่ยทั้งปี</th>
              <th bgcolor="#CCCCCC" class="style1" scope="col"><? echo number_format ($score_total2,2);?></th>
            </tr>
			
          </table></th>
      </tr>
    </table></fieldset><br /><input name="" type="button" value="พิมพ์" onclick="window.print();" /></th>
  </tr>
</table>

</body>
</html>
