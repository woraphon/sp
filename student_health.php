<? 
session_start ();
include "conn.php";	
if($_REQUEST['s']=='save'){
@mysql_query ("update student_health set s_chk = '$_REQUEST[chk]' where s_id = '$_REQUEST[s_id]'") or die (mysql_error());
echo "<script language=\"javascript\">";
	echo "alert('บันทึกข้อมูลเรียบร้อย!');";
	echo "window.location = 'student_health.php?return=1&chk=$_REQUEST[chk]'";
	echo "</script>";	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $title ;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

 

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	
<script type="text/javascript">  
$(function(){  
    $("#addRow").click(function(){  
        $("#myTbl").append($("#firstTr").clone());  
    });  
    $("#removeRow").click(function(){  
        if($("#myTbl tr").size()>1){  
            $("#myTbl tr:last").remove();  
        }else{  
          
        }  
    });     
	});  


</script> 
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
        <tr>
          <th scope="col" style="padding:10px 1px;"><div align="left" class="header2">บันทึกการตรวจสุขภาพของนักเรียน</div></th>
        </tr>
       
		<form action="add_health.php" method="post" enctype="multipart/form-data">
       
	   
        <tr>
          <th class="font3" scope="col" style="padding:3px 10px;"><div align="left">ชื่อนักเรียน : 
            <label>
            <select name="m_id" id="m_id">
			<? $sql = mysql_query ("select * from student order by s_id desc");
			while ($show = mysql_fetch_assoc ($sql)){
			
			?>
			<option value="<? echo $show[student_id];?>"><? echo $show[student_name];?></option>
			<? }?>
            </select>
            </label>
         </th>
          </tr>
        <tr>
          <th class="font3" scope="col"><div align="left"><table width="100%" border="0" id="myTbl">
              <tr id="firstTr">
                <th scope="col"><div align="left"><span class="font3">วันที่ตรวจ : 
                      <select name="day[]" id="day[]">
                          <? 
					$a = array ('จันทร์','อังคาร','พุธ','พฤหัส','ศุกร์');
					for ($i=0;$i<=4;$i++){?>
                          <option value="<? echo $a[$i];?>"><? echo $a[$i];?></option>
                          <? }?>
                          </select>
                  รายการที่ตรวจ 
                  <label>
                  <input name="description[]" type="text" id="description[]" size="20" />
                  </label>
                  คะแนนที่ได้ :
                    <label>
                    <select name="score[]" id="score[]">
                      <? for ($i=1;$i<=3;$i++){?>
                      <option value="<? echo $i;?>"><? echo $i;?></option>
                      <? }?>
                    </select>
                    </label>
                    วันที่ :
                    <label>
                    <input name="date[]" type="date" size="10" id="date[]" required="required" />
                    </label>
                </span><br /><hr />
                <span class="font3">รายละเอียดเพิ่มเติม :</span> <br />
                <textarea name="detail[]" cols="50" rows="5" id="detail[]" required="required"></textarea>
                </div></th>
              </tr>
             
            </table>
          </div></th>
        </tr>
        <tr>
          <th class="font3" scope="col" style="padding:3px 10px;"><hr /><label>
            <input name="Submit" type="submit" class="submit" value="บันทึก" />
          </label></th>
        </tr>
		
        <tr>
          <th class="font3" scope="col">&nbsp;</th>
          </tr>
<!-- form report student ***************************************************************************** -->      
        </form>
      </table>
	</fieldset><br />
	
	<table width="100%" border="0">
		  
		  <? $sql = mysql_query("select * from student where student_id = '$_REQUEST[id]'");
		  $show = mysql_fetch_assoc ($sql);
		  ?>
            <tr>
              <th colspan="4" bgcolor="#CCCCCC" scope="col"><div align="left" class="font2 style1">
                
                </div></th>
            </tr>
<!-- /* ***************************************************************************************** */ -->
			<? if($_REQUEST['return']=='1'){
			if($_REQUEST[chk]=="1"){
			$sw = $_REQUEST[chk];?>
			
            <tr>
              <th width="19%" bgcolor="#0099FF" class="style1" scope="col">วัน</th>
              <th width="39%" bgcolor="#0099FF" class="style1" scope="col">รายการที่ตรวจ</th>
              <th width="17%" bgcolor="#0099FF" class="style1" scope="col">คะแนนที่ได้</th>
              <th bgcolor="#0099FF" class="style1" scope="col">วันที่ตรวจ</th>
            </tr>
			  <? 
			  	  
			  /* ORDER BY RECORD_TIME DESC LIMIT 1 */
			  
			  $sql = mysql_query ("select * from student_health where student_id = '$_REQUEST[id]' && s_month = '$_REQUEST[month]' && s_year = '$_REQUEST[year]'");
			  $show = mysql_fetch_assoc ($sql);
			  
			  $sql2 = mysql_query ("select * from student_health_detail  where s_id order by s_id DESC LIMIT 1 ");
			  /* $sql2 = mysql_query ("select * from student_health s ,student_health_detail d where s.s_id = d.s_id && s.student_id = '$_REQUEST[stu]' "); */
			  while ($show2 = mysql_fetch_assoc ($sql2)){
			  $s_id = $show2[s_id];
			  $total += $show2[score];
			  ?>
            <tr>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[day];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[description];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[score];?></span></th>
              <th class="font2" scope="col"><span class="style2"><? echo $show2[date];?></span></th>
            </tr>
			   <? }?>
            <tr>
              <th colspan="4" class="font2" scope="col"><hr /><div align="right" class="style1">คะแนนรวมทั้งหมด : <? echo $total;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><hr /></th>
            </tr>
			 
            <tr>
              <th colspan="4" scope="col">
              <div align="right">
                <label></label>
                <form id="form1" name="form1" method="post" action="?s=save&s_id=<? echo $s_id;?>&id=<? echo $_REQUEST['id'];?>">
                  <label class="style1">
                  <span class="font">
                  		<input name="chk" type="radio" value="1" <? if($sw==1){echo 'checked';}?> />ผ่าน
                  		<input name="chk" type="radio" value="2" <? if($sw==2){echo 'checked';}?> />ไม่ผ่าน
                  </span>&nbsp;&nbsp;
                  		<input name="Submit2" type="submit" class="submit" value="บันทึก" />
                  </label>
                  <tr>
              		<th colspan="4" scope="col">
              			<? if(mysql_num_rows($sql2)==0)
              					{
              						echo '<font color=red>ไม่พบข้อมูล</font>';
              					} 
              				else 
              					{?>
                					<input name="Input" type="button" class="submit" onclick="window.print();" value="พิมพ์" />
                			<? }?>	
                	</th>
            	</tr>
             	<hr/>
             </form>
             </div>
             	</th>
              </tr>
				  <?} else {
				   if($_REQUEST[chk]==2){
				   	$sw = $_REQUEST[chk];
				   	?>
					<tr>
              			<th width="19%" bgcolor="#0099FF" class="style1" scope="col">วัน</th>
              			<th width="39%" bgcolor="#0099FF" class="style1" scope="col">รายการที่ตรวจ</th>
              			<th width="17%" bgcolor="#0099FF" class="style1" scope="col">คะแนนที่ได้</th>
              			<th bgcolor="#0099FF" class="style1" scope="col">วันที่ตรวจ</th>
              		</tr>
			  <? 
			  $sql = mysql_query ("select * from student_health where student_id = '$_REQUEST[id]' && s_month = '$_REQUEST[month]' && s_year = '$_REQUEST[year]'");
			  $show = mysql_fetch_assoc ($sql);
			  
			  $sql2 = mysql_query ("select * from student_health_detail  where s_id order by s_id DESC LIMIT 1 ");
			  while ($show2 = mysql_fetch_assoc ($sql2))
			  {
			  $s_id = $show2[s_id];
			  $total += $show2[score];
			  ?>
            		<tr>
              			<th class="font2" scope="col"><span class="style2"><? echo $show2[day];?></span></th>
              			<th class="font2" scope="col"><span class="style2"><? echo $show2[description];?></span></th>
              			<th class="font2" scope="col"><span class="style2"><? echo $show2[score];?></span></th>
              			<th class="font2" scope="col"><span class="style2"><? echo $show2[date];?></span></th>
              		</tr>
			
            		<tr>
              			<th colspan="4" class="font2" scope="col"><hr /><div align="right" class="style1">คะแนนรวมทั้งหมด : <? echo $total;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><hr /></th>
              		</tr>
            		<tr>
              			<th colspan="4" scope="col">
              			<div align="right">
                			<form id="form1" name="form1" method="post" action="?s=save&s_id=<? echo $s_id;?>&id=<? echo $_REQUEST['id'];?>">
                  			<label class="style1">
                  				<span class="font">
                  					<input name="chk" type="radio" value="1" <? if($sw==1){echo 'checked';}?> />ผ่าน
                  					<input name="chk" type="radio" value="2" <? if($sw==2){echo 'checked';}?> />ไม่ผ่าน
                  				</span>&nbsp;&nbsp;
                  			</label>
                  			<label>
                  				<input name="Submit2" type="submit" class="submit" value="บันทึก" />
                  			</label>
             				<hr/>
             				</form>
                		</div>
                		</th>
              		</tr>
              		<!-- ส่วนของการเข้าร่วมโครงการ -->
					<tr>
						<th colspan="4" scope="col">
							<div align="right">  
				  				<a href="add_project_health.php?id=<? echo $_REQUEST[id];?>&month=<? echo $_REQUEST['id2'];?>&id3=556677" target="_blank">
				  					<input name="Submit2" type="button" class="submit" value="เข้าร่วมโครงการ!" />
				  				</a>	
				  			</div>
				  		</th>	
         			</tr>
         			<!-- end -->
         			<tr>
              			<th colspan="4" scope="col"><? if(mysql_num_rows($sql2)==0){echo '<font color=red>ไม่พบข้อมูล</font>';} else {?>
                			<input name="Input" type="button" class="submit" onclick="window.print();" value="พิมพ์" />
                		</th>
            		</tr>
            				<?}?>
            		<? }?>
            	<? }?>
			<? } 
			}?>
          </table></th>
  </tr>
</table>
<? include "footer.php";?>
 
</div></div>

</body>
</html>
