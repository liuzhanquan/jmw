<?php
include("admin.php");
include("../inc/fy.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
	a>b{
		color:#999;
	}
</style>
<script language="JavaScript" src="../js/gg.js"></script>
<?php
checkadminisdo("dl");

$action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
$page=isset($page)?$page:1;
checkid($page);

if (!isset($b)){$b=0;}
checkid($b,1);
if (!isset($pid)){$pid=0;}
checkid($pid,1);

$shenhe=isset($_REQUEST["shenhe"])?$_REQUEST["shenhe"]:'';
$keyword=isset($_REQUEST["keyword"])?$_REQUEST["keyword"]:'';
$kind=isset($_REQUEST["kind"])?$_REQUEST["kind"]:'';
$showwhat=isset($_REQUEST["showwhat"])?$_REQUEST["showwhat"]:'';
$isread=isset($_REQUEST["isread"])?$_REQUEST["isread"]:'';

if ($action=="pass"){
if(!empty($_POST['id'])){
    for($i=0; $i<count($_POST['id']);$i++){
    $id=$_POST['id'][$i];
	checkid($id);
	$sql="select passed from zzcms_dl where id ='$id'";
	$rs = query($sql); 
	$row = fetch_array($rs);
	if ($row['passed']=='0'){
	query("update zzcms_dl set passed=1 where id ='$id'");
    }else{
	query("update zzcms_dl set passed=0 where id ='$id'");
	}
	}	
}else{
echo "<script lanage='javascript'>alert('操作失败！至少要选中一条信息。');history.back()</script>";
}
echo "<script>location.href='?keyword=".$keyword."&page=".$page."'</script>";
}

if ($do=="modify"){
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$did=$_GET['did'];
		$uid=$_GET['uid'];
		$val=$_GET['value'];
		checkid($id);
		query("update zzcms_dlmessage set state=$val where id ='$id'");
	}else{
		echo "<script lanage='javascript'>alert('操作失败！至少要选中一条信息。');history.back()</script>";
	}

	echo "<script>location.href='?keyword=".$keyword."&page=".$page."'</script>";
}


?>
</head>
<body>
<div class="admintitle">加盟申请信息库管理</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="border">
  <tr> 
      <!--td width="45%"><input name="submit32" type="submit" class="buttons" onClick="javascript:location.href='dl.php?do=add'" value="发布<?php echo channeldl?>信息">      </td-->
    <td width="55%" align="right"> 
      <form name="form1" method="post" action="?">
	  <label> <input type="radio" name="kind" value="cpmc" <?php if ($kind=="cpmc") { echo "checked";}?>>
        按产品名称 </label> 
		<label> <input type="radio" name="kind" value="cpID" <?php if ($kind=="cpID") { echo "checked";}?>>
        按产品ID </label> 
        <label> <input name="kind" type="radio" value="tel" <?php if ($kind=="tel") { echo "checked";}?> >
        按电话 </label> 
        <label> <input type="radio" name="kind" value="editor" <?php if ($kind=="editor") { echo "checked";}?>>
        按用户名</label>  
       <label>  <input type="radio" name="kind" value="saver" <?php if ($kind=="saver") { echo "checked";}?>>
        按接收人 </label> 
        <input name="keyword" type="text" id="keyword2" value="<?php echo $keyword?>"> 
        <input type="submit" name="Submit" value="查找">
        <a href="?isread=no">未查看的</a> 
      </form>		</td>
  </tr>
</table>
 
 
<?php
$page_size=pagesize_ht;  //每页多少条数据
$offset=($page-1)*$page_size;

$sql2='';
if ($shenhe=="no") {  		
$sql2=$sql2." and passed=0 ";
}
if ($b<>0 && empty($pid)) {
$sql2=$sql2." and classid='".$b."'";
}

if ( $id<>'0' && !empty($id) ) {
	$sql2 = $sql2."and id ='".$id."'";
}
if ( $did<>'0' && !empty($did) ) {
	$sql2 = $sql2."and did ='".$did."'";
}
if ( $uid<>'0' && !empty($uid) ) {
	$sql2 = $sql2."and uid ='".$uid."'";
}
if( !empty($pid) ){
	$sql2=$sql2." and classid='".$pid."'";
}
if ($isread=="no") {
$sql2=$sql2." and saver<>'' and looked=0";
}
if ($keyword<>"") {
	switch ($kind){
	case "editor";
	$sql2=$sql2. " and username like '%".$keyword."%' ";
	break;
	case "cpmc";
	$sql2=$sql2. " and cp like '%".$keyword."%'";
	break;
	case "cpID";
	$sql2=$sql2. " and did = '".$keyword."'";
	break;
	case "saver";
	$sql2=$sql2. " and saver like '%".$keyword."%'";
	break;
	case "tel";
	$sql2=$sql2. " and phone like '%".$keyword."%'";
	break;		
	default:
	$sql2=$sql2. " and cp like '%".$keyword."%'";
	}
}
$sql="select count(*) as total from zzcms_dlmessage where id<>0 ";
$rs =query($sql.$sql2); 
$row = fetch_array($rs);
$totlenum = $row['total'];
$totlepage=ceil($totlenum/$page_size);

