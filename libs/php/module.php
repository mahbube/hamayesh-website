<?php

// Module funcs ....

defined('ACCESS') or die('Restricted access !');

require_once('db.php');
if($caching_enabled){
	$cache =  new Cache_Lite($cache_options);
	$cache_id = str_replace('/','%',$_SERVER['REQUEST_URI']);
}

function initilize(){
	global $caching_enabled;
	session_start();
	send_header();
	ob_start();
	date_default_timezone_set('Asia/Tehran');
	db_connect();
}

function send_header(){
	global $filetype;
	
	header ( 'Cache-Control: public' );
	header ( 'Pragma: public' );
	header_remove ( 'Expires' );
	
	if($filetype=='css'){
		header('Content-Type: text/css');
	}elseif($filetype=='js'){
		header('Content-Type: text/javascript');
	}else{
		header('Content-Type: text/html');
	}
}

function check_cache(){
	global $cache;
	global $cache_id;
	global $caching_enabled;
	
	if(!$caching_enabled) return false;
	
	if( $contents = $cache->get($cache_id) ){
		send($contents);
		finilize(false);
	}
}

function compress($contents,$compress_level=9){
	global $cache;
	global $cache_id;
	global $gzip_enabled;
	global $caching_enabled;
	
	
	if(!$gzip_enabled) return $contents;
	
	if (substr_count ( $_SERVER ['HTTP_ACCEPT_ENCODING'], 'deflate' )) {
		header ( "Content-Encoding: deflate" );
		$cache_newid=$cache_id.'deflate';
		if($caching_enabled && $data=$cache->get($cache_newid)){
			return $data;
		}else{
			$data = gzdeflate ( $contents, $compress_level );
			$cache->save($data);
			return $data;
		}
	} elseif (substr_count ( $_SERVER ['HTTP_ACCEPT_ENCODING'], 'gzip' )) {
		header ( "Content-Encoding: gzip" );
		$cache_newid=$cache_id.'gzip';
		if($caching_enabled && $data=$cache->get($cache_newid)){
			return $data;
		}else{
			$data = gzencode ( $contents, $compress_level );
			$cache->save($data);
			return $data;
		}
	}else{
		return $contents;
	}
}

function check_midified($contents){
	$etag = md5 ( $contents );
	if (trim ( $_SERVER ['HTTP_IF_NONE_MATCH'] ) == $etag) { // agare etag ghabli ba jadide barabar bood
		header ( "HTTP/1.1 304 Not Modified" );
		death ();
	}else{
		header("Etag: $etag");
	}
}

function checklogin($type){
	return $_SESSION[$type]==1;
}

function dologin($type,$us,$ps){
	$_SESSION[$type]=1;
	$_SESSION[$type.'us']="$us";
	$_SESSION[$type.'ps']="$ps";
}

function dologout($type){
	$_SESSION[$type]=0;
	$_SESSION['us']="";
	$_SESSION['ps']="";
	//$_SESSION = array();
	unset($_SESSION);
	setcookie(session_name(),'',-1);
	session_destroy();
}

