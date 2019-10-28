<?php
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<script type="text/javascript" src="../3/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>  
<script language="javascript" src="../js/timer.js"></script>
<script language="javascript" src="../js/gg.js"></script>
<script type="text/javascript" language="JavaScript">
$.ajaxSetup ({
cache: false //close AJAX cache
});

function CheckForm(){
	
	var v = '';
	for(var i = 0; i < document.myform.destList.length; i++){
		if(i==0){
			v = document.myform.destList.options[i].text;
		}else{
			v += ','+document.myform.destList.options[i].text;
		}
	}
	//alert(v);
	document.myform.cityforadd.value=v;
	
if (document.myform.cp.value==""){
    alert("请填写您要求<?php echo channeldl?>的产品名称！");
	document.myform.cp.focus();
	return false;
  }
if (document.myform.classid.value==""){
    alert("请选择产品类别！");
	document.myform.classid.focus();
	return false;
  }  
  if (document.myform.province.value=="请选择省份"){
    alert("请选择要<?php echo channeldl?>的省份！");
	document.myform.province.focus();
	return false;
  }
  
if (document.myform.truename.value==""){
    alert("请填写真实姓名！");
	document.myform.truename.focus();
	return false;
}
 
if (document.myform.tel.value==""){
    alert("请填写代联系电话！");
	document.myform.tel.focus();
	return false;
} 
  
if (document.myform.yzm.value==""){
    alert("请输入验证问题的答案！");
	document.myform.yzm.focus();
	return false;
}
  

}

function showsubmenu(sid){
whichEl = eval("submenu" + sid);
if (whichEl.style.display == "none"){
eval("submenu" + sid + ".style.display=\"\";");
}
}

function hidesubmenu(sid){
whichEl = eval("submenu" + sid);
if (whichEl.style.display == ""){
eval("submenu" + sid + ".style.display=\"none\";");
}
}
</SCRIPT>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
$do=isset($_GET['do'])?$_GET['do']:'';
switch ($do){
case "add";add();break;
case "modify";modify();break;
}