$sql="select * from zzcms_dlmessage where id<>0 ";
$sql=$sql.$sql2;
$sql=$sql . " order by id desc limit $offset,$page_size";
//$sql=$sql." and id>=(select id from zzcms_dlmessage order by id limit $offset,1) order by id desc limit $page_size";
$rs = query($sql); 
if(!$totlenum){
echo "暂无信息";
}else{
?>
<form name="myform" id="myform" method="post" action="" onSubmit="return anyCheck(this.form)">

      <div class="border2"> 
        <!--input name="submit" type="submit" onClick="myform.action='dl_sendmail.php';myform.target='_blank' "  value="给接收者发邮件提醒">
        <input name="submit23" type="submit" onClick="myform.action='dl_sendsms.php';myform.target='_blank' "  value="给接收者发手机短信提醒">
        <input name="submit4" type="submit"  onClick="myform.action='?action=pass';myform.target='_self'" value="【取消/审核】选中的信息"> 
        <input type="submit" onClick="myform.action='del.php';myform.target='_self';return ConfirmDel()" value="删除选中的信息">
        <input name="pagename" type="hidden"  value="dl_manage.php?b=<?php echo $b?>&shenhe=<?php echo $shenhe?>&page=<?php echo $page ?>"> 
        <input name="tablename" type="hidden"  value="zzcms_dl"--> </div>

  <table width="100%" border="0" cellpadding="5" cellspacing="1">
    <tr class="trtitle"> 
      <td width="4%" align="center"> <label for="chkAll" style="cursor: pointer;">全选</label></td>
      <td width="5%">ID</td>
      <td width="5%">项目名</td>
      <td width="10%">联系人</td>
      <td width="10%">留言</td>
      <td width="8%">电话</td>
      <td width="10%">申请时间</td>
      <td width="10%" align="center">信息状态</td>
      <td width="5%" align="center">操作</td>
    </tr>
    <?php
while($row = fetch_array($rs)){
	dl_level_sel($row["id"],1);
?>
    <tr class="trcontent"> 
      <td align="center"> <input name="id[]" type="checkbox"  value="<?php echo $row["id"]?>">
     </td>
	 <td><?php echo $row["id"]?></td>
      <td>
			<a href="dl_manage.php?id=<?php echo $row['did'];?>">
			<?php echo getdlfind($row['did'])[0]['cp'];?>
			</a>
	  </td>
      <td>
			<a href="usermanage.php?id=<?php echo $row['uid'];?>">
			<?php echo $row['username'];?>
			</a>
		</td>
		<td>
			<?php echo $row['content'];?>
		</td>
      <td><?php echo $row["phone"]?></td>
      <td><?php echo date('Y-m-d H:i:s',$row["sendtime"]);?></td>
      <td align="center"> 
        <?php 
			if ($row["state"]==1) {
				echo"已联系";
			}else if($row["state"]==2){ 
				echo"<font color=red>不需要</font>";
			}else if($row["state"]==3){ 
				echo"<font color=#999;>考虑中</font>";
			}else if($row["state"]==4){ 
				echo"<font color=blue>已下订</font>";
			}else if($row["state"]==5){ 
				echo"<font color=blue>已付款</font>";
			}else{ 
				echo"<font color=red>未联系</font>";
			}
		?>
       </td>
      <td align="center" class="docolor"> 
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=1">已联系</a>     
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=2">不需要</a>  <br/>   
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=3">考虑中</a>     
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=4">已下订</a>  <br/>    
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=5">已付款</a>     
		<a href="dlmessage.php?do=modify&id=<?php echo $row["id"]?>&page=<?php echo $page ?>&value=0">未联系</a>     
	   </td>
    </tr>
    <?php
}
?>
  </table>
      <!--div class="border"> 
        <input name="chkAll" type="checkbox" id="chkAll" onClick="CheckAll(this.form)" value="checkbox">
         <label for="chkAll" style="cursor: pointer;">全选/不选</label>
        <input name="submit2" type="submit" onClick="myform.action='dl_sendmail.php';myform.target='_blank' "  value="给接收者发邮件提醒">
        <input name="submit232" type="submit" onClick="myform.action='dl_sendsms.php';myform.target='_blank' "  value="给接收者发手机短信提醒">
        <input name="submit5" type="submit"  onClick="myform.action='?action=pass';myform.target='_self'" value="【取消/审核】选中的信息"> 
        <input name="submit3" type="submit" onClick="myform.action='del.php';myform.target='_self';return ConfirmDel()" value="删除选中的信息"> 
      </div-->
</form>
<div class="border center"><?php echo showpage_admin()?></div>
<?php
}
?>
</body>
</html>