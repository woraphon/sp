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

<?
if($_GET['webboard']=="add"){
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];

//เพิ่มกระทู้ลงตารางที่กำหนด
$sqlinsert = mysql_query ("insert into webboard (w_topic,w_detail,w_name,w_email,w_tel,w_date,w_time) values ('$topic','$detail','$name','$email','$tel','$date','$time ')") or die (mysql_error());
echo "<script language=\"javascript\">";
						echo "alert(' ตั้งกระทู้เรียบร้อย  หัวข้อกระทู้ คือ $topic ');";
						echo "window.location='webboard.php';";
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
          <th colspan="2" scope="col" style="padding: 1px 5px;"><div align="left" class="td">ระบบ Webboard</div></th>
        </tr>
		
       
		
        <tr>
          <th valign="top" scope="col" style="padding: 1px 1px;"><form action="?webboard=add" method="post"><table width="100%" border="0" align="center" >
            <tr>
              <td colspan="3" class="font3" align="left">*กระทู้ทั้งหมด</td>
            </tr>
            <tr>
              <td colspan="3" ><table width="100%" align="left">
                  <tr>
                    <th width="63" scope="col" class="td">ลำดับ</th>
                    <th width="385" scope="col" class="td">ชื่อกระทู้</th>
                    <th width="196" scope="col" class="td">ผู้ตั้งกระทู้</th>
                    <th width="161" class="td" scope="col">วันที่</th>
                    <th width="70" scope="col" class="td">อ่าน</th>
                    <th width="71" scope="col" class="td">ตอบ</th>
                  </tr>
                  <? 
		
		$sqlswb = mysql_query ("select * from webboard order by w_id desc ");
		while ($showwb = mysql_fetch_assoc ($sqlswb)){
		?>
                  <tr>
                    <th scope="col" class="font"><?= $showwb['w_id']; ?></th>
                    <td><div align="left"><b><a class="link" href="view_topic.php?w_id=<?= $showwb['w_id'];?>&w_topic=<?= $showwb['w_topic'];?>">
                        <?= iconv_substr ($showwb['w_topic'], 0,40,"UTF-8"); ?>
                    </a></b></div></td>
                    <th scope="col"><font size="2">
                      <?= $showwb['w_name']; ?>
                    </font></th>
                    <th scope="col" class="font" >
                      <?= $showwb['w_date']; ?>                    </th>
                    <th scope="col" class="font"><?= $showwb['w_read']; ?></th>
                    <th scope="col" class="font"><?= $showwb['w_comment']; ?></th>
                  </tr>
                <? }?>
              </table></td>
            </tr>
            <tr>
              <td colspan="3" >&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" align="left" class="td">ตั้งกระทู้ใหม่</td>
            </tr>
            <tr>
              <td colspan="3" class="fontlogin"><div align="center"><b>
                <? if ($_SESSION['m_id']==""){
	  echo "<font color=red>กรุณาเข้าสู่ระบบเพื่อใช้งานส่วนนี้!!!</font>";
	  }else {?>
              </b></div></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td width="264"><div align="right" class="font3">หัวข้อกระทู้</div></td>
              <td colspan="2"><label>
                  <div align="left">
                    <input required="required" name="topic" type="text" class="inputregister" id="topic" value="" size="50"  />
                    * </div>
                </label></td>
            </tr>
            <tr>
              <td><div align="right" class="font3">รายละเอียด</div></td>
              <td width="437" rowspan="2"><div align="left">
                <textarea name="detail" cols="70" rows="5" class="ckeditor" id="detail" required="required"></textarea>
              </div></td>
              <td width="268"><div align="left">*</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="268"><div align="left"></div></td>
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
                  <input required="required" name="email" type="text" class="inputregister" id="email"  />
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
              <td colspan="2">
                  <div align="left">
                    <input name="date" type="text" class="inputregister" id="date" size="15" value="<? echo date ('d-m-Y');?>" readonly="true" />
                  </div>                </td>
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
            <? }?>
            <tr>
              <td colspan="3"></td>
            </tr>
            <tr>
              <td colspan="3" class="td">&nbsp;</td>
            </tr>
          </table>
		  </form></th>
        </tr>
        <tr>
          <th colspan="2" valign="top" scope="col"><? include "footer.php";?></th>
        </tr>
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