if ($do=="save"){
$error=0;
$msg='';
$page=isset($_POST["page"])?$_POST["page"]:1;//只从修改页传来的值
checkid($page);
$id=isset($_POST["id"])?$_POST["id"]:0;
checkid($id,1);
$passed=isset($_POST["passed"])?$_POST["passed"]:0;
checkid($passed,1);

$classid=isset($_POST["classid"])?$_POST["classid"]:0;
//判断用户是否选子类
if( !empty($_POST['parentid']) ){
	$classid = $_POST['parentid'];
}

//判断用户是否选子类
if( !empty($_POST['photoArr']) ){
	foreach( $_POST['photoArr'] as $item ){
		if( !empty($item) ) $photoA[] = $item;
	}
	$photo = implode(',',$photoA);
}

checkid($classid,1);
$city=$_POST["cityforadd"];
$companyname=isset($_POST["companyname"])?$_POST["companyname"]:"";
if ($dlsf=="个人" ){$companyname="";}

/*
if ($cp=='' || $truename=='' || $tel==''){
$error=1;
$msg=$msg.'<li>请完整填写表单内容</li>';
}*/

if ($error==1){
WriteErrMsg($msg);
}else{
	if ($_POST["action"]=="modify"){
	checkadminisdo("dl_modify");
	$dl_tag = implode(',',$_POST['dltagArr']);
	$dl_advantag = implode(',',$_POST['advantagArr']);
	$oldprovince=trim($_POST["oldprovince"]);
	$api_url=trim($_POST["api_url"]);
	if ($province=='请选择省份'){$province=$oldprovince;}
	$phone1 		= $_POST['phone1'];
	$phone1_title 	= $_POST['phone1_title'];
	$phone2 		= $_POST['phone2'];
	$phone2_title 	= $_POST['phone2_title'];
	$logo 			= $_POST['logo'];
	$version_num 	= $_POST['version_num'];
	$rightcopy 		= $_POST['rightcopy'];
	$agreement 		= $_POST['agreement'];
	$privacy 		= $_POST['privacy'];
	query("update zzcms_config set phone1='$phone1',phone1_title='$phone1_title',phone2='$phone2',phone2_title='$phone2_title',logo='$logo',version_num='$version_num',rightcopy='$rightcopy',agreement='$agreement',privacy='$privacy',api_url='$api_url',add_time='".time()."' where id='1'");
	
	echo "<script>location.href='config.php?do=modify'</script>";	
}

}
}
function modify(){
checkadminisdo("dl");
$page = isset($_GET['page'])?$_GET['page']:1;
checkid($page);
$id = isset($_GET['id'])?$_GET['id']:0;
checkid($id,1);
$sql="select * from zzcms_config order by id asc";
$rs=query_arr($sql);
//$row=fetch_array($rs);
?>
<div class="admintitle"> 修改移动端信息</div>
<form action="?do=save&action=modify" method="post" name="myform" id="myform" onSubmit="return CheckForm();">
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr> 
      <td align="right" class="border">logo图片： </td>
		<td class="border"> 
			<input name="logo" type="hidden" value="<?php echo $rs[0]['logo'];?>" id="img" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300)">
					<?php if( empty($rs[0]['logo']) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$rs[0]['logo'].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
		</td>
    </tr>
    <tr> 
      <td align="right" class="border">联系我们电话信息1</td>
      <td class="border"> 
			<input name="phone1_title" type="text" id="cp" value="<?php echo $rs[0]['phone1_title']?>" size="20" maxlength="45">      
			<input name="phone1" type="text" id="cp" value="<?php echo $rs[0]['phone1']?>" size="20" maxlength="42">      
	  </td>
    </tr>
    <tr> 
      <td align="right" class="border">联系我们电话信息2</td>
      <td class="border"> 
			<input name="phone2_title" type="text" id="cp" value="<?php echo $rs[0]['phone2_title']?>" size="20" maxlength="42">      
			<input name="phone2" type="text" id="cp" value="<?php echo $rs[0]['phone2']?>" size="20" maxlength="45">      
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">版本号</td>
      <td class="border">     
			<input name="version_num" type="text" id="cp" value="<?php echo $rs[0]['version_num']?>" size="20" maxlength="45">      
	  </td>
    </tr>
    <tr id="trcontent"> 
      <td width="130" align="right" class="border">服务协议</td>
      <td class="border"> 
        <textarea name="agreement" cols="45" rows="6" id="content"><?php echo stripfxg($rs[0]["agreement"])?></textarea> 
		<script type="text/javascript">CKEDITOR.replace('content');	</script>
        <input name="id" type="hidden" id="dlid" value="<?php echo $row["id"]?>">
        <input name="page" type="hidden" id="page" value="<?php echo $page?>">      </td>
		
    </tr>
	<tr id="trcontent"> 
      <td width="130" align="right" class="border">隐私政策</td>
      <td class="border"> 
        <textarea name="privacy" cols="45" rows="6" id="content1"><?php echo stripfxg($rs[0]["privacy"])?></textarea> 
		<script type="text/javascript">CKEDITOR.replace('content1');	</script>
        <input name="page" type="hidden" id="page" value="<?php echo $page?>">      </td>
		
    </tr>
	<tr> 
      <td align="right" class="border">版权</td>
      <td class="border">     
			<input name="rightcopy" type="text" id="cp" value="<?php echo $rs[0]['rightcopy']?>" size="45" maxlength="45">      
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">api接口地址</td>
      <td class="border">     
			<input name="api_url" type="text" id="cp" value="<?php echo $rs[0]['api_url']?>" size="45" maxlength="45"> （后台管理主域名,图片显示使用）   
	  </td>
    </tr>
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"> 
        <input name="Submit" type="submit" class="buttons" value="修 改">
        <input name="action" type="hidden" id="action3" value="modify"></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html>