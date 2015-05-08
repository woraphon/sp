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

//เพิ่มข้อมูล
if($_REQUEST['admin']=="insert"){
$user = $_POST ['user'];
$pass1 = $_POST ['pass1'];
$pass2 = $_POST ['pass2'];
$title = $_POST ['title'];
$name = $_POST ['name'];
$position = $_POST ['position'];
$lname = $_POST ['lname'];
$email = $_POST ['email'];
$phone = $_POST ['phone'];

if($pass1 != $pass2){
echo "<div id=dialog title=ตรวจสอบการลงทะเบียน><font color=red size=3>รหัสผ่านของท่านไม่ตรงกัน!</font></div>";

}

else {
//เช็คว่า user กับ pass ที่กรอกเข้ามา มีอยู่ใน db ไหม
$sql = mysql_query ("select * from member where m_user = '$user'");
if (mysql_num_rows($sql)>0){
echo "<div id=dialog title=ตรวจสอบการลงทะเบียน><font color=red size=3>Username นี้ซ้ำกับในระบบ!</font></div>";
}

else {

@mysql_query ("insert member set m_user = '$user',m_pass = '$pass1', m_status = 2,m_privilege = 1 ") or die (mysql_error());

@mysql_query ("insert employee set e_title = '$title',e_name = '$name',e_position = '$position',e_address = '$address',e_email = '$email',e_tel = '$phone'");

}	

 echo "<div id=dialog title=ตรวจสอบการลงทะเบียน><font color=red size=3>ทำการลงทะเบียนเรียบร้อย!</font></div>";

	}}
	 	

	


//แก้ไขข้อมูล

if($_REQUEST['admin']=="update"){
$user = $_POST ['user'];
$pass1 = $_POST ['pass1'];
$title = $_POST ['title'];
$name = $_POST ['name'];
$position = $_POST ['position'];
$email = $_POST ['email'];
$phone = $_POST ['phone'];

@mysql_query ("update member set m_user = '$user',m_pass = '$pass1',m_privilege = '$_REQUEST[privilege]' where m_id = '$_REQUEST[id]'") or die (mysql_error());

@mysql_query ("update employee set e_title = '$title',e_name = '$name',e_position = '$position',e_address = '$address',e_email = '$email',e_tel = '$phone' where m_id = '$_REQUEST[id]'")or die (mysql_error());


  echo "<div id=dialog title=ตรวจสอบการแก้ไขข้อมูล><font color=red size=3>ทำการแก้ไขข้อมูลเรียบร้อย</font></div>";
  
  }
  


