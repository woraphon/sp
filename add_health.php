<?php
include "conn.php";
/* start Insert to database *//* ***************************************************************************************** */
$day = array();
$day = $_POST[day];
$description = array();
$description = $_POST[description];
$score = array();
$score = $_POST[score];
$date = array();
$date = $_POST[date];

$date_d = date ('d');
$month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$nMonth = date("n")-1;
$year = date("Y")+543;

$stu = $_REQUEST[m_id];
@mysql_query ("insert student_health set student_id = '$_REQUEST[m_id]',s_day = '$date_d', s_month = '$month[$nMonth]',s_year = '$year' ") or die (mysql_error());

$sql = mysql_query ("select max(s_id) as sid from student_health");
$show = mysql_fetch_assoc ($sql);


//เพิ่มข้อมูลรูปแบบ array
for($s = 0 ; $s < count($day);$s++){
	@mysql_query ("insert student_health_detail set s_id = '$show[sid]',day = '".$day[$s]."',description = '".$description[$s]."',score = '".$score[$s]."',date = '".$date[$s]."',detail = '".$detail[$s]."'") or die (mysql_error());
}

echo "<script language=\"javascript\">";
echo "alert('เพิ่มข้อมูลเรียบร้อย!');";
echo "window.location='student_health.php?return=1&stu=$stu&mount_s=$month[$nMonth]&year_s=$year';";
echo "</script>";


/* End Insert to database *//* ***************************************************************************************** */