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

//เช็คว่า user กับ pass ที่กรอกเข้ามา มีอยู่ใน db ไหม
$sql = mysql_query ("select * from project where project = '$_REQUEST[project]'");
if (mysql_num_rows($sql)>0){
echo "<div id=dialog title=ตรวจสอบข้อมูล><font color=red size=3>ชื่อโครงการนี้ซ้ำกับในระบบ!</font></div>";
}

else {

$sql2 = mysql_query ("insert project set p_id = '$_REQUEST[p_id]',project = '$_REQUEST[project]', DESCRIPTION = '$_REQUEST[detail]'") or die (mysql_error());

}	

 echo "<div id=dialog title=ตรวจสอบข้อมูล><font color=red size=3>ทำการเพิ่มโครงการเรียบร้อย!</font></div>";

	}
	 	

	


//แก้ไขข้อมูล

if($_REQUEST['admin']=="update"){

@mysql_query ("update project set project = '$_REQUEST[project]', DESCRIPTION = '$_REQUEST[detail]' where p_id = '$_REQUEST[id]'") or die (mysql_error());


  echo "<div id=dialog title=ตรวจสอบการแก้ไขข้อมูล><font color=red size=3>ทำการแก้ไขข้อมูลเรียบร้อย</font></div>";
  
  }
  


//ลบข้อมูล
if($_REQUEST['admin']=='del'){
@mysql_query ("delete from project where p_id = '$_REQUEST[id]'");

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
          <th colspan="3" scope="col" style="padding:10px 1px;"><div align="left" class="header2">เพิ่มโครงการ</div></th>
        </tr>
        <tr>
          <th colspan="3" scope="col" style="padding:10px;"><div align="left"><font color="#FF0000">*กรุณากรอกข้อมูลให้ครบทุกช่อง</font></div></th>
        </tr>
        <tr>
          <th width="33%" class="font3" scope="col" ><div align="right">ชื่อโครงการ :</div></th>
          <th width="67%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <input name="project" type="text" class="inputedit" id="project"  size="40" required="required" style="padding:5px" />
          </div></th>
        </tr>
        
        <tr>
          <th class="font3" scope="col"><div align="right">รหัสโครงการ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <input name="p_id" type="text" class="inputedit" id="p_id" size="40" required="required" onkeyup="isThaichar(this.value,this)" style="padding:5px" />
          </div></th>
        </tr>
        <tr>
          <th valign="top" class="font3" scope="col"><div align="right">รายละเอียด : </div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <textarea name="detail" cols="50" rows="5" class="inputedit" id="detail" style="padding:5px" required="required"></textarea>
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
        <? $sql = mysql_query ("select * from project where p_id = '$_REQUEST[id]'");
		$show = mysql_fetch_assoc ($sql);
		
		?>
		
        <tr>
          <th class="font3" scope="col" ><div align="right">ชื่อโครงการ :</div></th>
          <th width="69%" colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <label>
            <input name="project" type="text" class="inputedit" id="project" style="padding:5px" value="<? echo $show[project];?>" size="40" required="required" />
            </label>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col"><div align="right">รหัสโครงการ :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
              <? echo $show[p_id];?>
          </div></th>
        </tr>
        <tr>
          <th valign="top" class="font3" scope="col"><div align="right">รายละเอียด :</div></th>
          <th colspan="2" style="padding:3px 3px;" scope="col"><div align="left">
            <textarea name="detail" cols="50" rows="5" class="inputedit" id="detail" style="padding:5px" required="required"><? echo $show[DESCRIPTION];?></textarea>
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
	
	
	
	<table width="100%" border="0">
              <tr>
                <th colspan="5" scope="col"><div align="left"><a href="?admin=add" class="link4">เพิ่มโครงการ++</a></div></th>
              </tr>
              <tr>
                <th width="auto" class="td" scope="col">ลำดับ</th>
                <th width="auto" class="td" scope="col">ชื่อโครงการ</th>
                <th width="-1" class="td" scope="col">รหัสโครงการ</th>
                <th width="-1" class="td" scope="col">ข้อมูลผู้เข้าร่วม</th>
                <th class="td" scope="col">จัดการ</th>
              </tr>
			  <? $sql = mysql_query ("select * from project order by p_id asc ");
			  $i = 1;
			  while ($show = mysql_fetch_assoc ($sql)){
			  ?>
              <tr>
                <th class="font" scope="col"><? echo $i++;?></th>
                <th class="font" scope="col"><? echo $show[project];?></th>
                <th class="font" scope="col"><? echo $show[p_id];?></th>
                <th class="font" scope="col"><a href="view_project.php?id=<? echo $show[p_id];?>" target="_blank">
                  <input name="Input" type="button" class="submit" style="width:40px;" value="คลิก" />
                </a></th>
                <th class="font" scope="col"><a href="?admin=edit&amp;id=<? echo $show[p_id];?>">
                <input type="button" class="submit" style="width:40px;" value="แก้ไข" />
                </a>&nbsp;<a href="?admin=del&amp;id=<? echo $show[p_id];?>" onclick="return confirm ('คุณแน่ใจที่จะลบข้อมูลนี้!');"><input type="button" class="submit" style="width:50px;" value="ลบ" />
                </a></th>
              </tr>
			  <? }?>
              <tr>
                <th colspan="5" scope="col"><? if(mysql_num_rows ($sql)==0){ echo 'ไม่พบข้อมูล!';}?></th>
              </tr>
          </table>
	
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
