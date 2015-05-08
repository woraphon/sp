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
//อัพเดทสิทธิ์การใช้งาน
if(isset($_REQUEST[id])){
@mysql_query ("update member set m_privilege = '$_REQUEST[privilege]' where m_id = '$_REQUEST[m_id]'") or die (mysql_error());

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
          <th scope="col" style="padding:10px 1px;"><div align="left" class="header2">ออกรายงาน</div></th>
        </tr>
       
		
       
	   
        <tr>
          <th class="font3" scope="col"><form id="form1" name="form1" method="post" action="show_report.php" target="_blank">
            <label>
            ชื่อนักเรียน 
            <select name="m_id" id="m_id">
              <? $sql = mysql_query ("select * from student order by student_id desc");
			while ($show = mysql_fetch_assoc ($sql)){
			
			?>
              <option value="<? echo $show[student_id];?>"><? echo $show[student_name];?></option>
              <? }?>
            </select>
            เดือน
            <select name="month" id="month">
			<? $month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			
			for ($i=0;$i<=11;$i++){
			?>
			<option value="<? echo $month[$i];?>"><? echo $month[$i];?></option><? }?>
            </select>
            </label>
            ปี
            <select name="year" id="year">
                      <? 
			
			$year = date ('Y')+543;
			for ($i=2565;$i>=2530;$i--){
			?>
                      <option value="<? echo $i;?>" <? if($i==$year){echo 'selected';}?>><? echo $i;?></option>
                      <? }?>
                    </select>
                    <label>
                    <input name="Submit" type="submit" class="submit" value="ออกรายงาน" />
                    </label>
          </form>
          </th>
          </tr>
		
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
