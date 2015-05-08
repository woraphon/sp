<? 
session_start ();
include "conn.php";	


//เพิ่มข้อมูล
if($_GET['admin']=='add'){
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];

//ตั้งกระทู้เว็บบอร์ด
$sqlinsert = mysql_query ("insert into webboard (w_topic,w_detail,w_name,w_email,w_tel,w_date,w_time) values ('$topic','$detail','$name','$email','$tel','$date','$time ')") or die (mysql_error());
echo "<script language=\"javascript\">";
						echo "alert(' ตั้งกระทู้เรียบร้อย  หัวข้อกระทู้ คือ $topic ');";
						echo "history.back()";
						echo "</script>";

}



//อัพเดท
if($_GET['admin']=='update'){
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];

$sqlup = mysql_query ("update webboard set w_topic='$topic',w_detail='$detail',w_name='$name',w_email='$email',w_tel='$tel',w_date='$date',w_time='$time' where w_id = '$id'");
if ($sqlup){
echo "<script language=\"javascript\">";
						echo "alert('แก้ไขข้อมูลเรียบร้อย');";
						echo "history.back()";
						echo "</script>";

}

}


if($_GET['comment']=="add"){
$detail = $_POST['detail'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];


//เพิ่มความคิดเห็นลงตารางที่กำหนด โดยมีเงื่อนไขให้ id ของกระทู้ในตาราง = id ของ กระทู้ที่คลิกเข้ามา
$sqlinsert = mysql_query ("insert into comment (w_id,m_detail,m_name,m_email,m_tel,m_date,m_time) values ('$_REQUEST[id]','$detail','$name','$email','$tel','$date','$time ')") or die (mysql_error());
$sqlinsert2 = mysql_query ("update webboard set w_comment = w_comment+1 where w_id = '$_REQUEST[id]'");

echo "<script language=\"javascript\">";
						echo "alert(' ตอบกระทู้เรียบร้อย');";
						echo "history.back();";
						echo "</script>";

}



//ลบข้อมูล โดยรับค่าหน้าเดียวแบบ get ของ กระทู้ webboard
if ($_GET['admin']=="delete"){
$sqldel = mysql_query ("delete from webboard where w_id = '$id'");
if ($sqldel){
echo "<script language=\"javascript\">";
						echo "alert('ลบกระทู้เรียบร้อย');";
						echo "history.back()";
						echo "</script>";

}
}

