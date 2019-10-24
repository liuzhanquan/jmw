<?php
include("admin.php");
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<title></title>
<script language="JavaScript" src="/js/gg.js"></script>
<script language="JavaScript" src="/js/jquery.js"></script>
<script language="JavaScript" type="text/JavaScript">
function ConfirmDelBig(){
   if(confirm("确定要删除此大类吗？删除此大类同时将删除所包含的小类，并且不能恢复！"))
     return true;
   else
     return false;	 
}
function ConfirmDelSmall(){
   if(confirm("确定要删除此小类吗？一旦删除将不能恢复！"))
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

//动态增加表单元素大类。
function AddElement_big(){   
//得到需要被添加的html元素。
var TemO=document.getElementById("add");   
//var newInput = document.createElement("<input type='text' size='50' maxlength='50' name='classname[]' value='大类别名称'>"); 
	if($.browser.msie) {
	var newInput = document.createElement("<input type='text' size='50' maxlength='50' name='classname[]' value='大类别名称'>");
	}else{
	var newInput = document.createElement("input");
	newInput.type = "text";
	newInput.name = "classname[]";
	newInput.size = "50";
	newInput.maxlength = "50";
	newInput.value = "大类别名称";
	}
TemO.appendChild(newInput); 
var newline= document.createElement("hr"); 
TemO.appendChild(newline);   
}   
//动态增加表单元素小类。
function AddElement_small(){   
//得到需要被添加的html元素。
var TemO=document.getElementById("add");   
//var newInput = document.createElement("<input type='text' size='50' maxlength='50' name='classname[]' value='小类别名称'>");
if($.browser.msie) {
	var newInput = document.createElement("<input type='text' size='50' maxlength='50' name='classname[]' value='小类别名称'>");
	}else{
	var newInput = document.createElement("input");
	newInput.type = "text";
	newInput.name = "classname[]";
	newInput.size = "50";
	newInput.maxlength = "50";
	newInput.value = "小类别名称";
	}
TemO.appendChild(newInput);     
var newline= document.createElement("hr"); 
TemO.appendChild(newline);   
}   
</script>
</head>
<body>
<?php
$dowhat=isset($_REQUEST['dowhat'])?$_REQUEST['dowhat']:'';
$did=isset($_REQUEST['did'])?$_REQUEST['did']:'';

switch ($dowhat){
case "addbigclass";
checkadminisdo("advclass");
addbigclass();
break;
case "addsmallclass";
checkadminisdo("advclass");
addsmallclass();
break;
case "modifybigclass";
checkadminisdo("advclass");
modifybigclass();
break;
case "modifysmallclass";
checkadminisdo("advclass");
modifysmallclass();
break;
default;
showclass();
}
function showclass(){
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
if ($action=="addgg") {
	$did = $_POST['did'];
	$tagid = $_POST['tagid'];
	$tagidsql = 'classid = 0';
	//广告原id数组
	$ggArrId = [];
	//留下数组
	$inArr = [];
	$classArr = [];
	
	
	$gidArr = query_arr("select id,bigclassname,smallclassname,dl_id from zzcms_ad where dl_id ='$did'");
	
	foreach( $tagid as $item ){
		$tagidsql = $tagidsql.' or classid = "'.$item.'"';
	}
	$ggClass = query_arr("select classid,classname,parentid from zzcms_adclass where ".$tagidsql);
	foreach( $gidArr as $item ){
		foreach( $ggClass as $i ){
			//print_r($i['classname'] == $item['smallclassname'] && $i['parentid'] == $item['bigclassname']);
			if( $i['classname'] == $item['smallclassname'] && $i['parentid'] == $item['bigclassname'] ){
				
				$inArr[] = $item['id'];
				$classArr[] = $i['classid'];
			}else{
				
			}
		}
		$ggArrId[] = $item['id'];
		
	}
	$del = array_diff($ggArrId,$inArr);
	$dsql = 'id = 0';
	foreach( $del as $item ){
		$dsql = $dsql.' or id = "'.$item.'"';
	}
	query('delete from zzcms_ad where '.$dsql);
	
	$add = array_diff($tagid,$classArr);
	foreach( $add as $item ){
		foreach( $ggClass as $i ){
			if($item == $i['classid']){
				$classname = $i['classname'];
				$parentid = $i['parentid'];
				query("insert into zzcms_ad (bigclassname,smallclassname,dl_id,xuhao,elite,sendtime) value ('$parentid','$classname','$did',0,0,'".date('Y-m-d H:i:s')."')");
				
			}
		}
	}
	echo "<script>location.href='dlgg.php?did=".$did."'</script>";
}


?> 
<div class="admintitle">代理产品广告设置设置</div>

<?php
$did=isset($_GET['did'])?$_GET['did']:'';
$sql="select * from zzcms_adclass where parentid='A' order by xuhao";
$rs=query($sql);
$row=num_rows($rs);
if (!$row){
echo "暂无分类信息";
}else{
?>
<form name="form1" method="post" action="?action=px">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr class="trtitle"> 
      <td width="22%" >类别名称</td>
      <td width="25%" >排序</td>
      <td width="25%" >发现导航</td>
      <td width="28%">操作</td>
    </tr>
    <?php while ($row=fetch_array($rs)){?>
    <tr class="trcontent"> 
      <td style="font-weight:bold"><a name="B<?php echo $row["classid"]?>"></a><img src="image/icobig.gif" width="9" height="9"> 
        <?php echo $row["classname"]?></td>
      <td width="25%" > <input name="<?php echo "xuhao".$row["classid"]?>" type="text"  value="<?php echo $row["xuhao"]?>" size="4"> 
        <input type="submit" name="Submit" value="更新序号"></td>
		
		<td width="25%" >
			<?php 
				if( $rown['nav_show'] ){
					echo '是';
				}else{
					echo '否';
				}
			?>
		</td>
		
      <td width="28%" >[ <a href="?dowhat=modifybigclass&classid=<?php echo $row["classid"]?>">修改</a> 
        | <a href="?action=delbig&bigclassid=<?php echo $row["classid"]?>" onClick="return ConfirmDelBig();">删除</a> 
        | <a href="?dowhat=addsmallclass&bigclassid=<?php echo $row["classid"]?>">添加子栏目</a> 
        ] </td>
    </tr>
    <?php
	$n=0;
	$sqln="select * from zzcms_adclass where parentid='" . $row["classname"] . "' order by xuhao";
	$rsn=query($sqln);
	while ($rown=fetch_array($rsn)){
	?>
    <tr class="trcontent">  
      <td ><a name="S<?php echo $rown["classid"]?>"></a><img src="image/icosmall.gif" width="23" height="11"> 
        <?php echo $rown["classname"]?></td>
      <td><input name="<?php echo "xuhaos".$rown["classid"]?>" type="text"  value="<?php echo $rown["xuhao"]?>" size="4"> 
        <input name="checked" type="submit" id="checked" value="更新序号"></td>
		
		<td>
			<?php 
				if( $rown['nav_show'] ){
					echo '是';
				}else{
					echo '否';
				}
			?>
		</td>
		
      <td>[ <a href="?dowhat=modifysmallclass&classid=<?php echo $rown["classid"]?>">修改</a> 
        | <a href="?action=delsmall&smallclassid=<?php echo $rown["classid"]?>&bigclassid=<?php echo $row["classid"]?>" onClick="return ConfirmDelSmall();">删除</a> 
        ] </td>
    </tr>
    <?php
		$n=$n+1;
		}
	}
	  ?>
  </table>
</form>
<?php
	$sqln="select * from zzcms_adclass where parentid='' order by xuhao";
	$rsn=query($sqln);
	$rown=num_rows($rsn);
	if ($rown){
	echo"出现以下无大类的子类，请删除<br>"; 
	while ($rown=fetch_array($rsn)){ 
    echo $rown["classname"]."<a href='?action=delsmall&smallclassid=".$rown["classid"]."'>删除</a><br>";
    $n=$n+1;
	}
	}
} 
}
?>
</body>
</html>