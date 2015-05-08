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
if($_REQUEST['admin']=="edit"){

@mysql_query ("update member set m_user = '$_REQUEST[user]',m_pass = '$_REQUEST[pass]' where m_id = '$_SESSION[m_id]'") or die (mysql_error());

@mysql_query ("update employee set e_title = '$_REQUEST[title]',e_name = '$_REQUEST[name]',e_position = '$_REQUEST[position]',e_address = '$_REQUEST[address]',e_email = '$_REQUEST[email]',e_tel = '$_REQUEST[tel]' where m_id = '$_SESSION[m_id]'") or die (mysql_error());
	
  echo "<div id=dialog title=ตรวจสอบการแก้ไขข้อมูล><font color=red size=3>ท่านได้ทำการแก้ไขข้อมูลเรียบร้อย</font></div>";
  
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
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">แก้ไขข้อมูล</div></th>
        </tr>
       
		<form action="?admin=edit" method="post" enctype="multipart/form-data">
       <? $sql = mysql_query ("select * from member where m_id = '$_SESSION[m_id]'");
	   $show = mysql_fetch_assoc ($sql);
	   ?>
	   
        <tr>
          <th width="33%" class="font3" scope="col"><div align="right">Username :</div></th>
          <th width="67%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="user" type="text" class="inputedit" id="user" size="40" required="required" value="<? echo $show[m_user];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Password :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="pass" type="password" class="inputedit" id="pass" size="40" required="required" value="<? echo $show[m_pass];?>" style="padding:5px" />
          </div></th>
        </tr>
		<? $sql2 = mysql_query ("select * from employee where m_id = '$show[m_id]'");
	   $show2 = mysql_fetch_assoc ($sql2);
	   ?>
        <tr>
          <th class="font3" scope="col"><div align="right">คำนำหน้า :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="title" type="radio" value="นาย" required="required" <? if($show2[e_title]=='นาย'){echo 'checked';}?> />
            <span class="font3">นาย
            <label>
            <input name="title" type="radio" value="นาง" required="required" <? if($show2[e_title]=='นาง'){echo 'checked';}?> />
            </label>
นาง
<label>
<input name="title" type="radio" value="นางสาว" required="required" <? if($show2[e_title]=='นางสาว'){echo 'checked';}?> />
</label>
นางสาว</span></div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">ชื่อ-นามสกุล :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="name" type="text" class="inputedit" id="name" size="40" required="required" value="<? echo $show2[e_name];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">ตำแหน่งงาน :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label>
            <select name="position" id="position">
              <option value="1">ครูที่ปรึกษา</option>
            </select>
            </label>
          </div></th>
        </tr>
        <tr>
          <th valign="top" class="font3" scope="col"><div align="right">ที่อยู่ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <textarea name="address" cols="40" rows="5" class="inputedit" id="address" style="padding:5px" required="required"><? echo $show2[e_address];?></textarea>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Email :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="email" type="email" class="inputedit" id="email" size="40" required="required" value="<? echo $show2[e_email];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">เบอร์โทร :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="tel" type="text" class="inputedit" id="tel" size="40" required="required" value="<? echo $show2[e_tel];?>" style="padding:5px" />
          </div></th>
        </tr>
       
        <tr>
          <th scope="col"><div align="right">
              <label>
              <input name="Submit" type="submit" class="submit" value="ยืนยัน" />
              </label>
          </div></th>
          <th colspan="2" scope="col"><div align="left">
              <label>
              <input name="Submit2" type="submit" class="submit" value="ล้างค่า" />
              </label>
          </div></th>
        </tr></form>
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
