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


if ($cp=='' || $truename=='' || $tel==''){
$error=1;
$msg=$msg.'<li>请完整填写表单内容</li>';
}

if ($error==1){
WriteErrMsg($msg);
}else{
	
	if ($_POST["action"]=="add"){
	checkadminisdo("dl_add");
	$dl_tag = implode(',',$_POST['dltagArr']);
	$dl_advantag = implode(',',$_POST['advantagArr']);
	//添加代理信息 
	$isok=query("insert into zzcms_dl(classid,cpid,cp,title,photo,province,xiancheng,city,content,company,companyname,dlsname,tel,address,email,sendtime) 		
	values('$classid',0,'$cp','$title','$photo','$province','$xiancheng','$city','$content','$dlsf','$companyname','$truename','$tel','$address','$email','".date('Y-m-d H:i:s')."')") ; 
	//获取刚刚添加的id
	$id=insert_id();  
	//添加代理详细信息 项目信息  boss信息
	$effect = query("insert into zzcms_dllist(did,name,title_list,reg_time,price_min,price_max,dl_tag,dl_advantag,price_total,price_list,store_num,join_num,join_people,boss_name,boss_img,boss_addr,boss_birthday,boss_nature,boss_job,boss_interst,boss_content,update_time) 		
	values('$id','$name','$title_list','".strtotime($reg_time)."','$price_min','$price_max','$dl_tag','$dl_advantag','$price_total','$price_list','$store_num','$join_num','$join_people','$boss_name','$boss_img','$boss_addr','$boss_birthday','$boss_nature','$boss_job','$boss_interst','$boss_content','".time()."')") ; 

	}elseif ($_POST["action"]=="modify"){
	checkadminisdo("dl_modify");
	$dl_tag = implode(',',$_POST['dltagArr']);
	$dl_advantag = implode(',',$_POST['advantagArr']);
	$oldprovince=trim($_POST["oldprovince"]);
	if ($province=='请选择省份'){$province=$oldprovince;}
	$isok=query("update zzcms_dl set classid='$classid',cp='$cp',title='$title',photo='$photo',province='$province',city='$city',content='$content',company='$dlsf',hit='$hit',companyname='$companyname',
	dlsname='$truename',tel='$tel',address='$address',email='$email',sendtime='".date('Y-m-d H:i:s')."',passed='$passed' where id='$id'");
	
	$effect=query("update zzcms_dllist set name='$name',title_list='$title_list',reg_time='".strtotime($reg_time)."',price_min='$price_min',price_max='$price_max',dl_tag='$dl_tag',dl_advantag='$dl_advantag',price_total='$price_total',price_list='$price_list',store_num='$store_num',join_num='$join_num',join_people='$join_people',boss_name='$boss_name',boss_img='$boss_img',boss_addr='$boss_addr',boss_birthday='$boss_birthday',boss_nature='$boss_nature',boss_job='$boss_job',boss_interst='$boss_interst',boss_content='$boss_content',update_time='".time()."' where did='$id'");
	}
	if ($isok){echo "<script>location.href='dl_manage.php?page=".$page."'</script>";}		
}

}

function add(){
?>
<div class="admintitle">发布<?php echo channeldl?>信息</div>
<form action="?do=save" method="post" name="myform" id="myform" onSubmit="return CheckForm();">      
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
    <tr> 
      <td align="right" class="border"><?php echo channeldl?>产品标题</td>
      <td class="border"> <input name="cp" type="text" id="cp" size="45" maxlength="45">      </td>
    </tr>
	<tr> 
      <td align="right" class="border"><?php echo channeldl?>产品副标题</td>
      <td class="border"> <input name="title" type="text" id="title" size="45" maxlength="45">      </td>
    </tr>
    <tr> 
		<td align="right" class="border">产品类别</td>
			<td class="border">
		  <?php
		$sql="select * from zzcms_zsclass where parentid=0";
		$rs=query($sql);
		$row=num_rows($rs);
			if (!$row){
			echo "<a href='class2.php?tablename=zzcms_zsclass'>添加类别</a>";
			}else{
		  ?>
		   <select name="classid" id="classid">
				<option value="0" selected>请选择类别</option>
			  <?php
			  
			while($row= fetch_array($rs)){
				?>
				<option value="<?php echo $row["classid"]?>"<?php if (@$_SESSION['bigclassid']==$row["classid"]){echo 'selected';}?>><?php echo $row["classname"]?></option>
			  <?php
			  }
			  ?>
			</select>
			 <?php
			  }
			  ?>
			  
			  
			<?php
			$rsn = '';
			$sqln = "select classid,parentid,classname from zzcms_zsclass where parentid<>0 order by xuhao asc";
			$rsn1=query($sqln);
			if ($rsn1){
				$res = sql_arr( $rsn1 );
					
			?>
					<select name="parentid" class="parentSel" pval="$item['classid']">
							<option value="0" selected="selected">请选择子类</option>
							<?php
							
					foreach($res as $i){
						
						?>
							<option class="parentSelOp" value="<?php echo $i["classid"]?>" pval="<?php echo $i['parentid'] ?>" <?php if ($row["classid"]==$i["classid"]) { echo "selected";}?>><?php echo $i["classname"]?></option>
							<?php
							
					}
					  
					  ?>
					</select>
			<?php
			}
			?>  
			</td>
		</tr>
	<tr> 
      <td align="right" class="border">banner图片： </td>
		<td class="border"> 
			<input name="photoArr[]" type="hidden" id="img" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300)"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" id="img2" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg2" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img2','showimg2')"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" id="img3" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg3" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img3','showimg3')"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" id="img4" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg4" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img4','showimg4')"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" id="img5" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg5" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img5','showimg5')"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
		</td>
    </tr>
    <tr> 
      <td width="130" align="right" class="border"><?php echo channeldl?>区域</td>
            <td class="border"><table border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td><script language="JavaScript" type="text/javascript">
function addSrcToDestList() {
destList = window.document.forms[0].destList;
city = window.document.forms[0].xiancheng;
var len = destList.length;
for(var i = 0; i < city.length; i++) {
if ((city.options[i] != null) && (city.options[i].selected)) {
var found = false;
for(var count = 0; count < len; count++) {
if (destList.options[count] != null) {
if (city.options[i].text == destList.options[count].text) {
found = true;
break;
}
}
}
if (found != true) {
destList.options[len] = new Option(city.options[i].text);
len++;
}
}
}
}

$('#classid').click(function(){
	var ind = $(this).val();
	$('.parentSel').val(0);
	$('.parentSelOp').css('display','none');
	$('.parentSelOp').each(function(index){
		
		if( $(this).attr('pval') == ind ){
			$('.parentSelOp').eq(index).css('display','block');
		}
	})
	
})

function deleteFromDestList() {
var destList = window.document.forms[0].destList;
var len = destList.options.length;
console.log(len);
for(var i = (len-1); i >= 0; i--) {
if ((destList.options[i] != null) && (destList.options[i].selected == true)) {
destList.options[i] = null;
}
}
} 


$(document).ready(function(){  
	$("#tel").change(function() { //jquery 中change()函数  
	$("#telcheck").load(encodeURI("/ajax/dltelcheck_ajax.php?id="+$("#tel").val()));//jqueryajax中load()函数 加encodeURI，否则IE下无法识别中文参数 
	});  
});  
</script>
                   <select name="province" id="province"></select>
<select name="city" id="city"></select>
<select name="xiancheng" id="xiancheng" onChange="addSrcToDestList()"></select>
<script src="/js/area.js"></script>
<script type="text/javascript">
new PCAS('province', 'city', 'xiancheng', '<?php echo @$_SESSION['province']?>', '<?php echo @$_SESSION["city"]?>', '');
</script>
                </td>
               
                <td width="100" align="center" valign="top">已选城市
                  <select name="destList" size="3" multiple="multiple" style='width:100px;font-size:13px'>
                      <?php if (isset($_SESSION['city'])){?>
                      <option value="<?php echo $_SESSION['city']?>" ><?php echo $_SESSION['city']?></option>
                      <?php
				  }
				  ?>
                  </select>
                    <input name="cityforadd" type="hidden" id="cityforadd" />
                    <input name="button" type="button" onClick="javascript:deleteFromDestList();" value="删除已选城市" /></td>
              </tr>
            </table></td>
    </tr>
    <tr id="trcontent">  
      <td width="130" align="right" class="border"><!--<?php echo channeldl?>商-->项目详细介绍</td>
      <td class="border"> 
		<textarea name="content" cols="45" rows="6" id="content"><?php echo @$_SESSION["content"]?></textarea>      
		<script type="text/javascript">CKEDITOR.replace('content');	</script>
	  </td>
    </tr>
	
	<!--分界线-->
	
	<tr><td align="right" class="border" style="background:#396eb5;"></td><td align="center" class="border" style="background:#396eb5;font-size:16px;">品牌信息</td></tr> 
	<tr> 
      <td align="right" class="border">项目名称</td>
      <td class="border"> <input name="name" type="text" id="name" size="45" maxlength="45">      </td>
    </tr>
	<tr> 
      <td align="right" class="border">主营项目</td>
      <td class="border"> <input name="title_list" type="text" id="title_list" size="45" maxlength="45">      </td>
    </tr>
	<tr> 
      <td align="right" class="border">品牌注册时间</td>
      <td class="border"> 
		<input name="reg_time" type="text" id="reg_time" value="<?php echo date('Y-m-d H:i:s')?>" onFocus="JTC.setday(this)">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">店铺数量</td>
      <td class="border"> 
		直营店：
		<input name="store_num" type="text" id="store_num" placeholder="直营店数量" size="10" maxlength="8">
		&nbsp;&nbsp;&nbsp;&nbsp;
		加盟店：
		<input name="join_num" type="text" id="join_num" size="10" placeholder="加盟店数量" maxlength="8"> 
		&nbsp;&nbsp;&nbsp;&nbsp;
		申请加盟人数：
		<input name="join_people" type="text" id="join_people" size="10" placeholder="申请加盟人数" maxlength="8">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">优势标签：</td>
      <td class="border"> 
	   <?php
		$sqln = "select id,title from zzcms_dladvantag order by xuhao asc";
	    $rsn=query($sqln);
        $rowa=num_rows($rsn);
		$parent_arr = [];
		if (!$rowa){
			echo "<a href='dladvantag.php?dowhat=addbigclass'>添加标签</a>";
		}else{
			
			while($rowa = fetch_array($rsn)){
				$parent_arr[] = $rowa;
				echo '<label style="margin-right:15px;"><input type="checkbox" name="advantagArr[]" value="'.$rowa['id'].'" />'.$rowa['title'].'</label>';
			}
		}
		?>
		
		</td>
    </tr>
	<tr> 
      <td align="right" class="border">个性标签：</td>
      <td class="border"> 
	   <?php
		$sqln = "select id,title from zzcms_dltag order by xuhao asc";
	    $rsn=query($sqln);
        $rown=num_rows($rsn);
		$parent_arr = [];
		if (!$rown){
			echo "<a href='dltag.php?dowhat=addbigclass'>添加标签</a>";
		}else{
			
			while($rown = fetch_array($rsn)){
				$parent_arr[] = $rown;
				echo '<label style="margin-right:15px;"><input type="checkbox" name="dltagArr[]" value="'.$rown['id'].'" />'.$rown['title'].'</label>';
			}
		}
		?>
		
		</td>
    </tr>
	<tr> 
      <td align="right" class="border">开店金额</td>
      <td class="border"> 
		<input name="price_min" type="text" id="price_min" size="10"  placeholder="金额" maxlength="5"> 万 - <input name="price_max" type="text" id="price_max" size="10" placeholder="金额" maxlength="5">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">开店费用</td>
      <td class="border"> 
		初期预估投入费用：<input name="price_total" type="text" id="price_total" size="10" placeholder="金额" maxlength="5"> 万元 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" id="detailsAdd" >+ 添加资金简介栏目</span>
		<input type="hidden" name="price_list" id="detailText" >
		<div id="detailsBox">
			<!--div style="margin-top:10px;">
				资金简介： <input name="" type="text" id="" placeholder="例：管理费/培训费/加盟费" size="20" maxlength="5">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="" type="text" id="" placeholder="金额" size="10" maxlength="5">
				-
				<input name="" type="text" id="" placeholder="金额" size="10" maxlength="5"> 万元
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" >删除</span>
			</div-->
		</div>
	  </td>
    </tr>
	<script>
		//点击添加按钮 添加简介选项
		$('#detailsAdd').click(function(){
			var htmlStr = '<div class="detailsBox" style="margin-top:10px;">资金简介： <input name="" type="text" id="" placeholder="例：管理费/培训费/加盟费" size="30" maxlength="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" id="" placeholder="金额" size="10" value="0" maxlength="5"> - <input name="" type="text" id="" placeholder="金额" size="10" value="0" maxlength="5"> 万元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="detailDel" style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" >删除</span></div>';
			$('#detailsBox').append(htmlStr);
			//$('.detailDel').each(function( index ){
			//	$(this).click(function(){
			//		console.log(index);
					//$('.detailsBox').eq(index).remove();
			//	})
			//})
			$('.detailDel').click(function(){
				$(this).parent('div').remove();
				newStr();
				//console.log(aa);
			});
			
			
			$('#detailsBox input').keyup(function(){
				newStr();
			})
		});
		
		//费用简介字符串拼接
		function newStr(){
			var sp = '';
			
			$('#detailsBox input').each(function(index){
				var num = 0;
				num = parseInt(index/3);
				if( index%3 == 0 ){
					if( $(this).val() != '' ){
						sp = sp+'/'+$(this).val();
					}
					//str = str+'-'+sp;
				}else{
					if( $('#detailsBox input').eq(num*3).val() != '' ){
						sp = sp+'-'+$(this).val();
					}
				}
			})
			sp = sp.substr(1);
			$('#detailText').val(sp);
			
		}
		
	</script>
	<!------------ 品牌说(boss 信息和语录 --------------->
	<tr>
		<td align="right" class="border" style="background:#396eb5;"></td>
		<td align="center" class="border" style="background:#396eb5;font-size:16px;">
			品牌说(boss 信息和语录   选填) 
			<span id="bossStatus" style="padding:5px 20px;color:#fff;cursor:pointer;" status='0'>显示</span> 
		</td>
	</tr> 
	<tr class="bossBox"> 
      <td align="right" class="border">boss名称</td>
      <td class="border"> <input name="boss_name" type="text" id="boss_name" size="45" maxlength="45">
	  </td>
    </tr>
	<tr class="bossBox"> 
		<td align="right" class="border">boss头像： </td>
		<td class="border"> 
			<input name="boss_img" type="hidden" id="boss_img" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="boss_img4" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'boss_img','boss_img4')"> <input name="Submit2" type="button"  value="上传图片" /></td>
			  </tr>
			</table>
		</td>
    </tr>
	<tr  class="bossBox"> 
      <td align="right" class="border">籍贯</td>
      <td class="border"> <input name="boss_addr" type="text" id="boss_addr" placeholder="例：北京" size="45" maxlength="45">      </td>
    </tr>
	<tr  class="bossBox"> 
      <td align="right" class="border">出生日期</td>
      <td class="border"> <input name="boss_birthday" type="text" id="boss_birthday" placeholder="例：1980" size="45" maxlength="45">      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">性格</td>
      <td class="border"> <input name="boss_nature" type="text" id="boss_nature" size="45" maxlength="45">      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">从事过的工作</td>
      <td class="border"> <input name="boss_job" type="text" id="boss_job" size="45" maxlength="45">      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">兴趣</td>
      <td class="border"> <input name="boss_interst" type="text" id="boss_interst" size="45" maxlength="45">      </td>
    </tr>
	<tr id="trcontent" class="bossBox">  
      <td width="130" align="right" class="border"><!--<?php echo channeldl?>商-->boss演讲</td>
      <td class="border"> 
		<textarea name="boss_content" cols="45" rows="6" id="boss_content"><?php echo @$_SESSION["content"]?></textarea>      
		<script type="text/javascript">CKEDITOR.replace('boss_content');	</script>
	  </td>
    </tr>
	<tr  class=""><td align="right" class="border" style="background:#396eb5;"></td><td align="right" class="border" style="background:#396eb5;"></td></tr> 
	
	
	<script>
		$('#bossStatus').click(function(){
			var status = $(this).attr('status');
			if( status == 1 ){
				$('.bossBox').css('display','none');
				$(this).attr('status',0).html('显示');
			}else{
				$('.bossBox').css('display','');
				$(this).attr('status',1).html('隐藏');
			}
		})
		$('.bossBox').css('display','none');
	</script>
	
	<style>
		.bossBox{
			display:;
		}
	</style>
	
	<!--分界线-->
	
    <tr> 
      <td align="right" class="border"><?php echo channeldl?>身份</td>
      <td class="border"><input name="dlsf" id="dlsf_company" type="radio" value="公司" onClick="showsubmenu(1)">
         <label for="dlsf_company">公司 </label>
        <input name="dlsf" type="radio" id="dlsf_person" onClick="hidesubmenu(1)" value="个人" checked>
          <label for="dlsf_person">个人</label></td>
    </tr>
    <tr style="display:none" id='submenu1'>
      <td align="right" class="border">公司名称</td>
      <td class="border"><input name="companyname" type="text" id="yzm2" value="" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">真实姓名</td>
      <td class="border">
<input name="truename" type="text" id="truename" value="" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">电话</td>
      <td class="border">
	  <input name="tel" type="text" id="tel" value="" size="45" maxlength="255" />
	  <span id="telcheck"></span>
	  </td>
    </tr>
    <tr> 
      <td align="right" class="border">地址</td>
      <td class="border">
<input name="address" type="text" id="address" value="" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">E-mail</td>
      <td class="border"><input name="email" type="text" id="email" value="" size="45" maxlength="255" /></td>
    </tr>
	
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"> 
        <input name="Submit" type="submit" class="buttons" value="发 布">
        <input name="action" type="hidden" id="action3" value="add"></td>
    </tr>
  </table>
</form>
<?php
}


