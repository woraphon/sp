<? 
session_start ();
include "conn.php";

@mysql_query ("update news set read_news = read_news+1 where id_news = '$_REQUEST[id]'");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $title ;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript">
	
<!-- check ตัวเลข  -->
 function CheckNum(){
		if (event.keyCode < 48 || event.keyCode > 57){
		alert('กรุณากรอกเฉพาะตัวเลข');
		      event.returnValue = false;
	    	}
	}
	
	//กรอกได้เฉพาะตัวอักษ อังกฤษ กับ เลข
 	function isThaichar(str,obj){  
    var orgi_text="abcdefghijklmnopqrstuvwxyz0123456789";
	var str_length=str.length;  
    var str_length_end=str_length-1;  
    var isThai=true;  
    var Char_At="";  
    for(i=0;i<str_length;i++){  
        Char_At=str.charAt(i);  
        if(orgi_text.indexOf(Char_At)==-1){  
            isThai=false;  
        }     
    }  
    if(str_length>=1){  
        if(isThai==false){  
            obj.value=str.substr(0,str_length_end);  
        }  
    }  
    return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด  
}  
	
	</script>	
	
</head>

<body>
<div id="Swap"><div id="Style">
<?  
include "header.php";?>
<table width="100%" border="0">
  <tr>
    <th width="19%" rowspan="2" valign="top" scope="col"><? include "menu_left.php";?></th>
    <th width="81%" valign="top" scope="col"><? include "login.php";?></th>
  </tr>
  <tr>
    <th valign="top" scope="col"><table width="90%" border="0" align="center">
      <tr>
        <th scope="col"><div align="left">
            <h3><? echo $titles;?></h3>
        </div></th>
      </tr>
      <? 
  
 
  $sql = mysql_query ("select * from news where id_news = '$_REQUEST[id]'");
  $i = 1;
  ?>
      <tr>
        <th scope="col"><div align="center">
            <table width="100%" border="0">
              <? $show = mysql_fetch_assoc ($sql);?><tr>
                <th colspan="2" valign="top" scope="col" align="left" style="padding:5px 5px; color:#333333; font-size:16px;"><? echo $show[detail_news];?><br /><br /><hr /><span style="color:#999999; font-size:12px;">วันที่ลงข่าว : <? echo $show[date_news];?>&nbsp;จำนวนผู้อ่าน <? echo $show[read_news];?> คน</span></th>
              </tr>
            </table>
          <? if(mysql_num_rows ($sql)==0){?>
            <center>
              ไม่พบข้อมูล
            </center>
          <? }?>
        </div></th>
      </tr>
    </table></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