//ลบข้อมูล โดยรับค่าหน้าเดียวแบบ get ของ comment webboard
if ($_GET['admin']=="delete2"){
$sqldel = mysql_query ("delete from comment where m_id = '$id'");
if ($sqldel){
echo "<script language=\"javascript\">";
						echo "alert('ลบ comment เรียบร้อย');";
						echo "history.back()";
						echo "</script>";
				
						

}
}
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
	
	<? 
	//แสดงข้อมูลที่ต้องการแก้ไข โดยรับค่าหน้าเดียวแบบ get
	if($_REQUEST['admin']=='edit'){?>
	
	<? 
	$sqledit = mysql_query ("select * from webboard where w_id = '$id'");
	$showedit = mysql_fetch_assoc ($sqledit);
	
	?>
<form action="?admin=update&id=<? echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data">
      <table width="100%" align="center" class="table">
            <tr>
              <td colspan="2" class="title">แก้ไขข้อมูล</td>
            </tr>
            <tr>
              <td width="181" class="fontdetail"><div align="right"><span class="fontnewstitle">ID</span></div></td>
              <td width="736"><font color="#FF0000">&nbsp;<?= $showedit['w_id']; ?>
              </font></td>
            </tr>
            <tr>
              <td class="fontdetail"><div align="right" class="fontnewstitle">ชื่อ กระทู้ </div></td>
              <td><label>
                <input name="topic" type="text" class="inputlogin" id="topic" value="<?= $showedit['w_topic']; ?>" size="65"  />
              </label></td>
            </tr>
            <tr>
              <td class="fontdetail"><div align="right" class="fontnewstitle">รายละเอียด </div></td>
              <td rowspan="2"><textarea name="detail" cols="65" rows="5" id="detail"><?= $showedit['w_detail'];?></textarea></td>
            </tr>
            <tr class="fontdetail">
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="fontdetail">ชื่อผู้ตั้งกระทู้</td>
              <td><input name="name" type="text" class="inputlogin" id="name" value="<?= $showedit['w_name']; ?>" size="40"  />
                &nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="fontdetail">Email</td>
              <td><input name="email" type="text" class="inputlogin" id="email" value="<?= $showedit['w_email']; ?>" size="40"  /></td>
            </tr>
            <tr>
              <td align="right" class="fontdetail">Tel</td>
              <td><input name="tel" type="text" class="inputlogin" id="tel" value="<?= $showedit['w_tel']; ?>" size="40"  /></td>
            </tr>
            <tr>
              <td align="right" class="fontdetail">วันที่</td>
              <td><input name="date" type="text" class="inputlogin" id="date" value="<?= $showedit['w_date']; ?>" size="15"  /></td>
            </tr>
            <tr>
              <td align="right" class="fontdetail">เวลา</td>
              <td><input name="time" type="text" class="inputlogin" id="time" value="<?= $showedit['w_time']; ?>" size="15"  /></td>
            </tr>
            <tr>
              <td><label>
                <div align="right">
                  <input name="Submit3" type="submit" class="submit" value="ยืนยัน" />
                </div>
                </label></td>
              <td>
                <label></label>
                <label>
                  <input name="Submit4" type="reset" class="submit" value="ล้างค่า" />
                </label></td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
            <? 
	//แสดง comment ทั้งหมด โดยให้ id comment = id กระทู้
	$sqlcomment = mysql_query ("select * from comment where w_id = '$id'");
	$del = $id;
		while ($comment = mysql_fetch_assoc ($sqlcomment)){
			
		 ?>
            <tr>
              <th scope="col" colspan="2"><div align="left" class="detailview">ชื่อผู้ตอบกระทู้:
                <?= $comment['m_name'];?>
                &nbsp;<a href="?admin=delete2&id=<?= $comment['m_id']; ?>" onclick="return confirm ('ยืนยันการลบ')"><img src="../img/icon/imagess.jpg" width="25" height="20" /></a></div></th>
            </tr>
            <tr>
              <th scope="col" colspan="2"><div align="left" class="detail"><span class="fontdetail">รายละเอียด:&nbsp;</span><br />
              </div></th>
            </tr>
            <tr>
              <th scope="col" colspan="2" class="font2" ><div align="left"><fieldset>
                <?= $comment['m_detail'];?></fieldset>
             </div></th>
            </tr>
            <tr>
              <th scope="col" colspan="2"><div align="left" class="fontdetail">email:
                <?= $comment['m_email'];?>
                เบอร์ติดต่อ:
                <?= $comment['m_tel'];?>
                วันที่ตอบ:
                <?= $comment['m_date'];?>
                เวลา:
                <?= $comment['m_time'];?>
              </div>
                <hr /></th>
            </tr>
            <? }?>
            
        </table>
	  </form>
	  <form action="?comment=add&id=<? echo $_REQUEST[id];?>" method="post"><table width="100%" border="0">
  <tr>
    <td colspan="3" class="title"><label>      </label>ตอบกระทู้</td>
              </tr>
  <tr>
    <td width="154"><div align="right"><span class="font3">ชื่อกระทู้</span></div></td>
    <td colspan="2"><input name="topic2" type="text" class="inputregister" id="topic2" value="<?= $showedit['w_topic'];?>" size="50" readonly="readonly" />
* </td>
  </tr>
              <tr>
                <td><div align="right" class="font3">รายละเอียด</div></td>
                <td width="317" rowspan="2"><div align="left">
                  <textarea name="detail" cols="50" rows="5" class="ckeditor" id="detail" required="required"></textarea>
                </div></td>
                <td width="320"><div align="left">*</div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="320"><div align="left"></div></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">ชื่อผู้ตั้งกระทู้</div></td>
                <td colspan="2"><div align="left">
                    <input required="required" name="name" type="text" class="inputregister" id="name" />
                  *</div></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">Email</div></td>
                <td colspan="2"><div align="left">
                    <input required="required" name="email" type="text" class="inputregister" id="email" />
                  *</div></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">เบอร์ติดต่อ</div></td>
                <td colspan="2"><div align="left">
                    <input required="required" name="tel" type="text" class="inputregister" id="tel"  />
                  *</div></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">วันที่</div></td>
                <td colspan="2"><label>
                    <div align="left">
                      <input name="date" type="text" class="inputregister" id="date" size="15" value="<? echo date ('d-m-Y');?>" readonly="true" />
                    </div>
                  </label></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">เวลา</div></td>
                <td colspan="2"><div align="left">
                    <input name="time" type="text" class="inputregister" id="time" size="15" value="<? echo date ('H:i:s');?>" readonly="true" />
                </div></td>
              </tr>
              <tr>
                <td colspan="3"><label></label></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>
              <tr>
                <td colspan="3"><div align="center">
                    <input name="Submit" type="submit" class="submit" value="ยืนยัน" />
                    <input name="Submit2" type="reset" class="submit" value="ล้างค่า" />
                </div></td>
  </tr>
</table>
</form>
      <? }?>
	
	
	
	
         <table width="100%" align="center">
           <tr>
             <td width="auto" align="center" bgcolor="#999999" class="title" >ลำดับ</td>
             <td width="auto" align="center" bgcolor="#999999" class="title">ชื่อ กระทู้ </td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >ผู้ตั้งกระทู้</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >วันที่ตั้งกระทู้</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >เวลา</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >อ่าน</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >ตอบ</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >แก้ไข</td>
             <td width="auto" align="center" bgcolor="#999999" class="title" >ลบ</td>
           </tr>
           <?
  $number = 1;
 /* check ว่ามี ค่าตัวแปร $start หรือไม่ ถ้าไม่มีให้ตั้งเป็น 0 
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
if(!isset($start)){
$start = 0;
}
$limit = '20'; // แสดงผลหน้าละกี่หัวข้อ
/* หาจำนวน record ทั้งหมด
ปล. อันนี้ต้องใช้กับตัวแบ่งนะ ห้ามเอาออก*/
$Qtotal = mysql_query("select * from webboard"); //คิวรี่ คำสั่ง
$total = mysql_num_rows($Qtotal); // หาจำนวน record