function modify(){
checkadminisdo("dl");
$page = isset($_GET['page'])?$_GET['page']:1;
checkid($page);
$id = isset($_GET['id'])?$_GET['id']:0;
checkid($id,1);
$sql="select * from zzcms_dl where id='$id'";
$rs=query($sql);
$row=fetch_array($rs);
?>
<div class="admintitle"> 修改<?php echo channeldl?>信息</div>
<form action="?do=save" method="post" name="myform" id="myform" onSubmit="return CheckForm();">
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
    <tr> 
      <td align="right" class="border"><?php echo channeldl?>产品标题</td>
      <td class="border"> <input name="cp" type="text" id="cp" value="<?php echo $row["cp"]?>" size="45" maxlength="45">      </td>
    </tr>
	<tr> 
      <td align="right" class="border"><?php echo channeldl?>产品标题</td>
      <td class="border"> <input name="title" type="text" id="title" value="<?php echo $row["title"]?>" size="45" maxlength="45">      </td>
    </tr>
    <tr> 
      <td align="right" class="border">产品类别</td>
      <td class="border"> 
	   <?php
		$sqln = "select classid,classname from zzcms_zsclass where parentid=0 order by xuhao asc";
	    $rsn=query($sqln);
        $rown=num_rows($rsn);
		$parent_arr = [];
		if (!$rown){
			echo "<a href='class2.php?tablename=zzcms_zsclass'>添加类别</a>";
		}else{
			
		?>
		<select name="classid" id="classid">
                <option value="0" selected="selected">请选择类别</option>
                <?php
		while($rown = fetch_array($rsn)){
			$parent_arr[] = $rown;
			?>
                <option value="<?php echo $rown["classid"]?>" <?php if ($rown["classid"]==$row["classid"]) { echo "selected";}?>><?php echo $rown["classname"]?></option>
                <?php
		  }
		  ?>
              </select>
		<?php
		}
		?>

		<?php
		$rsn = '';
		$sqln = "select classid,parentid,classname from zzcms_zsclass where parentid<>0 order by xuhao asc";
	    $rsn1=query($sqln);
		if ($rsn1){
			$res = sql_arr( $rsn1 );
				
		?>
				<select name="parentid" class="parentSel" pval="$item['classid']">
						<option value="0" selected="selected">请选择子类</option>
						<?php
						
				foreach($res as $i){
					
					?>
						<option class="parentSelOp" value="<?php echo $i["classid"]?>" pval="<?php echo $i['parentid'] ?>" <?php if ($row["classid"]==$i["classid"]) { echo "selected";}?>><?php echo $i["classname"]?></option>
						<?php
						
				}
				  
				  ?>
				</select>
		<?php
		}
		?>  
		
		</td>
    </tr>
	<?php 
		
		$photoArr = explode(',',$row['photo']);
	?>
	<tr> 
      <td align="right" class="border">banner图片： </td>
		<td class="border"> 
			<input name="photoArr[]" type="hidden" value="<?php echo $photoArr[0];?>" id="img" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300)">
					<?php if( empty($photoArr[0]) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$photoArr[0].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" value="<?php echo $photoArr[1];?>" id="img2" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg2" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img2','showimg2')"> 
					<?php if( empty($photoArr[1]) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$photoArr[1].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
			<input name="photoArr[]"  type="hidden" value="<?php echo $photoArr[2];?>" id="img3" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg3" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img3','showimg3')"> 
					<?php if( empty($photoArr[2]) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$photoArr[2].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" value="<?php echo $photoArr[3];?>" id="img4" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg4" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img4','showimg4')"> 
					<?php if( empty($photoArr[3]) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$photoArr[3].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
			<input name="photoArr[]" type="hidden" value="<?php echo $photoArr[4];?>" id="img5" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="showimg5" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'img5','showimg5')"> 
					<?php if( empty($photoArr[4]) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$photoArr[4].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
		</td>
    </tr>
	
	
	
    <tr> 
      <td width="130" align="right" class="border"><?php echo channeldl?>区域</td>
      <td class="border"><table border="0" cellpadding="3" cellspacing="0">
        <tr>
          <td><script language="JavaScript" type="text/javascript">
function addSrcToDestList() {
destList = window.document.forms[0].destList;
city = window.document.forms[0].xiancheng;
var len = destList.length;
for(var i = 0; i < city.length; i++) {
if ((city.options[i] != null) && (city.options[i].selected)) {
var found = false;
for(var count = 0; count < len; count++) {
if (destList.options[count] != null) {
if (city.options[i].text == destList.options[count].text) {
found = true;
break;
}
}
}
if (found != true) {
destList.options[len] = new Option(city.options[i].text);
len++;
}
}
}
}

	
if( $('.parentSel').val() != 0 ){
	var aa = 0;
	$('.parentSelOp').each(function(index){
		if( $(this).val() == $('.parentSel').val() ){
			aa = $(this).attr('pval');
		}
	})
	$('#classid').val(aa);
}

$('#classid').click(function(){
	var ind = $(this).val();
	$('.parentSel').val(0);
	$('.parentSelOp').css('display','none');
	$('.parentSelOp').each(function(index){
		
		if( $(this).attr('pval') == ind ){
			$('.parentSelOp').eq(index).css('display','block');
		}
	})
	
})

function deleteFromDestList() {
var destList = window.document.forms[0].destList;
var len = destList.options.length;
for(var i = (len-1); i >= 0; i--) {
if ((destList.options[i] != null) && (destList.options[i].selected == true)) {
destList.options[i] = null;
}
}
} 
              </script>
<select name="province" id="province"></select>
<select name="city" id="city"></select>
<select name="xiancheng" id="xiancheng" onChange="addSrcToDestList()"></select>
<script src="/js/area.js"></script>
<script type="text/javascript">
new PCAS('province', 'city', 'xiancheng', '<?php echo $row['province']?>', '<?php echo $row["city"]?>', '');
</script>            
              
            <input name="oldprovince" type="hidden" id="oldprovince" value="<?php echo $row["province"]?>" /></td>
        
          <td width="100" align="center" valign="top">已选城市
            <select style='width:100px;font-size:13px' size="4" name="destList" multiple="multiple">
                <?php 
		if ($row["city"]!="" &&  $row["city"]!="全国") {
			  if (strpos($row["city"],",")==0) {?>
                <option value="<?php echo $row["city"]?>"><?php echo $row["city"]?></option>
                <?php }else{
			  	$selectedcity=explode(",",$row["city"]);
				for ($i=0;$i<count($selectedcity);$i++){    
				?>
                <option value="<?php echo $selectedcity[$i]?>"><?php echo $selectedcity[$i]?></option>
                <?php }
				}
		}
			?>
              </select>
              <input name="cityforadd" type="hidden" id="cityforadd" />
              <input name="button2" type="button" onClick="javascript:deleteFromDestList();" value="删除已选城市" /></td>
        </tr>
      </table></td>
    </tr>
    <tr id="trcontent"> 
      <td width="130" align="right" class="border">内容</td>
      <td class="border"> 
        <textarea name="content" cols="45" rows="6" id="content"><?php echo stripfxg($row["content"])?></textarea> 
		<script type="text/javascript">CKEDITOR.replace('content');	</script>
        <input name="id" type="hidden" id="dlid" value="<?php echo $row["id"]?>">
        <input name="page" type="hidden" id="page" value="<?php echo $page?>">      </td>
		
    </tr>
	
	
	<!--分界线-->
	<?php
		$sql = 'select * from zzcms_dllist where did='.$id;
		$res = query($sql);
		$dllist = fetch_array($res);
	
	?>
	<tr><td align="right" class="border" style="background:#396eb5;"></td><td align="center" class="border" style="background:#396eb5;font-size:16px;">品牌信息</td></tr> 
	<tr> 
      <td align="right" class="border">项目名称</td>
      <td class="border"> <input name="name" type="text" id="name" size="45" maxlength="45" value="<?php echo $dllist['name']?>" />      </td>
    </tr>
	<tr> 
      <td align="right" class="border">主营项目</td>
      <td class="border"> <input name="title_list" type="text" id="title_list" size="45" maxlength="45" value="<?php echo $dllist['title_list']?>" />      </td>
    </tr>
	<tr> 
      <td align="right" class="border">品牌注册时间</td>
      <td class="border"> 
		<input name="reg_time" type="text" id="reg_time" value="<?php echo date('Y-m-d H:i:s',$dllist['reg_time'])?>" onFocus="JTC.setday(this)">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">店铺数量</td>
      <td class="border"> 
		直营店：
		<input name="store_num" type="text" id="store_num" placeholder="直营店数量" size="10" maxlength="8" value="<?php echo $dllist['store_num']?>"/>
		&nbsp;&nbsp;&nbsp;&nbsp;
		加盟店：
		<input name="join_num" type="text" id="join_num" size="10" placeholder="加盟店数量" maxlength="8" value="<?php echo $dllist['join_num']?>"/> 
		&nbsp;&nbsp;&nbsp;&nbsp;
		申请加盟人数：
		<input name="join_people" type="text" id="join_people" size="10" placeholder="申请加盟人数" maxlength="8" value="<?php echo $dllist['join_people']?>">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">优势标签：</td>
      <td class="border"> 
	   <?php
		$sqln = "select id,title from zzcms_dladvantag order by xuhao asc";
	    $rsn=query($sqln);
        $rown=num_rows($rsn);
		$parent_arr = [];
		$tagArr = explode(',',$dllist['dl_advantag']);
		if (!$rown){
			echo "<a href='dltag.php?dowhat=addbigclass'>添加标签</a>";
		}else{
			
			while($rown = fetch_array($rsn)){
				$parent_arr[] = $rown;
				if( in_array($rown['id'],$tagArr) ){
					echo '<label style="margin-right:15px;"><input type="checkbox" name="advantagArr[]" value="'.$rown['id'].'" checked />'.$rown['title'].'</label>';					
				}else{
					echo '<label style="margin-right:15px;"><input type="checkbox" name="advantagArr[]" value="'.$rown['id'].'" />'.$rown['title'].'</label>';
				}
			}
		}
		?>
		
		</td>
    </tr>
	<tr> 
      <td align="right" class="border">个性标签：</td>
      <td class="border"> 
	   <?php
		$sqln = "select id,title from zzcms_dltag order by xuhao asc";
	    $rsn=query($sqln);
        $rown=num_rows($rsn);
		$parent_arr = [];
		$tagArr = explode(',',$dllist['dl_tag']);
		if (!$rown){
			echo "<a href='dltag.php?dowhat=addbigclass'>添加标签</a>";
		}else{
			
			while($rown = fetch_array($rsn)){
				$parent_arr[] = $rown;
				if( in_array($rown['id'],$tagArr) ){
					echo '<label style="margin-right:15px;"><input type="checkbox" name="dltagArr[]" value="'.$rown['id'].'" checked />'.$rown['title'].'</label>';					
				}else{
					echo '<label style="margin-right:15px;"><input type="checkbox" name="dltagArr[]" value="'.$rown['id'].'" />'.$rown['title'].'</label>';
				}
			}
		}
		?>
		
		</td>
    </tr>
	<tr> 
      <td align="right" class="border">开店金额</td>
      <td class="border"> 
		<input name="price_min" type="text" id="price_min" size="10" value="<?php  echo $dllist['price_min']?>"  placeholder="金额" maxlength="5"> 万 - <input name="price_max" type="text" id="price_max" value="<?php  echo $dllist['price_max']?>" size="10" placeholder="金额" maxlength="5">
	  </td>
    </tr>
	<tr> 
      <td align="right" class="border">开店费用</td>
      <td class="border"> 
		初期预估投入费用：<input name="price_total" type="text" id="price_total" size="10" value="<?php  echo $dllist['price_total']?>" placeholder="金额" maxlength="5"> 万元 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" id="detailsAdd" onclick="detailsAdd(1)" >+ 添加资金简介栏目</span>
		<input type="hidden" name="price_list" value="<?php echo $dllist['price_list']?>" id="detailText" >
		<div id="detailsBox">
			<?php
				if( !empty($dllist['price_list']) ){
					$list = explode('/',$dllist['price_list']);
					foreach( $list as $k=>$item ){
						$li = explode('-',$item);
						echo '<div class="detailsBox" style="margin-top:10px;">资金简介： <input name="" type="text" id="" placeholder="例：管理费/培训费/加盟费" size="30" maxlength="5" value="'.$li[0].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" id="" placeholder="金额" size="10" maxlength="5" value="'.$li[1].'"> - <input name="" type="text" id="" placeholder="金额" size="10" maxlength="5" value="'.$li[2].'"> 万元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="detailDel" style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" >删除</span></div>';
					}
				}
			?>
			<!--div style="margin-top:10px;" class="detailsBox" >
				资金简介： <input name="" type="text" id="" placeholder="例：管理费/培训费/加盟费" size="20" maxlength="5">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="" type="text" id="" placeholder="金额" size="10" maxlength="5">
				-
				<input name="price_max" type="text" id="price_max" placeholder="金额" size="10" maxlength="5"> 万元
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" >删除</span>
			</div-->
		</div>
	  </td>
    </tr>
	<script>
		//点击添加按钮 添加简介选项
		//$('#detailsAdd').click(function(){
		function detailsAdd(status){
			if(status == 1){
				var htmlStr = '<div class="detailsBox" style="margin-top:10px;">资金简介： <input name="" type="text" id="" placeholder="例：管理费/培训费/加盟费" size="30" maxlength="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="text" id="" placeholder="金额" size="10" value="0" maxlength="5"> - <input name="" type="text" id="" placeholder="金额" size="10" value="0" maxlength="5"> 万元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="detailDel" style="padding:5px 20px;background:#396eb5;color:#fff;cursor:pointer;" >删除</span></div>';
				$('#detailsBox').append(htmlStr);
			}
			$('.detailDel').click(function(){
				$(this).parent('div').remove();
				newStr();
				//console.log(aa);
			});
			
			
			$('#detailsBox input').keyup(function(){
				newStr();
			})
		};
		detailsAdd(0);
		//费用简介字符串拼接
		function newStr(){
			var sp = '';
			
			$('#detailsBox input').each(function(index){
				var num = 0;
				num = parseInt(index/3);
				if( index%3 == 0 ){
					if( $(this).val() != '' ){
						sp = sp+'/'+$(this).val();
					}
					//str = str+'-'+sp;
				}else{
					if( $('#detailsBox input').eq(num*3).val() != '' ){
						sp = sp+'-'+$(this).val();
					}
				}
			})
			sp = sp.substr(1);
			console.log(sp);
			$('#detailText').val(sp);
			
		}
		
	</script>
	<!------------ 品牌说(boss 信息和语录 --------------->
	<tr>
		<td align="right" class="border" style="background:#396eb5;"></td>
		<td align="center" class="border" style="background:#396eb5;font-size:16px;">
			品牌说(boss 信息和语录   选填) 
			<span id="bossStatus" style="padding:5px 20px;color:#fff;cursor:pointer;" status='0'>显示</span> 
		</td>
	</tr> 
	<tr class="bossBox"> 
      <td align="right" class="border">boss名称</td>
      <td class="border"> <input name="boss_name" type="text" id="boss_name" size="45" value="<?php  echo $dllist['boss_name']?>" maxlength="45">
	  </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">boss头像： </td>
		<td class="border"> 
			<input name="boss_img"  type="hidden" value="<?php echo $dllist['boss_img'];?>" id="boss_img" >
			<table width="120" style="float:left;margin-right:10px;" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#999999">
			  <tr align="center" bgcolor="#FFFFFF"> 
				<td id="boss_img3" onClick="openwindow('/uploadimg_form.php?noshuiyin=1',400,300,'boss_img','boss_img3')"> 
					<?php if( empty($dllist['boss_img']) ){ 
						echo '<input name="Submit2" type="button"  value="上传图片" />';
					 }else{
						echo '<img src='.$dllist['boss_img'].' width=120>';
					} ?>
				</td>
			  </tr>
			</table>
		</td>
    </tr>
	<tr  class="bossBox"> 
      <td align="right" class="border">籍贯</td>
      <td class="border"> <input name="boss_addr" type="text" id="boss_addr" placeholder="例：北京" size="45" maxlength="45" value="<?php echo $dllist['boss_addr']?>" />      </td>
    </tr>
	<tr  class="bossBox"> 
      <td align="right" class="border">出生日期</td>
      <td class="border"> <input name="boss_birthday" type="text" id="boss_birthday" placeholder="例：1980" size="45" maxlength="45" value="<?php echo $dllist['boss_birthday']?>" />      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">性格</td>
      <td class="border"> <input name="boss_nature" type="text" id="boss_nature" size="45" maxlength="45"value="<?php echo $dllist['boss_nature']?>" />      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">从事过的工作</td>
      <td class="border"> <input name="boss_job" type="text" id="boss_job" size="45" maxlength="45" value="<?php echo $dllist['boss_job']?>" />      </td>
    </tr>
	<tr class="bossBox"> 
      <td align="right" class="border">兴趣</td>
      <td class="border"> <input name="boss_interst" type="text" id="boss_interst" size="45" maxlength="45" value="<?php echo $dllist['boss_interst']?>" />      </td>
    </tr>
	<tr id="trcontent" class="bossBox">  
      <td width="130" align="right" class="border"><!--<?php echo channeldl?>商-->boss演讲</td>
      <td class="border"> 
		<textarea name="boss_content" cols="45" rows="6" id="boss_content" "><?php echo $dllist['boss_content']?></textarea>      
		<script type="text/javascript">CKEDITOR.replace('boss_content');	</script>
	  </td>
    </tr>
	<tr  class=""><td align="right" class="border" style="background:#396eb5;"></td><td align="right" class="border" style="background:#396eb5;"></td></tr> 
	
	
	<script>
		$('#bossStatus').click(function(){
			var status = $(this).attr('status');
			if( status == 1 ){
				$('.bossBox').css('display','none');
				$(this).attr('status',0).html('显示');
			}else{
				$('.bossBox').css('display','');
				$(this).attr('status',1).html('隐藏');
			}
		})
		$('.bossBox').css('display','none');
	</script>
	
	<style>
		.bossBox{
			display:;
		}
	</style>
	
	<!--分界线-->
	
	
	
	
	
    <tr> 
      <td align="right" class="border"><?php echo channeldl?>身份</td>
      <td class="border"><label>
	  <input name="dlsf" type="radio" value="公司" onClick="showsubmenu(1)" <?php if ($row["company"]=="公司") { echo "checked";}?>> 
        公司 </label> 
		<label>
		<input type="radio" name="dlsf" value="个人" onClick="hidesubmenu(1)" <?php if ($row["company"]=="个人"){ echo "checked";}?>> 
        个人</label></td>
    </tr>
    <tr <?php if ($row["company"]=="个人"){ echo " style='display:none'";}?> id='submenu1'> 
      <td align="right" class="border">公司名称</td>
      <td class="border"><input name="companyname" type="text" id="companyname" value="<?php echo $row["companyname"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">真实姓名</td>
      <td class="border"> 
        <input name="truename" type="text" id="truename" value="<?php echo $row["dlsname"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">电话</td>
      <td class="border"><input name="tel" type="text" id="tel" value="<?php echo $row["tel"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">地址</td>
      <td class="border"> 
        <input name="address" type="text" id="address" value="<?php echo $row["address"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr> 
      <td align="right" class="border">E-mail</td>
      <td class="border"><input name="email" type="text" id="email" value="<?php echo $row["email"]?>" size="45" maxlength="255" /></td>
    </tr>
	<tr> 
      <td align="right" class="border">点击数</td>
      <td class="border"><input name="hit" type="text" id="hit" value="<?php echo $row["hit"]?>" size="45" maxlength="255" /></td>
    </tr>
    <tr>
      <td align="right" class="border">审核</td>
      <td class="border"><input name="passed" type="checkbox" id="passed" value="1"  <?php if ($row["passed"]==1) { echo "checked";}?>>
        （选中为通过审核） </td>
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