//ลบข้อมูล
if($_REQUEST['admin']=='del'){
@mysql_query ("delete from member where m_id = '$_REQUEST[id]'");
@mysql_query ("delete from employee where m_id = '$_REQUEST[id]'");

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
	
	 <? 
	   //เพิ่ม
	   if($_REQUEST['admin']=="add"){
	   ?>
		  <form action="?admin=insert" method="post" enctype="multipart/form-data">
		  <table width="100%" border="0">
        <tr>
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">เพิ่มเจ้าหน้าที่</div></th>
        </tr>
        <tr>
          <th colspan="3" scope="col" style="padding:10px;"><div align="left"><font color="#FF0000">*กรุณากรอกข้อมูลให้ครบทุกช่อง</font></div></th>
        </tr>
        <tr>
          <th width="33%" class="font3" scope="col" ><div align="right">Username :</div></th>
          <th width="67%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="user" type="text" class="inputedit" id="user"  size="40" maxlength="6" required="required" style="padding:5px" />
          </div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">Password :</div></th>
          <th colspan="2" scope="col" style="padding:3px 3px;"><div align="left">
              <input name="pass1" type="password" class="inputedit" id="pass1" size="40" required="required" onkeyup="isThaichar(this.value,this)" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Re-Password :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="pass2" type="password" class="inputedit" id="pass2" size="40" required="required" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">คำนำหน้า :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label>
            <span class="font3">
            <input name="title" type="radio" value="นาย" required="required" />
            </span></label>
            <span class="font3">นาย 
            <label>
            <input name="title" type="radio" value="นาง" required="required" />
            </label>
นาง 
<label>
<input name="title" type="radio" value="นางสาว" required="required" />
</label>
นางสาว</span></div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">ชื่อ-นามสกุล :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="name" type="text" class="inputedit" id="name" size="40" required="required" style="padding:5px" />
          </div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">ตำแหน่ง :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <select name="position" id="position">
              <option value="1">ผู้อำนวยการโรงเรียน</option>
              <option value="2" >เจ้าหน้าที่อนามัย</option>
            </select>
          </div></th>
        </tr>

        <tr>
          <th class="font3" scope="col"><div align="right">Email : </div></th>
          <th colspan="2" scope="col" style="padding:3px 3px;"><div align="left">
              <input name="email" type="email" class="inputedit" id="email"  size="40" required="required" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">เบอร์โทรศ้พทฺ์ :</div>            <div align="right"></div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="phone" type="text" class="inputedit" id="phone" onkeypress="CheckNum()" size="40" required="required" style="padding:5px" />
          </div>            <div align="left">
              <label></label>
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
        </tr>
      </table>
		  </form>
     <? }?>  
	
	
	
	<? if($_REQUEST['admin']=='edit'){?>
	<form action="?admin=update&id=<? echo $_REQUEST['id'];?>" method="post" enctype="multipart/form-data">
      <table width="100%" border="0">
        <tr>
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">แก้ไขข้อมูล</div></th>
        </tr>
        <? $sql = mysql_query ("select * from member where m_id = '$_REQUEST[id]'");
		$show = mysql_fetch_assoc ($sql);
		
		$sql2 = mysql_query ("select * from employee where m_id = '$_REQUEST[id]'");
		$show2 = mysql_fetch_assoc ($sql2);
		?>
		
        <tr>
          <th class="font3" scope="col" ><div align="right">Username :</div></th>
          <th width="69%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label>
            <input name="user" type="text" class="inputedit" id="user" style="padding:5px" value="<? echo $show[m_user];?>" size="40" required="required" />
            </label>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">Password :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="pass1" type="password" class="inputedit" id="pass1" size="40" required="required" value="<? echo $show[m_pass];?>" style="padding:5px" />
          </div></th>
        </tr>
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
          <th class="font3" scope="col"><div align="right">ตำแหน่ง :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <select name="position" id="position">
              <option value="1" <? if($show2[e_position]==1){echo 'selected';}?>>ผู้อำนวยการโรงเรียน</option>
              <option value="2" <? if($show2[e_position]==2){echo 'selected';}?>>เจ้าหน้าที่อนามัย</option>
            </select>
          </div></th>
        </tr>
        

        <tr>
          <th class="font3" scope="col"><div align="right">Email : </div></th>
          <th colspan="2" scope="col" style="padding:3px 3px;"><div align="left">
              <input name="email" type="email" class="inputedit" id="email"  size="40" required="required" value="<? echo $show2[e_email];?>" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">เบอร์โทรศ้พทฺ์ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="phone" type="text" class="inputedit" id="phone" onkeypress="CheckNum()" size="40" required="required" value="<? echo $show2[e_tel];?>" style="padding:5px" />
          </div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">สิทธิ์การใช้งาน :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <select name="privilege" id="privilege">
              <option value="1" <? if($show[m_privilege]==1){echo 'selected';}?>>ใช้งานปกติ</option>
              <option value="2" <? if($show[m_privilege]==2){echo 'selected';}?>>ยกเลิกใช้งาน</option>
            </select>
          </div></th>
        </tr>
        <tr>
          <th scope="col"><div align="right">
              <label>
              <input type="submit" name="Submit" value="ยืนยัน" />
              </label>
          </div></th>
          <th colspan="2" scope="col"><div align="left">
              <label>
              <input type="submit" name="Submit2" value="ล้างค่า" />
              </label>
          </div></th>
        </tr>
      </table>
	  </form>
      <? }?>
	
	
	
	<table width="100%" border="0">
              <tr>
                <th colspan="7" scope="col"><div align="left"><a href="?admin=add" class="link4">เพิ่มเจ้าหน้าที่++</a></div></th>
              </tr>
              <tr>
                <th width="auto" class="td" scope="col">ลำดับ</th>
                <th width="auto" class="td" scope="col">Username</th>
                <th width="auto" class="td" scope="col">Password</th>
                <th width="auto" class="td" scope="col">ชื่อ-นามสกุล</th>
                <th width="auto" class="td" scope="col">ตำแหน่ง</th>
                <th width="auto" class="td" scope="col">สิทธิ์การใช้งาน</th>
                <th width="auto" class="td" scope="col">จัดการ</th>
              </tr>
			  <? $sql = mysql_query ("select * from member m , employee e where m.m_id = e.m_id && m.m_status = 2 order by m.m_id asc ");
			  $i = 1;
			  while ($show = mysql_fetch_assoc ($sql)){
			  ?>
              <tr>
                <th class="font" scope="col"><? echo $i++;?></th>
                <th class="font" scope="col"><? echo $show[m_user];?></th>
                <th class="font" scope="col"><? echo $show[m_pass];?></th>
                <th class="font" scope="col"><? echo $show[e_name];?></th>
                <th class="font" scope="col"><? if($show[m_status]==1){echo 'ผู้ดูแลระบบ';} else if($show[m_status]==2){echo 'เจ้าหน้าที่';}?></th>
				
                <th class="font" scope="col"><? if($show[m_privilege]==1){echo '<font color=blue>ใช้งานปกติ</font>';} else {echo '<font color=red>ยกเลิกใช้งาน</font>';}?></th>
                <th class="font" scope="col"><a href="?admin=edit&amp;id=<? echo $show[m_id];?>">
                <input type="button" class="submit" value="แก้ไข" /></a>&nbsp;<a href="?admin=del&amp;id=<? echo $show[m_id];?>" onclick="return confirm ('คุณแน่ใจที่จะลบข้อมูลนี้!');"><input type="button" class="submit" value="ลบ" />
                </a></th>
              </tr>
			  <? }?>
              <tr>
                <th colspan="7" scope="col"><? if(mysql_num_rows ($sql)==0){ echo 'ไม่พบข้อมูล!';}?></th>
              </tr>
          </table>
	
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
