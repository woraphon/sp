<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
mysql_connect ("localhost","root","1234") or die ('<u><b>ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาตรวจสอบรหัสผ่าน</b></u>');
mysql_select_db ("system_health");
mysql_query ("SET NAMES UTF8");
date_default_timezone_set('Asia/Bangkok');
$title = " ระบบบันทึกการตรวจสุขภาพและการตัดสินใจ ชั้นอนุบาลโรงเรียนบ้านโป่งไหม";

?>

<?
/* mysql_connect ("localhost","design2hou_sp","123456789") or die ('<u><b>ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาตรวจสอบรหัสผ่าน</b></u>');
mysql_select_db ("design2hou_sp");
mysql_query ("SET NAMES UTF8");
date_default_timezone_set('Asia/Bangkok');
$title = " ระบบบันทึกการตรวจสุขภาพและการตัดสินใจ ชั้นอนุบาลโรงเรียนบ้านโป่งไหม"; */
?>




