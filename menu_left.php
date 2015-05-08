<?
include 'conn.php'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="196" border="0">
  <tr>
    <th scope="col"><div align="left">
	
	  <table width="100%" border="0" align="center">
	  
	  <tr>
          <th scope="col" style="padding:3px 0px;"><div align="left" class="header2"> ><a href="index.php" class="link3"> หน้าแรก</a> </div></th>
          </tr>
		  <? if(!isset($_SESSION['m_id'])){?>
		  <tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="about.php" class="link3">คู่มือการใช้งานระบบ</a></div>        </th>
        </tr>
		
		
		<? } if($_SESSION['m_status']==1) { ?>
		
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="manage_admin.php" class="link3">จัดการข้อมูลผู้ดูแลระบบ</a></div>        </th>
        </tr>
		  <tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="manage_member.php" class="link3">จัดการผู้ใช้งาน</a></div>        </th>
        </tr>
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="manage_webboard.php" class="link3">จัดการระบบเว็บบอร์ด</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="manage_news.php" class="link3">จัดการข่าวสาร</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="search_student.php" class="link3">ค้นหาชื่อนักเรียน</a></div>        </th>
        </tr>
		
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="logout.php" class="link3">ออกจากระบบ</a></div>        </th>
        </tr>
		
       
		
		
        <? }else if($_SESSION['m_status']==2) { ?>
		
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="edit_teacher.php" class="link3">แก้ไขข้อมูลส่วนตัว</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="add_student.php" class="link3">เพิ่มข้อมูลนักเรียน</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="student_health.php" class="link3">บันทึกการตรวจสุขภาพ</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="project_health.php" class="link3">นักเรียนผู้เข้าร่วมโครงการ</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="search_student.php" class="link3">ค้นหาชื่อนักเรียน</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="report_health.php" class="link3">ผลการตรวจสุขภาพของแต่ละคน</a></div>        </th>
        </tr>
		
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="report_health2.php" class="link3">แบบสรุปการตรวจสุขภาพ</a></div>        </th>
        </tr>
		 
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="webboard.php" class="link3">ระบบเว็บบอร์ด</a></div>        </th>
        </tr>
	
		<tr>
          <th style="padding:3px 0px;" scope="col"><div align="left" class="header2"> > <a href="logout.php" class="link3">ออกจากระบบ</a></div>        </th>
        </tr>
		
       
		<? } ?>
		
		
		
		
        <tr>
          <th style="padding:3px 0px;" scope="col"><span style="padding:5px 2px;">
            <embed src=" http://img385.imageshack.us/img385/6408/12ct5.swf" width="200" height="230" wmode="transparent"></embed>
          </span></th>
        </tr>
		<? $sql = mysql_query ("select * from count_page ");
		$show = mysql_fetch_assoc ($sql);
		?>
        <tr>
          <th class="count" style="padding:3px 0px;" scope="col"><img src="img/icon/stat.gif" /> <? echo $show[count];?> </th>
        </tr>
        
      </table>
	
    </div></th>
  </tr>
  
</table>
</body>
</html>
