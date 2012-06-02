<?php

// Main site controller and algorithm ....

defined('ACCESS') or die('Restricted access !');
if($caching_enabled){
	require_once('Cache/Lite.php');
}
require_once('module.php');
require_once('date_convert_module.php');
require_once('view.php');

$req = $_GET['req'];
if($req=='') go2url( SITE_PATH.'home.html');

$filename=strtolower( $_GET['filename'] );
$filetype=strtolower( $_GET['filetype'] );

initilize();

$page_title = ucwords( str_replace('-',' ',$req) );
/*sampllllllleeeeeeeeeeee

if(isset($_POST['login'])){
	$caching_enabled=false;
	if( login_user($_POST['email'],$_POST['pass']) ){
		go2url('./');
	}else{
		$err = "User or pass is incorrect.";
	}
}elseif( isset($_POST['reguser']) ){
	$caching_enabled=false;
	if( strlen($_POST['fname'])>2 && strlen($_POST['lname'])>2 && strlen($_POST['email'])>5 && strlen($_POST['pass'])>3 ){
		reg_user($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['pass']);
		go2url('login.html');
	}else{
		$err = "Error in data validation";
	}
	
}

if($req=='users' && !checklogin()){
	go2url('login.html');
}
 middle of sample*/
//upload file
global $err_upload_file;
if(isset($_POST['send_file'])){
	$file=$_FILES['file'];
        if($file['error']==0){
			if($file['size']<20971520){
				//$img_type=strrchr($img["name"],'.');
				$file_name=str_replace(' ','_',$file['name']);
				move_uploaded_file($file["tmp_name"],"../hamayesh/upload/$file_name");
				$err_upload_file='<span>ارسال فایل با موفقیت انجام شد.</span>';
			}else{
				$err_upload_file='<span>فایل منتخب شما نباید بیشتر از 20 مگابایت باشد</span>';
			}		
        }else{
           $err_upload_file='<span>در حین آپلود فایل مشکلی رخ دادهولطفا دوباره ارسال کنید.</span>';
        }	
}

 //login form
 $msg_login='';
 if(isset($_POST['login'])){
	$caching_enabled=false;
	$res_login=login_admin($_POST['us'],$_POST['ps'],$_POST['type']);
	if($res_login=='noerr'){
		go2url( SITE_PATH.$_POST[type].'/home.html');
	}elseif($res_login=='err_us'){
		$msg_login.='<div class="err">نام کاربری و رمز عبور صحیح نمیباشند</div>';
	}elseif($res_login=='err_type'){
		$msg_login.='<div class="err">شما با این رمز عبور مجاز به دسترسی به این قسمت نمی باشید</div>';
	}
}
//admin form send msg
if(isset($_POST['newmsg'])){
	$time_send=date("G:i:s");
	$date_send=jdate("Y/m/d", strtotime(date("m/d/y")));
	send_msg_Admin($_POST['sender'],$_POST['reciever'],$_POST['subject'],$_POST['content'],$time_send,$date_send);
	
}
//admin edit statuse of msg
if(isset($_POST['msg_read'])){
	$time_read=date("G:i:s");
	$date_read=jdate("Y/m/d", strtotime(date("m/d/y")));
	edit_statuse_msg($_POST['id_msg'],$time_read,$date_read);
}
//admin form: edit first page
if(isset($_POST['home_con'])){
	edit_home($_POST['id'],$_POST['text']);
	//$msg='عملیات ویرایش با موفقیت انجام شد' hijjaaa		
}
//admin form: send article form or follow article form
if(isset($_POST['se_fo_article'])){
	se_fo_article($_POST['article']);
	//$msg='عملیات ویرایش با موفقیت انجام شد' hijjaaa		
}
//admin form :upload poster
global $err_upload ;
if(isset($_POST['poster'])){
	$img=$_FILES['p-img'];
        if($img['error']==0){
            if(strpos($img['type'],'image/')===0){
                if($img['size']<20971520){
					//$img_type=strrchr($img["name"],'.');
                    move_uploaded_file($img["tmp_name"],"../hamayesh/img/poster.jpg");
					$err_upload='<span>ارسال فایل با موفقیت انجام شد.</span>';
                }else{
                    $err_upload='<span>فایل منتخب شما نباید بیشتر از 20 مگابایت باشد</span>';
                }
            }else{
                $err_upload='<span>ایل منتخب شما باید عکس باشد.</span>';
            }
        }else{
           $err_upload='<span>در حین آپلود فایل مشکلی رخ دادهولطفا دوباره ارسال کنید.</span>';
        }
	
}
//admin form: add internal page
global $attache_err1;
global $attache_err2;
global $attache_err3;

