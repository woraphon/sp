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
if($_GET['comment']=="add"){
$detail = $_POST['detail'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];


//เพิ่มความคิดเห็นลงตารางที่กำหนด โดยมีเงื่อนไขให้ id ของกระทู้ในตาราง = id ของ กระทู้ที่คลิกเข้ามา
$sqlinsert = mysql_query ("insert into comment (w_id,m_detail,m_name,m_email,m_tel,m_date,m_time) values ('$w_id','$detail','$name','$email','$tel','$date','$time ')") or die (mysql_error());
$sqlinsert2 = mysql_query ("update webboard set w_comment = w_comment+1 where w_id = '$w_id'");

echo "<script language=\"javascript\">";
						echo "alert(' ตอบกระทู้เรียบร้อย');";
						echo "history.back();";
						echo "</script>";

}


$sql = mysql_query ("select * from webboard where w_id = '$w_id'");
 $board = mysql_fetch_assoc ($sql);
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
          <th colspan="2" scope="col" style="padding: 1px 5px;"><div align="left" class="td">หัวข้อกระทู้ <b>
            <?= $board['w_topic'];?>
          </b></div></th>
          </tr>
		
       
		
        <tr>
          <th valign="top" scope="col" style="padding: 1px 1px;"><form action="?comment=add&w_id=<?= $w_id;?>" method="post">
            <table width="100%" border="0" align="center" >
              <tr>
                <td colspan="3"  style="padding:5px 3px;"><span class="td">เขียนโดย:
                  <?= $board['w_name'];?>
                                </span></td>
              </tr>
              
              <tr>
                <td colspan="3" align="left" style="padding:2px 2px;" ></td>
              </tr>
              <tr>
                <td colspan="3" align="left" style="padding:2px 2px;" class="font3" >&nbsp;<b><?= $board['w_detail'];?></b>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="font-size:18px; padding:1px 2px;" align="left"><hr color="#333333" />
                  <span class="font3">&nbsp;email:
                  <?= $board['w_email'];?>
                  เบอร์ติดต่อ:
                  <?= $board['w_tel'];?>
                  วันที่:
                  <?= $board['w_date'];?>
&nbsp;เวลา:
<?= $board['w_time'];?> น.
</span>
                  <hr color="#333333" /></td>
              </tr>
              <? $sqlcomment = mysql_query ("select * from comment where w_id = '$w_id'");
		while ($comment = mysql_fetch_assoc ($sqlcomment)){
		 ?>
              <tr>
                <td colspan="3" style="padding:5px 2px;" align="left" ><span class="titelsearch">ผู้ตอบกระทู้:
                  <?= $comment['m_name'];?>
                </span></td>
              </tr>
              
              <tr>
                <td colspan="3" align="left"class="font3" > &nbsp;
                      <?= $comment['m_detail'];?>
                </td>
              </tr>
              <tr>
                <td colspan="3" align="left" style="font-size:18px;" ><hr color="#333333" />
                  <span class="font3">&nbsp;email:<?= $comment['m_email'];?>
                  เบอร์ติดต่อ:<?= $comment['m_tel'];?>
                  วันที่:<?= $comment['m_date'];?> 
                  เวลา:<?= $comment['m_time'];?> น.
</span>
                  <hr color="#333333" /></td>
              </tr>
              
              <? }?>
              <tr>
                <td colspan="3" class="td">ตอบกระทู้</td>
              </tr>
              <tr>
                <td colspan="3" class="fontlogin"><div align="center"><b>
                  <? if ($_SESSION['m_user']==""){
	  echo "กรุณาเข้าสู่ระบบเพื่อใช้งานส่วนนี้!!!<br>หรือ <a href='../register.php' class='detailview'>สมัครสมาชิกใหม่</a> ";
	  }else {?>
                </b></div></td>
              </tr>
              <tr>
                <td width="272"><div align="right" class="font3">ชื่อกระทู้</div></td>
                <td colspan="2"><label>
                    <div align="left">
                      <input name="topic" type="text" class="inputregister" id="topic" value="<?= $board['w_topic'];?>" size="50" readonly="readonly">
                      * </div>
                  </label></td>
              </tr>
              <tr>
                <td><div align="right" class="font3">รายละเอียด</div></td>
                <td width="407" rowspan="2"><div align="left">
                  <textarea name="detail" cols="70" rows="5" class="ckeditor" id="detail" required="required"></textarea>
                </div></td>
                <td width="295"><div align="left">*</div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="295"><div align="left"></div></td>
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
                    <input name="Submit" type="submit" class="button" value="ยืนยัน" />
                    <input name="Submit2" type="reset" class="button" value="ล้างค่า" />
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
          <th colspan="2" valign="top" scope="col">&nbsp;</th>
        </tr>
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
