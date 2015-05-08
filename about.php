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

	
	
</head>

<body>
<div id="Swap"><div id="Style">
<?  
include "header.php";?>
<table width="100%" border="0">
  <tr>
    <th width="19%" valign="top" scope="col"><? include "menu_left.php";?></th>
    <th width="81%" valign="top" scope="col"><? include "login.php";?>
	<fieldset>
      <table width="100%" border="0">
       
        <? $sql = mysql_query ("select * from manual");
		$show = mysql_fetch_assoc ($sql);
		?>
		
        <tr>
          <th valign="top" class="font3" style="padding:5px 5px;" scope="col" ><div align="left"><? echo $show[detail];?> <center>
          </center></div></th>
          </tr>
		
        <tr>
          <th valign="top" class="font3" scope="col" ><div align="left">
            <label>
            <div align="center">
              <? if(mysql_num_rows($sql)==0){echo 'ยังไม่มีข้อมูล';}?>
            </div>
            </label>
          </div></th>
          </tr>
      </table>
	</fieldset></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