$sql = mysql_query ("select * from webboard  ORDER BY w_id DESC limit $start,$limit ") or die (mysql_error());
$totalp = mysql_num_rows($sql); // หาจำนวน record

echo "<hr />";
if (mysql_num_rows ($sql)==""){
	echo "<center><b>ยังไม่มีรายการ</b></center>";
	}

  while ($show = mysql_fetch_assoc ($sql)){
  ?>
           <tr>
             <td align="center" class="fontdetail"><?= $show['w_id'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_topic'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_name'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_date'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_time'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_read'];?></td>
             <td align="center" class="fontdetail"><?= $show['w_comment'];?></td>
             <td align="center" class="fontdetail"><a href="?admin=edit&amp;id=<?= $show['w_id']; ?>"><img src="../img/icon/button_ok.png" width="22" height="20" /></a></td>
             <td align="center" class="fontdetail"><a href="?admin=delete&amp;id=<?= $show['w_id']; ?>" onclick="return confirm ('ยืนยันการลบ')"><img src="../img/icon/del.jpg" width="25" height="20" /></a></td>
           </tr>
           <? } ?>
           <tr>
             <td colspan="9" align="center"><? /* ตัวแบ่งหน้า */
$page = ceil($total/$limit); // เอา record ทั้งหมด หารด้วย จำนวนที่จะแสดงของแต่ละหน้า

/* เอาผลหาร มาวน เป็นตัวเลข เรียงกัน เช่น สมมุติว่าหารได้ 3 เอามาวลก็จะได้ 1 2 3 */
for($i=1;$i<=$page;$i++){
if($_GET['page']==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้
echo "[<a class=fontnewstitle href='?start=".$limit*($i-1)."&page=$i'><B>$i</B></A>]"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 1
}else{
echo "<span class=fontnewstitle>[<a class=fontnewstitle href='?start=".$limit*($i-1)."&page=$i&admin_menu3'>$i</A>]</span>"; //ลิ้งค์ แบ่งหน้า เงื่อนไขที่ 2
}
}?></td>
           </tr>
           <tr>
             <td colspan="9" align="center"></td>
           </tr>
           <tr>
             <td colspan="9" align="center"><form action="?admin=add" method="post" enctype="multipart/form-data" name="Form1" id="Form1" ><hr />
                  ตั้งกระทู้ ใหม่ (สำหรับ Admin) 
                   <table width="763" align="center">
                   <tr>
                     <td width="126" class="fontdetail"><div align="right"><span class="fontnewstitle">ชื่อ กระทู้ </span> </div></td>
                     <td width="582"><label>
                       <input name="topic" type="text" class="inputlogin" id="topic" size="65" />
                     </label></td>
                   </tr>
                   <tr>
                     <td class="fontdetail"><div align="right"><span class="fontnewstitle">รายละเอียด</span></div></td>
                     <td rowspan="2" ><textarea name="detail" cols="45" rows="5" class="inputlogin" id="detail"></textarea>
                         <label></label></td>
                   </tr>
                   <tr class="fontdetail">
                     <td>&nbsp;</td>
                   </tr>
                   <tr>
                     <td align="right" class="fontdetail">ชื่อผู้ตั้งกระทู้</td>
                     <td><label for="p_color"></label>
                         <label for="p_color"></label>
                         <input name="name" type="text" class="inputlogin" id="name" size="30"></td>
                   </tr>
                   <tr>
                     <td align="right" class="fontdetail" >Email</td>
                     <td><label for="p_status">
                       <input name="email" type="text" class="inputlogin" id="email" size="30">
                     </label></td>
                   </tr>
                   <tr>
                     <td align="right" class="fontdetail" >Tel</td>
                     <td><input name="tel" type="text" class="inputlogin" id="tel" size="30" value="" /></td>
                   </tr>
                   <tr>
                     <td align="right" class="fontdetail" >วันที่</td>
                     <td><input name="date" type="text" class="inputlogin" id="date" size="20" value="<? echo date ('d-m-Y');?>" readonly="readonly" /></td>
                   </tr>
                   <tr>
                     <td align="right" class="fontdetail" >เวลา</td>
                     <td><input name="time" type="text" class="inputlogin" id="time" size="20" value="<? echo date ('H:i:s');?>" readonly="readonly" /></td>
                   </tr>
                   <tr>
                     <td colspan="2"><hr /><label>
                         <div align="center">
                           <input name="Submit2" type="submit" class="submit" value="ยืนยัน" />
                         </div>
                       </label></td>
                   </tr>
                 </table>
                 
             </form></td>
           </tr>
          
         </table>
 </th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
