﻿<?php
include("../inc/conn.php");
include("../inc/fy.php");
include("top.php");
include("bottom.php");
include("left.php");

$fp="../skin/".$skin."/job.htm";
if (file_exists($fp)==false){
WriteErrMsg($fp.'模板文件不存在');
exit;
}
$f = fopen($fp,'r');
$strout = fread($f,filesize($fp));
fclose($f);

$bigclass=isset($_REQUEST['bigclass'])?$_REQUEST['bigclass']:"";

$pagetitle=$comane."—招聘";
$pagekeywords=$comane."—招聘";
$pagedescription=$comane."—招聘";


if (isset($_REQUEST["page_size"])){
$page_size=$_REQUEST["page_size"];
checkid($page_size);
setcookie("page_size_job",$page_size,time()+3600*24*360);
}else{
	if (isset($_COOKIE["page_size_job"])){
	$page_size=$_COOKIE["page_size_job"];
	}else{
	$page_size=5;
	}
}

$page=isset($page)?$page:1;
checkid($page);
$job=strbetween($strout,"{job}","{/job}");
$list=strbetween($job,"{loop}","{/loop}");
$sql="select * from zzcms_job where editor='".$editor."' and passed=1 ";
$rs = query($sql); 
$offset=($page-1)*$page_size;//$page_size在上面被设为COOKIESS
$totlenum= num_rows($rs);  
$totlepage=ceil($totlenum/$page_size);

$sql=$sql." order by id desc limit $offset,$page_size";
$rs = query($sql); 
$row= num_rows($rs);//返回记录数
if(!$row){
$strout=str_replace("{job}".$job."{/job}","暂无信息",$strout) ;
}else{
$list2='';
$i=1;
while ($row= fetch_array($rs)){

if (whtml=="Yes"){
$link="/jobs/jobshow-".$row['id'].".htm";
}else{
$link="jobshow.php?cpid=".$row['id'] ;
}
$list2 = $list2. str_replace("{#link}" ,$link,$list) ;
$list2 =str_replace("{#jobname}",cutstr($row["jobname"],8),$list2) ;
$list2 =str_replace("{#comane}",$row["comane"],$list2) ;
$list2 =str_replace("{#province}",$row["province"],$list2) ;
$list2 =str_replace("{#city}",$row["city"],$list2) ;
$list2 =str_replace("{#sendtime}",$row["sendtime"],$list2) ;
$list2 =str_replace("{#sm}",cutstr(nohtml($row['sm']),200),$list2) ;				
$i=$i+1;
}

$strout=str_replace("{loop}".$list."{/loop}",$list2,$strout) ;
$strout=str_replace("{job}","",$strout) ;
$strout=str_replace("{/job}","",$strout) ;
$strout=str_replace("{#fenyei}",showpage_zt("jobs","job"),$strout) ;
}

$strout=str_replace("{#siteskin}",siteskin,$strout) ;
$strout=str_replace("{#sitename}",sitename,$strout) ;
$strout=str_replace("{#siteurl}",siteurl,$strout);
$strout=str_replace("{#pagetitle}",$pagetitle,$strout);
$strout=str_replace("{#pagekeywords}",$pagekeywords,$strout);
$strout=str_replace("{#pagedescription}",$pagedescription,$strout);
$strout=str_replace("{#ztleft}",$siteleft,$strout);
$strout=str_replace("{#showdaohang}",$showdaohang,$strout);
$strout=str_replace("{#skin}",$skin,$strout);

$strout=str_replace("{#sitebottom}",$sitebottom,$strout);
$strout=str_replace("{#sitetop}",$sitetop,$strout);

echo  $strout;
?>