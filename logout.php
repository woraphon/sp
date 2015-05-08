<?
session_start ();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

if(isset($_SESSION['m_id'])){
unset($_SESSION['m_id']);
session_destroy(); 
}

echo "<script language=\"javascript\">";
echo "window.location='index.php';";
	echo "</script>";
exit;
?>