//login admin form
function login_admin($us,$ps,$type){
	$chk_us=db_get_rows('login'," username='$us' AND password='$ps'") ;
	$chk_type=db_get_rows('login'," username='$us' AND password='$ps' AND type='$type'") ;
	if($chk_us){
		if($chk_type){
			dologin($type,$us,$ps);
			return('noerr');
		}else{
			return ('err_type');
		}
	}else{
		return ('err_us');
	}
		
}
//admin form:change username
function change_us($us,$ps,$type){
	$user=$_SESSION[$type.'us'];
	$pass=$_SESSION[$type.'ps'];
	db_query("UPDATE login SET username='$us', password='$ps' WHERE type='$type' AND password='$pass' AND username='$user' ");
	go2url( SITE_PATH.'content/home.html');
}
//admin form:add user
function add_us($us,$ps,$type){
	db_query("INSERT INTO login VALUES('','$us','$ps','$type')");
	go2url( SITE_PATH.'content/home.html');
}
//admin form send msg
function send_msg_Admin($sender,$reciever,$subject,$content,$time_send,$date_send){
	db_query("INSERT INTO admin_msg VALUES('','$sender','$reciever','$subject','$time_send','','$date_send','','$content',default)");
	
}
//edite statuse of admin msg
function edit_statuse_msg($id_msg,$time_raed,$date_read){
	db_query("UPDATE admin_msg SET 	statuse='خوانده شده' ,time_read='$time_raed', date_read='$date_read' WHERE id='$id_msg' ");
}
/*start sampleeeeeeeee
function login_user($email,$pass){
	$pass=md5($pass);
	if( db_get_rows('users'," email='$email' AND pass='$pass' ") ){
		dologin();
		return true;
	}
	
	return false;
}

function reg_user($fname,$lname,$email,$pass){
	$pass=md5($pass);
	db_query("INSERT INTO users VALUES('','$fname','$lname','$email','$pass')");
}
end sampleeeeeeee*/

//admin form:edit 
function edit_home($id,$text){
	db_query("UPDATE home_content SET content='$text' WHERE id='$id' ");
	//$msg='عملیات ویرایش با موفقیت انجام شد'; ask1
	go2url( SITE_PATH.'content/home.html');
}
//admin form:send form 0r follow form
function se_fo_article($text){
	db_query("UPDATE home_content SET content='$text' WHERE id='article' ");
	//$msg='فرم مورد نظر شما با موفقیت تایید شد.'; ask1
	go2url( SITE_PATH.'content/home.html');
}

//admin form:add internal page
function add_menu($menu_name,$title,$text,$f_name1,$f_url1,$f_name2,$f_url2,$f_name3,$f_url3){
	db_query("INSERT INTO internal_page VALUES('','$menu_name','$title','$text','$f_url1','$f_name1','$f_url2','$f_name2','$f_url3','$f_name3')");
	//go2url( SITE_PATH.'content/list.html');
}

//admin form:edit internal page
function edit_menu($menu_name,$title,$text,$id,$f_name1,$f_url1,$f_name2,$f_url2,$f_name3,$f_url3){
	db_query("UPDATE internal_page SET menu_name='$menu_name',title='$title',text='$text',url_part1='$f_url1',name_part1='$f_name1' ,url_part2='$f_url2',name_part2='$f_name2' ,url_part3='$f_url3',name_part3='$f_name3' WHERE id='$id' ");
	go2url( SITE_PATH.'content/list.html');
}

//admin: delete menu internal page 
function delete_menu($id){
	$del_item=db_get_rows('internal_page'," id='$id' ") ;
	foreach($del_item as $list){
		@unlink($list['url_part1']);
		@unlink($list['url_part2']);
		@unlink($list['url_part3']);
	}
	db_query("DELETE FROM internal_page WHERE id='$id' ");
	go2url( SITE_PATH.'content/list.html');
}
//admin form :add news
 function add_news($title,$summary,$full_text){
	 db_query("INSERT INTO news VALUES('','$title','$summary','$full_text')");
 }
//admin form: edit news
function edit_news($id,$title,$summary,$full_text){
	db_query("UPDATE news SET title='$title',summary = '$summary' ,full_text= '$full_text' WHERE id='$id' ");
}
//admin: delete news
function delete_news($id){
	db_query("DELETE FROM news WHERE id='$id' ");
}
//delete uploaded files
function delete_file($file){
	@unlink("../hamayesh/upload/$file");
}

function finilize($cacheing=true){
	global $cache;
	global $caching_enabled;
	//database close
	// gzip ..
	$contents = ob_get_clean ();
	
	db_close();
	
	if($caching_enabled && $cacheing) $cache->save($contents);

	check_midified($contents);

	$contents = compress($contents);
	
	$len = strlen ( $contents );
	header ( "Content-length: $len" );

	death($contents);
	
}