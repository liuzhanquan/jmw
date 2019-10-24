<?php
ob_start();//打开缓冲区，可以setcookie
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title></title>
<script language="JavaScript" src="../js/gg.js"></script>
<script language="JavaScript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/gg.js"></script>
<script language="JavaScript" type="text/JavaScript">
function ConfirmDelBig(){
   if(confirm("确定要删除标签吗？删除不能恢复！"))
     return true;
   else
     return false;	 
}
function ConfirmDelSmall(){
   if(confirm("确定要删除标签吗？删除不能恢复！"))
     return true;
   else
     return false;	 
}
function CheckForm(){  
if (document.form1.classname.value==""){
    alert("名称不能为空！");
	document.form1.classname.focus();
	return false;
}
}
</script>
</head>
<body>
<?php
if (isset($_GET['tablename'])){
setcookie("tablename",$_GET['tablename'],time()+3600*24,"/");
echo "<script>location.href='?'</script>";
}
if ($_COOKIE['tablename']==''){
showmsg('tablename 无参数');
}

$tablenames='';
$rs = query("SHOW TABLES"); 
while($row = fetch_array($rs)) { 
$tablenames=$tablenames.$row[0]."#"; 
}
$tablenames=substr($tablenames,0,strlen($tablenames)-1);

if (str_is_inarr($tablenames,$_COOKIE['tablename'])=='no'){
showmsg('tablename 参数有误','index.php');//返回到首页避免造成死循环
}
//if ($_COOKIE['tablename']=="zzcms_zxclass"){
//$TitleClass="资讯";$TemplateFileName='zx';
//}
$TitleClass = '代理';

$dowhat=isset($_REQUEST['dowhat'])?$_REQUEST['dowhat']:'';
switch ($dowhat){
case "addbigclass";
checkadminisdo("zxclass");
addbigclass();
break;
case "addsmallclass";
checkadminisdo("zxclass");
addsmallclass();
break;
case "modifybigclass";
checkadminisdo("zxclass");
modifybigclass();
break;
case "modifysmallclass";
checkadminisdo("zxclass");
modifysmallclass();
break;
default;
showclass();
}

function showclass(){
	
global $TitleClass;
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
if ($action=="px") {
checkadminisdo("zxclass");
$sql="select * from `".$_COOKIE['tablename']."`";

$rs=query($sql);

while ($row=fetch_array($rs)){
$xuhao=$_POST["xuhao".$row["id"].""];//表单名称是动态显示的，并于FORM里的名称相同。
	   if (trim($xuhao) == "" || is_numeric($xuhao) == false) {
	       $xuhao = 0;
	   }elseif ($xuhao < 0){
	       $xuhao = 0;
	   }else{
	       $xuhao = $xuhao;
	   }
query("update `".$_COOKIE['tablename']."` set xuhao='$xuhao' where id='".$row['id']."'");

}
}
if ($action=="delbig") {
checkadminisdo("zxclass");
$id=trim($_GET["id"]);
checkid($id);
if ($id<>"") {
	query("delete from `".$_COOKIE['tablename']."` where id='" . $id. "'");
}     
echo "<script>location.href='?'</script>";
}

?>
<div class="admintitle"><?php echo $TitleClass?>商家支持类别设置</div>
<div class="border2">
<input type="submit" class="buttons" onClick="javascript:location.href='?dowhat=addbigclass'" value="添加标签">
</div>
<?php
$sql="select * from `".$_COOKIE['tablename']."` order by xuhao";

$rs=query($sql);
$row=num_rows($rs);
if (!$row){
echo "暂无信息";
}else{
?>
<form name="form1" method="post" action="?action=px">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr class="trtitle"> 
      <td width="10%"  >ID</td>
      <td width="10%" align="center" >标签内容 </td>
      <td width="15%"  >排序</td>
      <td width="20%"  >操作</td>
    </tr>
    <?php while ($row=fetch_array($rs)){?>
    <tr class="bgcolor1">
      <td style="font-weight:bold"><?php echo $row["id"]?></td>
      <td align="center"><?php echo $row["title"]?></td >
	  <?php
	   $skin=explode("|",$row["skin"]);
	  ?>
	 <a title="分类页" href="/template/<?php echo siteskin?>/<?php echo $skin[0]?>" target="_blank"><?php echo $skin[0]?></a> 
	 | <a title="列表页" href="/template/<?php echo siteskin?>/<?php echo @$skin[1]?>" target="_blank"><?php echo @$skin[1]?></a>	  </td>
      <td > <input name="<?php echo "xuhao".$row["id"]?>" type="text"  value="<?php echo $row["xuhao"]?>" size="4"> 
      <input type="submit" name="Submit" value="更新序号"></td>
      <td >[ <a href="?dowhat=modifybigclass&classid=<?php echo $row["id"]?>">修改</a> 
        | <a href="?action=delbig&id=<?php echo $row["id"]?>" onClick="return ConfirmDelBig();">删除</a> 
        ] </td>
    </tr>
    <?php
	
	}
	  ?>
  </table>
</form>
<?php
}
}

function addbigclass(){
global $TitleClass;
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
$FoundErr=0;
$ErrMsg="";
if ($action=="add"){
	$title=$_POST['title'];
	$aa = query("insert into `".$_COOKIE['tablename']."` (title,update_time)values('$title','".time()."')");
	$bcid=insert_id();
	echo "<script>location.href='?#B".$bcid."'</script>";	
}
if ($FoundErr==1){
WriteErrMsg($ErrMsg);
}else{
?>
<div class="admintitle">添加<?php echo $TitleClass?>商家支持标签</div>
<form name="form1" method="post" action="?dowhat=addbigclass">
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr> 
      <td width="100%" class="border">
		<div id="add">
	  <input name="title" type="text" id="title" size="60" maxlength="50" placeholder="请填写标签名" >
	 <hr/>
	  </div>	  
	  
	  <input name="action" type="hidden" id="action" value="add"> 
        <input name="add" type="submit" value="提交">
	  </td>
    </tr>
  </table>
</form>
<?php
}
}


function modifybigclass(){
global $classid,$TitleClass,$TemplateFileName;
checkid($classid);
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';

$FoundErr=0;
$ErrMsg="";

if ($action=="modify"){
$id=trim($_POST["id"]);
$title=trim($_POST["title"]);

	query("update `".$_COOKIE['tablename']."` set title='$title',update_time='".time()."' where id='" .$id."'");
	
	
	echo "<script>location.href='?#B".$classid."'</script>";
	}


if ($FoundErr==1){
WriteErrMsg($ErrMsg);
}else{
$sql="select * from `".$_COOKIE['tablename']."` where id='" .$classid."'";
$rs=query($sql);
$row=fetch_array($rs);
?>
<div class="admintitle">修改<?php echo $TitleClass?>商家支持标签</div>
<form name="form1" method="post" action="?dowhat=modifybigclass" onSubmit="return CheckForm();">
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr> 
      <td align="right" class="border">标签修改：</td>
      <td class="border"> 
		<input name="id" type="hidden" id="id" value="<?php echo $row["id"]?>" size="30" maxlength="30">
		<input name="title" type="text" id="title" value="<?php echo $row["title"]?>" size="30" maxlength="30">
		</td>
    </tr>
    
    <tr> 
      <td class="border">&nbsp;</td>
      <td class="border"> <input name="action" type="hidden" id="action" value="modify"> 
        <input name="save" type="submit" id="save" value=" 修 改 "> </td>
    </tr>
  </table>
</form>
<?php
}
}
?>
</body>
</html>