if(isset($_POST['add_menu'])){
	$noerr=1;
	
	if(isset($_FILES['part1_file'])){
		$attached1=$_FILES['part1_file'];
		 if($attached1['error']==0){
			 $a=$attached1['size'];
			 if($attached1['size']< 20971520){
				 $file_name1=str_replace(' ','_',$attached1["name"] );
				 $file_url1="/hamayesh/download/".$file_name1;//bade download/download".  strrchr($file_name,'.') ;
				 move_uploaded_file($attached1["tmp_name"],"..".$file_url1);
			 }else{
				 $noerr=0;
				 $attache_err1='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 $attache_err1=$attached1['error'];
		 }
	}
	if(isset($_FILES['part2_file'])){
		$attached2=$_FILES['part2_file'];
		 if($attached2['error']==0){
			 if($attached2['size']< 20971520){
				 $file_name2=str_replace(' ','_',$attached2["name"] );
				 $file_url2="/hamayesh/download/".$file_name2;//bade download/download". strrchr($file_name,'.') ;
				 move_uploaded_file($attached2["tmp_name"],"..".$file_url2);
			 }else{
				 $noerr=0;
				 $attache_err2='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 $attache_err2=$attached2['error'];
		 }
	}
	if(isset($_FILES['part3_file'])){
		$attached3=$_FILES['part3_file'];
		 if($attached3['error']==0){
			 if($attached3['size']< 20971520){//20Mb
				 $file_name3=str_replace(' ','_',$attached3["name"] );
				 $file_url3="/hamayesh/download/".$file_name3;//bade download/download". strrchr($file_name,'.') ;
				 move_uploaded_file($attached3["tmp_name"],"..".$file_url3);
			 }else{
				 $noerr=0;
				 $attache_err3='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 
			 $attache_err3=$attached3['error'];
		 }
	}
	($_POST['title']) ? $title=$_POST['title'] : $title=$_POST['menu_name'] ;
	if($noerr==1)
		add_menu($_POST['menu_name'],$title,$_POST['text'],$file_name1,$file_url1,$file_name2,$file_url2,$file_name3,$file_url3);
	//$msg='مطلب با موفقیت به صفحه اضافه شد';//ask1
}

//admin form:edit internal page
if(isset($_POST['edit_menu'])){
	$noerror=1;
	if(isset($_FILES['part1_file'])){
		$attached1=$_FILES['part1_file'];
		 if($attached1['error']==0){
			 if($attached1['size']< 20971520){
				 $file_name1=$attached1["name"] ;
				 $file_url1="./download/".$file_name1;//bade download/download". strrchr($file_name,'.') ;
				 move_uploaded_file($attached1["tmp_name"],$file_url1);
			 }else{
				 $noerror=0;
				 $attache_err1='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 $attache_err1=$attached1['error'];
		 }
	}else{
		$file_name1=$_POST['part1_name'];
		$file_url1=$_POST['part1_url'];		
	}
	if(isset($_FILES['part2_file'])){
		$attached2=$_FILES['part2_file'];
		 if($attached2['error']==0){
			 if($attached2['size']< 20971520){
				 $file_name2=$attached2["name"] ;
				 $file_url2="./download/".$file_name2;//bade download/download". strrchr($file_name,'.') ;
				 move_uploaded_file($attached2["tmp_name"],$file_url2);
			 }else{
				 $noerror=0;
				 $attache_err2='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 $attache_err2=$attached2['error'];
		 }
	}else{
		$file_name2=$_POST['part2_name'];
		$file_url2=$_POST['part2_url'];		
	}
	if(isset($_FILES['part3_file'])){
		$attached3=$_FILES['part3_file'];
		 if($attached3['error']==0){
			 if($attached3['size']< 20971520){//20Mb
				 $file_name3=$attached3["name"] ;
				 $file_url3="./download/".$file_name3;//bade download/download". strrchr($file_name,'.') ;
				 move_uploaded_file($attached3["tmp_name"],$file_url3);
			 }else{
				 $noerror=0;
				 $attache_err3='حجم فایل نباید بیش از 20 مگابایت باشد';
			 }
		 }else{
			 $attache_err3=$attached3['error'];
		 }
	}else{
		$file_name3=$_POST['part3_name'];
		$file_url3=$_POST['part3_url'];		
	}
	if($noerror==1){
		($_POST['title']) ? $title=$_POST['title'] : $title=$_POST['menu_name'] ;
		if(edit_menu($_POST['menu_name'],$title,$_POST['text'],$_POST['id'],$file_name1,$file_url1,$file_name2,$file_url2,$file_name3,$file_url3))
			$msg='ویرایش متن با موفقیت صورت گرفت';
	}
}
//admin form :add news
if(isset($_POST['send_news'])){
	add_news($_POST['ttl_news'],$_POST['summary'],$_POST['full_text']);
}
//admin form: edit news
if(isset($_POST['edit_news'])){
	edit_news($_POST['id_news'],$_POST['ttl_news'],$_POST['summary'],$_POST['full_text']);
}
//admin form :change username 
if(isset($_POST['chg_user'])){
	if(change_us($_POST['us'],$_POST['ps'],$_POST['type'])){
		$msg='مشخصات کاربری با موفقیت تغییر کرد';
	}
}
//admin form : add user
if(isset($_POST['add_user'])){
	if(add_us($_POST['us'],$_POST['ps'],$_POST['type'])){
		$msg='کاربر جدید با موفقیت ثبت شد.';
	}
}

check_cache();

if($req=='file'){
	if( $file = @file_get_contents("./libs/$filetype/$filename.$filetype") ){
		send($file);
		finilize();
	}else{
		$req = '404er';
		header('Content-Type: text/html');
	}
}elseif($req=='home'){
	$about=db_get_rows('home_content',"id='about'");
	foreach($about as $list){
		$about=$list['content'];
	}
	$register=db_get_rows('home_content',"id='register'");
	foreach($register as $list){
		$register=$list['content'];
	}
	$time=db_get_rows('home_content',"id='time'");
	foreach($time as $list){
		$time=$list['content'];
	}
	$contact=db_get_rows('home_content',"id='contact'");
	foreach($contact as $list){
		$contact=$list['content'];
	}
	$article=db_get_rows('home_content',"id='article'");
	foreach($article as $list){
		$article=gen_article_form($list['content']);
	}
	
}elseif($req=='internal' ){
	$menu=$_GET['menu'];
	$menu_internal=db_get_rows('internal_page');
	$menu_content=gen_menu_internal($menu_internal);
	if($menu=='news'){
		$id_news=$_GET['idnews'];
		$ttl_news=$_GET['ttlnews'];
		$content=gen_internal_news($id_news,$ttl_news);
	}elseif($menu=='home'){
		$content=gen_content_internal('about');
	}else{
		$content_internal=db_get_rows('internal_page',"id='$menu'");
		$content=gen_content_internal($content_internal);
	}
	
}elseif($req=='content'){//admin panel content manager
	if(!checklogin('content')){
		go2url( SITE_PATH.'login.html');
	}else{
		$menu=$_GET['menu'];
		$detail_msg=substr($menu,0,5-strlen($menu));
		$home_menu=db_get_rows('home_content',"id='$menu'") ;
		if($home_menu){
			$admin_content=gen_content('home',$home_menu);
		}elseif($menu=='add' || $menu=='list'){
			$admin_content=gen_content('internal',$menu);
		}elseif($menu=='add_news' || $menu=='list_news'){
			$admin_content=gen_content('news',$menu);
		}elseif(strpos($menu,'ews_edit')==1){
			$admin_content=gen_content('news_edit',substr($menu,10));
		}elseif(strpos($menu,'ews_delete')==1){
			delete_news(substr($menu,12));
			go2url( SITE_PATH.'content/list_news.html');
		}elseif(strpos($menu,'dit')==1){
			$admin_content=gen_content('edit',substr($menu,5));
		}elseif(strpos($menu,'elete')==1){
			delete_menu(substr($menu,7));
		}elseif($menu=='newmsg'){
			$admin_content=gen_msg_form('مدیر-محتوای-سایت');
		}elseif($detail_msg=='semsg' || $detail_msg=='remsg' ){
			$action=substr(strstr($menu,'-'),1,strlen(strrchr($menu,'-'))*-1);
			$id_msg=substr(strrchr(strstr($menu,'-'),'-'),1);
			if($action=='see'){
				$admin_content=gen_detail_msg("$id_msg",'مدیر-محتوای-سایت');
			}elseif($action=='delete'){
				$admin_content='delete the msg';
			}
		}elseif($menu=='semsg'){
			$admin_content=gen_send_msg('مدیر-محتوای-سایت');			
		}elseif($menu=='remsg'){
			$admin_content=gen_recieve_msg('مدیر-محتوای-سایت');
		}elseif($menu=='chgus'){
			$admin_content=gen_user_form('content','chg');
		}elseif($menu=='addus'){
			$admin_content=gen_user_form('content','add');
		}elseif(strpos($menu,'pdel')==1){
			delete_file(substr($menu,6));
			go2url( SITE_PATH.'content/uplist.html');	
		}elseif($menu=='uplist'){
			$d="../hamayesh/upload/";
			$dirs = scandir($d); 
		foreach($dirs as $dir){ 
            if ($dir === '.' || $dir === '..'){ 
                continue; 
			}
			if(is_file("$d/$dir")) {
				$dd=strpbrk($d,'/hamayesh');
				$result[]="$dd"."$dir";
				continue;
			}
		}
			$admin_content=gen_upload_form($menu,$result);
		}elseif($menu=='upnew'){
			$admin_content=gen_upload_form($menu,'');
		}elseif($menu=='logout'){
			dologout('content');
			go2url( SITE_PATH.'home.html');
		}
	}
}elseif($req=='support'){
	if(!checklogin('support')){
		go2url( SITE_PATH.'login.html');
	}else{
		$con_admin='supportttttttt';
	}
}elseif($req=='refree'){
	if(!checklogin('refree')){
		go2url( SITE_PATH.'login.html');
	}else{
		$con_admin='refreeeeeeee';
	}
}
/*elseif($req=='users'){
	$users_arr = db_get_rows('users'); // array
	$users_list = gen_users_list($users_arr); // html
	
}elseif($req=='downloads'){
	if( $downloads_arr = db_get_rows('downloads') ){
		$downloads_list = gen_download_list($downloads_arr);  // gen output
	}
}elseif($req=='logout'){
	dologout();
	go2url('./');
}*/
include('template.php');

finilize();
