<? 
session_start ();
include "conn.php";

//อัพเดทผู้เข้าเว็บ +ทีละ1
@mysql_query ("update count_page set count = count+1 where id = 1") or die (mysql_error());
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
    <th width="81%" valign="top" scope="col"><? include "login.php";?><? include "menu_center.php";?></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
