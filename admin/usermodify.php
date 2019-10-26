<?php
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../3/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../js/timer.js"></script>
<script language="javascript" src="../js/gg.js"></script>
<script>
function  checkform(){ 
//定义正则表达式部分
var strP=/^\d+$/;
if(!strP.test(document.myform.totleRMB.value)) {
alert("充值数必需为数字！"); 
document.myform.imgwidth.focus(); 
return false; 
}
if(!strP.test(document.myform.elite.value)) {
alert("推荐值必需为数字！"); 
document.myform.elite.focus(); 
return false; 
}
if(document.myform.qq.value!="" && !strP.test(document.myform.qq.value)) {
alert("QQ只能填数字！"); 
document.myform.qq.focus(); 
return false; 
}   
}
</script> 
</head>
<body>
<?php
$action = isset($_POST['action'])?$_POST['action']:"";
$id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
checkid($id,1);

$FoundErr=0;
	$sql="select * from zzcms_user where id='$id'";
	$rs=query($sql);
	$row=num_rows($rs);
	if (!$row){
	$FoundErr=1;
	$errmsg=$errmsg . "<li>找不到指定的用户！</li>";
	}else{
		$row=fetch_array($rs);
		if ($action=="modify") {
		checkadminisdo("user_modify");
			$b=@trim($_POST["b"]);//有未设值的情况
			$s=@trim($_POST["s"]);//有未设值的情况
			$qqid = isset($_POST['qqid'])?$_POST['qqid'][0]:0;
		
			if ($elite==""){
			$elite=0;
			}elseif($elite>127){
			$elite=127;	
			}elseif ($elite<0){
			$elite=0;
			}
			checkid($elite,1);
			checkstr($img,"upload");//入库前查上传文件地址是否合格
			checkstr($oldimg,"upload");
			if ($FoundErr==0){
			query("update zzcms_user set usersf='$usersf',sex='$sex',email='$email',homepage='$homepage',comane='$comane',content='$gsjj',
			img='$img',flv='$flv',bigclassid='$b',smallclassid='$s',address='$address',somane='$somane',phone='$phone',	
			mobile='$mobile',fox='$fox',qq='$qq',passed='$passed',renzheng='$renzheng',lockuser='$lockuser',
			groupid='$groupid',totleRMB='$totleRMB',startdate='$startdate',enddate='$enddate',elite='$elite' where id='$id' ");	
				
				if ($password!="") {
				query("update zzcms_user set password='".md5($password)."',passwordtrue='$password' where id='$id' ");
				}
				if ($qqid==0) {
				query("update zzcms_user set qqid='' where id='$id' ");
				}
				if ($groupid!=$oldgroupid){
					query("update zzcms_main set groupid=" . $groupid . " where editor='" . $row["username"] . "'");	
				}
				if ($qq<>$oldqq) {
				query("update zzcms_main set qq='" . $qq . "' where editor='" . $row["username"] . "'");
				}
				if ($comane<>$oldcomane){
				query("update zzcms_main set comane='" . $comane ."' where editor='" . $row["username"] . "'");
				}
				if ($renzheng<>$oldrenzheng) {
				query("update zzcms_main set renzheng=" . $renzheng . " where editor='" . $row["username"] . "'");
				}
				
				if ($oldimg<>$img && $oldimg<>"/image/nopic.gif"){
				$f='../'.substr($oldimg,1);
				if (file_exists($f)){
				unlink($f);
				}
				$fs='../'.substr(str_replace(".","_small.",$oldimg),1);
				if (file_exists($fs)){
				unlink($fs);		
				}
				}
				echo "<script>alert('修改成功');location.href='?id=$id'</script>";				
			}
		}
	}
	
if ($FoundErr==1) {
WriteErrMsg($errmsg);
}else{
?>
<div class="admintitle">修改注册用户信息</div>
<FORM name="myform" action="?" method="post" onSubmit="return checkform()">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr> 
      <td height="30" colspan="2" class="admintitle2">用户信息</td>
    </tr>
    <tr> 
      <td width="20%" align="right" class="border">用户名</td>
      <td width="80%" class="border"><?php echo $row["username"]?></td>
    </tr>
    <tr> 
      <td align="right" class="border">密码</td>
      <td class="border"> <input name="password"  type="text"  size="30" maxLength="16">
        (如不改密码，这里空出) </td>
    </tr>
    <tr> 
      <td align="right" class="border">联系人</td>
      <td class="border"> <input name="somane" value="<?php echo $row["somane"]?>" size="30" maxLength="50"></td>
    </tr>
    <tr> 
      <td align="right" class="border">性别</td>
      <td class="border"> <label><input type="radio" value="1" name="sex" <?php if ($row["sex"]==1) { echo "checked";}?>>
        男</label> 
        <label><input type="radio" value="0" name="sex" <?php if ($row["sex"]==0 ){ echo "checked";}?>>
        女</label></td>
    </tr>
    <tr> 
      <td align="right" class="border">手机</td>
      <td class="border"><input name=mobile id="mobile" value="<?php echo $row["mobile"]?>" size="30" maxLength="50"></td>
    </tr>
    <tr> 
      <td align="right" class="border">E-mail</td>
      <td class="border"> <input name="email" value="<?php echo $row["email"]?>" size="30" maxLength="50">      </td>
    </tr>
    <tr> 
      <td align="right" class="border">QQ</td>
      <td class="border"><input name="qq" id="qq" value="<?php echo $row["qq"]?>" size="30" maxLength="50"> 
        <input name="oldqq" type="hidden" id="oldqq" value="<?php echo $row["qq"]?>"></td>
    </tr>
    <tr> 
      <td align="right" class="border">QQ绑定登录网站</td>
      <td class="border"> 
        <?php 
	  if ($row["qqid"]<>""){
		  ?>
       <label> <input name="qqid[]" type="checkbox" id="qqid[]" value="1" checked>
        (已绑定。点击可取消绑定) </label>
        <?php
		}else{
		echo "未绑定QQ登录";
		}
		?>      </td>
    </tr>
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"><input name="Submit2"   type=submit id="Submit2" value="保存修改结果"></td>
    </tr>
    <tr> 
      <td colspan="2" class="admintitle2">公司信息</td>
    </tr>
    <tr> 
      <td align="right" class="border">所属行业类型</td>
      <td class="border"> 
	  <?php
$sqln = "select classid,classname from zzcms_userclass where parentid<>'0' order by xuhao asc";
$rsn=query($sqln);
?>
<script language = "JavaScript" type="text/JavaScript">
var onecount;
subcat = new Array();
<?php 
$count = 0;
        while($rown = fetch_array($rsn)){
        ?>
subcat[<?php echo $count?>] = new Array("<?php echo trim($rown["classname"])?>","<?php echo trim($rown["parentid"])?>","<?php echo trim($rown["classid"])?>");
       <?php
		$count = $count + 1;
       }
        ?>
onecount=<?php echo $count ?>;
function changelocation(locationid){
    document.myform.s.length = 1; 
    for (i=0;i < onecount; i++){
            if (subcat[i][1] == locationid){ 
                document.myform.s.options[document.myform.s.length] = new Option(subcat[i][0], subcat[i][2]);
            }        
        }
    }</script>
      <select name="b" size="1" id="b" onChange="changelocation(document.myform.b.options[document.myform.b.selectedIndex].value)">
        <option value="0" selected="selected">请选择大类</option>
        <?php
	$sqln = "select classid,classname from zzcms_userclass where  parentid='0' order by xuhao asc";
    $rsn=query($sqln);
	while($rown = fetch_array($rsn)){
	?>
     <option value="<?php echo $rown["classid"]?>" <?php if ($rown["classid"]==$row["bigclassid"]) { echo "selected";}?>><?php echo $rown["classname"]?></option>
        <?php
				}
				?>
      </select>
	  <select name="s">
      <option value="0">请选择小类</option>
      <?php
$sqln="select classid,classname from zzcms_userclass  where parentid='" .$row["bigclassid"]."' order by xuhao asc";
$rsn=query($sqln);
$rown= num_rows($rsn);//返回记录数
if(!$rown){
?>
 <option value="0" >下无子类</option>
 <?php
}else{
while($rown = fetch_array($rsn)){
?>
<option value="<?php echo $rown["classid"]?>" <?php if ($rown["classid"]==$row["smallclassid"]) { echo "selected";}?>><?php echo $rown["classname"]?></option>
      <?php 	  
}
}
?>
    </select>	   </td>
    </tr>
    <tr> 
      <td align="right" class="border">公司名称</td>
      <td class="border"> <input name="comane" value="<?php echo $row["comane"]?>" size="30"> 
        <input name="oldcomane" type="hidden" id="oldcomane" value="<?php echo $row["comane"]?>"></td>
    </tr>
    <tr> 
      <td align="right" class="border">公司简介</td>
      <td class="border">  
	  <textarea name="gsjj" id="gsjj"><?php echo stripfxg($row["content"],true) ?></textarea> 
			  <script type="text/javascript">CKEDITOR.replace('gsjj');</script>      </td>
    </tr>
    <tr> 
      <td align="right" class="border">公司形象图片 / 用户头像
        <input name="img" id="img" type="hidden" value="<?php echo $row["img"]?>">
        <input name="oldimg" type="hidden" id="oldimg" value="<?php echo $row["img"]?>">      </td>
      <td class="border">

        <table width="120" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
          <tr>
            <td align="center" bgcolor="#FFFFFF" id="showimg" onClick="openwindow('/uploadimg_form.php',400,300)"><?php
				  if($row["img"]<>"" && $row["img"]<>"/image/nopic.gif"){
				  echo "<img src='".$row["img"]."' border=0 width=120/><br>点击可更换图片";
				  }else{
				  echo "<input name='Submit2' type='button'  value='上传图片'/>";
				  }
				  ?>            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td align="right" class="border">公司形象视频</td>
      <td class="border"><input name="flv" id="flv" value="<?php echo $row["flv"]?>" size="30"></td>
    </tr>
    <tr> 
      <td align="right" class="border">公司主页</td>
      <td class="border"><input  maxlength="100" size="30" name="homepage" value="<?php echo $row["homepage"]?>"></td>
    </tr>
    <tr> 
      <td align="right" class="border">详细地址</td>
      <td class="border"> <input name="address" value="<?php echo $row["address"]?>" size="30" maxLength="50"></td>
    </tr>
    <tr> 
      <td align="right" class="border">联系电话</td>
      <td class="border"> <input name=phone value="<?php echo $row["phone"]?>" size="30" maxLength="50"></td>
    </tr>
    <tr> 
      <td align="right" class="border">传真</td>
      <td class="border"> <input name=fox value="<?php echo $row["fox"]?>" size="30" maxLength="50"></td>
    </tr>
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"><input name=Submit3   type=submit id="Submit3" value="保存修改结果"></td>
    </tr>
    <tr  > 
      <td height="30" colspan="2" class="admintitle2">用户权限</td>
    </tr>
    <tr> 
      <td align="right" class="border">是否审核</td>
      <td class="border"> <label><input type="radio" name="passed" value="0" <?php if ($row["passed"]==0) { echo "checked";}?>>
       未审核 </label>
        <label><input type="radio" name="passed" value="1" <?php if ($row["passed"]==1) { echo "checked";}?>>
        已审核</label></td>
    </tr>
    <tr> 
      <td align="right" class="border">用户身份</td>
      <td class="border"><label> <input type="radio" name="usersf" value="公司" <?php if ($row["usersf"]=='公司') { echo "checked";}?>>
        公司</label> 
       <label> <input type="radio" name="usersf" value="个人" <?php if ($row["usersf"]=='个人') { echo "checked";}?>>
        个人</label></td>
    </tr>
    <tr> 
      <td align="right" class="border">用户状态</td>
      <td class="border"> <label><input type="radio" name="lockuser" value="0" <?php if ($row["lockuser"]==0) { echo "checked";}?>>
        正常 </label>
       <label> <input type="radio" name="lockuser" value="1" <?php if ($row["lockuser"]==1) { echo "checked";}?>>
        锁定</label></td>
    </tr>
    <tr> 
      <td align="right" class="border">是否认证</td>
      <td class="border"><label><input type="radio" name="renzheng" value="0" <?php if ($row["renzheng"]==0) { echo "checked";}?>>
        未认证</label> 
        <label><input type="radio" name="renzheng" value="1" <?php if ($row["renzheng"]==1) { echo "checked";}?>>
        已认证 </label>
        <input name="oldrenzheng" type="hidden" id="oldrenzheng" value="<?php echo $row["renzheng"]?>"></td>
    </tr>
    <tr> 
      <td align="right" class="border">所属用户组</td>
      <td class="border"> <select name="groupid">
          <?php
			$rsn=query("select groupid,groupname from zzcms_usergroup order by groupid asc");
			$r=num_rows($rsn);
			if ($r){
			while ($r=fetch_array($rsn)){
				if ($r["groupid"]==$row["groupid"]){
			 	echo "<option value='".$r["groupid"]."' selected>".$r["groupname"]."</option>";
				}else{
				echo "<option value='".$r["groupid"]."' >".$r["groupname"]."</option>";
				}
			}
			}
			?>
        </select> <input name="oldgroupid" type="hidden" id="oldgroupid" value="<?php echo $row["groupid"]?>">      </td>
    </tr>
    <tr> 
      <td align="right" class="border">充费</td>
      <td class="border"> <input name="totleRMB" type="text" id="totleRMB" value="<?php if ($row["totleRMB"]<>"") {echo  $row["totleRMB"]; }else{ echo "0"; }?>" size="10">
        金币</td>
    </tr>
    <tr> 
      <td align="right" class="border">会员期限</td>
      <td class="border"> <input name="startdate" type="text" id="startdate" value="<?php if ($row["startdate"]<>"") {echo  $row["startdate"]; }else{ echo date('Y-m-d'); }?>" size="15" onFocus="JTC.setday(this)">
        至 
        <input name="enddate" type="text" id="enddate" value="<?php if ($row["enddate"]<>"") {echo  $row["enddate"]; }else{ echo date('Y-m-d',time()+365*24*3600); }?>" size="15" onFocus="JTC.setday(this)">      </td>
    </tr>
    <tr> 
      <td align="right" class="border">置顶值</td>
      <td height="20" class="border"><input name="elite" id="elite" value="<?php echo $row["elite"]?>" size="4" maxLength="4">
        （设值范围 1-127值越大排位越靠顶部） </td>
    </tr>
    <tr> 
      <td height="20" align="center" class="border">&nbsp;</td>
      <td height="20" class="border"><input name=Submit   type=submit id="Submit" value="保存修改结果">
        <input name="action" type="hidden" id="action" value="modify"> 
        <input name="id" type="hidden" id="id" value="<?php echo $row["id"]?>"></td>
    </tr>
    <tr> 
      <td height="40" colspan="2" align="center">&nbsp;</td>
    </tr>
  </TABLE>
</form>
<?php
}
?>
</body>
</html>