<?php
ob_start();//打开缓冲区，可以setcookie
include("../inc/conn.php");
$last = isset($_POST['last'])?$_POST['last']:0;
$amount = isset($_POST['amount'])?$_POST['amount']:20;
setcookie("zs_b",$b,time()+3600*24,"/");
setcookie("zs_s",$s,time()+3600*24,"/");
$b=$_COOKIE['zs_b'];
$s=$_COOKIE['zs_s'];
$px = isset($_COOKIE['pxzs'])?$_COOKIE['pxzs']:"sendtime";
$sql="select id,proname,prouse,img,shuxing_value,province,city,xiancheng,sendtime,editor,elite,userid,comane,qq,groupid,renzheng from zzcms_main where passed=1 ";

$bigclassname="";
$smallclassname="";
if ($b<>""){
$rsn=query("select classname,classid from zzcms_zsclass where classzm='".$b."'");
$rown=fetch_array($rsn);
if ($rown){
$bigclassname=$rown["classname"];
$bigclassid=$rown["classid"];
}
}

if ($s<>"") {
$rsn=query("select classname,classid from zzcms_zsclass where classzm='".$s."'");
$rown=fetch_array($rsn);
if ($rown){
	$smallclassname=$rown["classname"];
	$smallclassid=$rown["classid"];
	}
}

if ($b<>""){
$sql=$sql. "and bigclassid='".$bigclassid."' ";
}

if ($s<>"") {
	if (zsclass_isradio=='Yes'){
	$sql=$sql." and smallclassid ='".$smallclassid."'  ";
	}else{
	$sql=$sql." and smallclassids like '%".$smallclassid."%' ";
	}
}

$sql=$sql." order by groupid desc,elite desc,".$px." desc limit $last,$amount";
//echo $sql;
$rs = query($sql); 
while($row= fetch_array($rs)){

	if (showdlinzs=="Yes") {
	$rsn=query("select id from zzcms_dl where saver='".$row["editor"]."' and passed=1");
	$dl_num=num_rows($rsn);
	}

 $sayList[] = array(
    'title' => "<a href='".getpageurl("zs",$row["id"])."' class='bigbigword'>".$row['proname']."</a>",
    'img' => "<img src='".getsmallimg($row["img"])."' onload='resizeimg(90,90,this)'>",
    'prouse' => cutstr($row['prouse'],30),
	'companyname' => "<a href='".getpageurlzt($row["editor"],$row["userid"])."' target='_blank'>".$row["comane"]."</a>",
	'city' => $row["province"].$row["city"],
	'dl_num' => $dl_num
    );
}
echo json_encode($sayList);
?>