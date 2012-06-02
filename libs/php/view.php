<?php

// View funcs ....

defined('ACCESS') or die('Restricted access !');

function send($data){
	echo $data;
}

function death($data){
	if(strlen($data)>0) send($data);
	die();
}

function go2url($url){
	header("Location: $url");
	death();
}
/*sampleeeeeeeeeeee
function gen_users_list($arr){
	$html='<ul>';
	
	foreach($arr as $user){
		$html.="<li><a href='mailto:$user[email]'>$user[fname] $user[lname]</a></li>";
	}
	
	$html.='</ul>';
	return $html;
}

function gen_download_list($arr){
	$html='<ul>';
	
	foreach($arr as $link){
		$html.="<li><a href='$link[url]'>$link[title]</a><span>$link[desc]</span></li>";
	}
	
	$html.='</ul>';
	return $html;
}end sampleeeee*/


//admin content return button
function gen_return_link($type){
	$html="
	<span class='return'>
     	<a href='/hamayesh/$type/home.html'>بازگشت</a>
    </span>";
	return $html;
}

//chg or add user form for all admin 
function gen_user_form($type,$operation){
	$html .=gen_return_link($type);
	if($operation=='chg') $html.="<p class='ttl'>تغییر نام کاربری و رمز عبور</p>";
	elseif($operation=='add') $html.="<p class='ttl'>اضافه کردن کاربر جدید برای ورود به این قسمت</p>";
	
	$n_submit=$operation.'_user';
	$html.="<form method='post' action='' class='user_form' onsubmit='return chkValidate(this)' >
        	<table>
            	<tr>
                	<td>نام کاربری</td>
                    <td>
                    	<input type='text' name='us' class='us' onblur='return validate(this,\"notEmpty\",\"نام کاربری را تعیین کنید.\",\"1\")'/>
                    </td>
					<td>
						<span class='us_img correct' id='ff'></span>
					</td>
                </tr>
                <tr>
                	<td colspan='3'>
						<span class='us_msg'></span>
					</td>
                </tr>
                <tr>
                	<td>رمز عبور</td>
                    <td>
                    	<input type='password' name='ps' class='ps' id='pass' onblur='return validate(this,\"notEmpty\",\"رمز عبور را با 3الی 12 کاراکتر تعیین کنید.\",\"3\",\"12\")'/>
                    </td>
					<td>
						<span class='ps_img correct' ></span>
					</td>
                </tr>
                <tr>
                	<td colspan='3'><span class='ps_msg'></span></td>
                </tr>
                <tr>
                	<td>رمز عبور تکرار</td>
                    <td>
                    	<input type='password' name='ps_rpt' class='psConf' onblur='return validate(this,\"confirm\",\"دو مقدار وارد شده مشابه نیستند.\",\"3\",\"12\",\"pass\")' />
                    </td>
					<td>
						<span class='psConf_img correct'></span>
					</td>
                </tr>
                <tr>
                	<td colspan='3'><span class='psConf_msg'></span></td>
                </tr>
                <tr>
                	<td colspan='3'>
                    	<input type='hidden' name='type' value='$type'/>
                    	<p style='text-align:center'>
                        	<input type='submit' name='$n_submit' value='ارسال'/>
                        </p>
                    </td>
                </tr>
                
            </table>
        </form>";
		return $html;
}
//admin :generate form send msg
function gen_msg_form($sender){
	$html .=gen_return_link('content');
	$html .="<span class='ttl'>ارسال پیام برای مدیران دیگر</span>";
	$html .="<div class='msg_Admin'><form action='' method='post' onsubmit='return chkValidate(this)' >
		<table>
			<tr>
				<td>گیرنده</td>
				<td>
					<select name='reciever' onblur='return validate(this,\"select\",\"گیرنده پیغام را مشخص کنید.\")' class='slct'>
						<option value='select'>انتخاب</option>";
				if($sender=='مدیر-محتوای-سایت'){
					$html.="
						<option value='مدیر-اصلی-سایت'>مدیر اصلی سایت</option>
						<option value='داوران-سایت'>داوران سایت</option>
					</select>";
				}elseif($sender=='مدیر-اصلی-سایت'){
					$html.="
						<option value='مدیر-محتوای-سایت'>مدیر محتوای سایت</option>
						<option value='داوران-سایت'>داوران سایت</option>
					</select>";
				}elseif($sender=='داوران-سایت'){
					$html.="
						<option value='مدیر-محتوای-سایت'>مدیر محتوای سایت</option>
						<option value='مدیر-اصلی-سایت'>مدیر اصلی سایت</option>
					</select>";
				}
				$html.="<input type='hidden' value=$sender name='sender'  />
				</td>
				<td style='min-width: 310px;'>
					<span class='slct_img correct'></span>	
				</td>
			</tr>
			<tr>
				<td colspan='3'><span class='slct_msg'></span></td>
			</tr>
			<tr>
				<td>موضوع</td>
				<td>
					<input type='text' name='subject' class='sub' onblur='return validate(this,\"notEmpty\",\"موضوع پیغام را تعیین کنید.\")'  />
				</td>
				<td style='min-width: 310px;'>
					<span class='sub_img correct'></span>
				</td>				
			</tr>
			<td colspan='3'><span class='sub_msg'></span></td>
			<tr>
				<td>متن پیام</td>
				<td colspan='2'>
					<textarea name='content'/></textarea>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<p style='text-align:center'>
						
						<input type='submit' name='newmsg' value='ارسال'/>
					</p>
				</td>
			</tr>		
		</form></table></div>";
		return $html;
}
//admin:list of msg that what sended
function gen_send_msg($sender){
	$html .=gen_return_link('content');
	$html .="<span class='ttl'>لیست پیام های فرستاده شده</span><br/><br/>";
	$list_msg=db_get_rows("admin_msg","sender='$sender'");
			if($list_msg){
				$html.="<table id='msg'>
						<tr class='tr-first'>
							<td>گیرنده</td>
							<td>موضوع</td>
							<td>وضعیت</td>
							<td>مشاهده</td>
							<td>حذف پیام</td>
						</tr>";
				foreach($list_msg as $list){
					$reciever=str_replace('-',' ',$list['reciever']);
					$html.="
					<tr>
						<td>$reciever</td>
						<td>$list[subject]</td>
						<td>$list[statuse]</td>
						<td>
							<a href='./semsg-see-$list[id].html'>مشاهده</a>
						</td>
						<td>
							<a href='./semsg-delete-$list[id].html'>حذف پیام</a>
						</td>
					</tr>" ;
				}
				$html.="</table>";
			}else{
				$html.='هیچ پیامی فرستاده نشده است.';
			}
			return $html;
}

//admin:list of msg that what recieved
function gen_recieve_msg($reciever){
	$html .=gen_return_link('content');
	$html .="<span class='ttl'>لیست پیام های دریافت شده</span><br/><br/>";
	$list_msg=db_get_rows("admin_msg","reciever='$reciever'");
			if($list_msg){
				$html.="<table id='msg' >
						<tr class='tr-first'>
							<td>گیرنده</td>
							<td>موضوع</td>
							<td>وضعیت</td>
							<td>مشاهده</td>
						</tr>";
				foreach($list_msg as $list){
					$reciever=str_replace('-',' ',$list['reciever']);
					$html.="
					<tr>
						<td>$reciever</td>
						<td>$list[subject]</td>
						<td>$list[statuse]</td>
						<td>
							<a href='./remsg-see-$list[id].html'>مشاهده</a>
						</td>						
					</tr>" ;
				}
				$html.="</table>";
			}else{
				$html.='هیچ پیامی دریافت نشده است.';
			}
			return $html;
}
//admin: show detail of msg
function gen_detail_msg($id_msg,$se_re){
	$html .=gen_return_link('content');
	$html .="<span class='ttl'>مشاهده جزییات پیام</span>";
	$html .="<div class='detail_msg'>";
	$detail_msg=db_get_rows("admin_msg","id='$id_msg'");
	foreach($detail_msg as $list){
		$sender=str_replace('-',' ',$list['sender']);
		$reciever=str_replace('-',' ',$list['reciever']);
		$html.="پیام توسط <font color='#bc3325'>$sender </font>در تاریخ <font color='#bc3325' > $list[date_send]</font> ساعت <font color='#bc3325'>$list[time_send]</font> برای <font color='#bc3325'>$reciever</font> فرستاده شده است.<br/> ";
		if($list['statuse']=='خوانده نشده'){
			$html.="پیام هنوز خوانده نشده است. ";
		}else{
			$html.="پیام در تارخ<font color='#bc3325'> $list[date_read] </font>ساعت <font color='#bc3325'>$list[time_read]</font> خوانده شده است.<br/>";
		}
		$html.="<br/>موضوع پیام :<font color='#bc3325'> $list[subject]</font><br/>";
		$html.="متن پیام :<br/> $list[content]";
	}
	if($se_re==$list['reciever']){
		$html.="<form action='./remsg.html' method='post'>
			<input type='hidden' value=$id_msg  name='id_msg'/>
			<input type='submit' value='خوانده شد' name='msg_read' />
		</form>";
		$html .="<br/><div class='return'><a href='./remsg.html'> بازگشت به لیست پیام های دریافت شده</a></div>";
	}elseif($se_re==$list['sender']){
		$html .="<br/><div class='return'><a href='./semsg.html'> بازگشت به لیست پیام های فرستاده شده</a></div>";
	}
	$html.="</div>";
	return $html;
}
//upload form admin content
function gen_upload_form($menu,$result){
	$html .=gen_return_link('content');
	if($menu=='upnew'){//form upload image or other type of file
		$html .="<span class='ttl'>فرم آپلود فایل</span>";
		$html .="<span><br/><br/>شما در این قسمت میتوانید هر نوع فایلی را آپلود کنید و از فابل آپلود شده با استفاده از ابزار <font color='red'><i>ویرایش متن</i></font> در قسمت های دیگر استفاده کنید.<br/> به عنوان مثال فرض میشود شما از این قسمت فایلی را با نام   <font color='red'><i> pic.jpg </i></font> آپلود کردید و میخواهید این عکس بین نوشته های متن <font color='red'><i>تماس با ما</i></font> در صفحه اول نمایش داده شود.برای این منظور کافی است در قسمت ویرایش متن تماس با ما روی دکمه <font color='red'><i>Insert Image</i></font> ابزار ویرایش متن کلیک کرده و در قسمت URL بنویسید &nbsp;&nbsp;&nbsp;<font color='red' dir='ltr'><i>/hamayesh/upload/pic.jpg</i></font><br/><br/><font color='red'><i>توجه :</i></font> نام فایل ارسالی را حتما با حروف انگلیسی تعیین کنید.</span> ";
		$html .="
		<div id='dialog' title='فرم آپلود فایل'>
			<form action='./uplist.html' method='post' class='upload_form' enctype='multipart/form-data' onsubmit='return chkValidate(this)'> 
				انتخاب فایل:<input type='file' name='file' onblur='return validate(this,\"eng\",\"نام فایل را کوتاه و با حروف انگلیسی تعیین کنید.\")' class='up' />
				<input type='submit' name='send_file' value='ارسال'><br/>
				$err_upload_file
				<br/><span class='up_img correct' style='float:right'></span>
				<span class='up_msg' style='margin-right:27px;margin-top:5px'></span>		
			</form>
		</div>";
	}else if($menu=='uplist'){//list files that uploaded ntil now
		
		$html .="<span class='ttl'>لیست فایل های آپلود شده</span>";
		$html.="<br/><br/><span>در این قسمت لیست فایل هایی را که تا به اکنون آپلود کرده اید مشاهده می شود. اکیدا توصیه میشود برای صرفه جویی در فضای مورد استفاده فایل های اضافی را حذف کنید. </span>";
		if(count($result)==0){
			$html.="<br/><br/><span class='ttl'>فایل آپلود شده ای وجود ندارد</span>";
		}else{
			$html.="<table class='file' >
						<tr class='tr-first'>
							<td>فایل</td>
							<td>URL</td>
							<td>حذف</td>
						</tr>";
		}
		$c=0;
		
		while($c<count($result)){//<br/><a href=../upload/$entry />$entry</a>
		foreach($result as $entry){
			$html.="
				<tr>
					<td>";
					$pos1=strpos($entry,'jpg');
					$pos2=strpos($entry,'jpeg');
					$pos3=strpos($entry,'gif');
					$pos4=strpos($entry,'png');
					$pos5=strpos($entry,'jpe');
					$pos6=strpos($entry,'bmp');
					$file_name=substr(strrchr($entry,'/'), 1);
					//$entry=str_replace(' ','_',$entry);
					if($pos1 === false && $pos2 === false && $pos3 === false && $pos4 === false && $pos5 === false && $pos6 === false ){
						$html.="<a href=$entry >$file_name</a></td>" ;
					}else{
						$html.="<img width='150' src=$entry /></td>" ;
					}
					$html.="<td dir='ltr'>/hamayesh/upload/$file_name</td>
					<td><a href=/hamayesh/content/updel-$file_name.html>حذف</a></td>
				</tr>";
				$c++;
		}
			
		}
		$html.="</table>";
		//achive files in upload folder in a diffrent way
		/*if ($handle = opendir('../hamayesh/upload/')){
			while (false !== ($entry = readdir($handle))) {
				if($entry !='.' && $entry !='..'){
					$html.= "<br/><a href=../upload/$entry />$entry</a>";
				}
    		}
		}
		closedir($handle);*/
	}
	return $html;
}
//content of admin content page :menu edit firstpage & internal page
function gen_content($page,$menu){
	global $err_upload ;
	$html='';
	$html .=gen_return_link('content');
	if($page=='home'){
		foreach($menu as $name){
			$html .="<span class='ttl'>ویرایش متن:&nbsp;&nbsp;
			$name[menu]</span><br/><br/>" ;
			if($name['id']=='article'){
				$html.="
				<span><br/>
				در این قسمت تعیین کنید که در قسمت <b>مقالات</b> صفحه اول سایت فرم پیگیری مقالات رویت شود یا فرم ارسال مقالات.
				</span><br/><br/><br/>
				<form action='' method='post' class='se_fo_article'>
					مشاهده فایل ارسال مقالات
					<input type='radio' name='article' value='send_article'/><br/>
					مشاهده فرم پیگیری مقالات					
					<input type='radio' name='article' value='follow_article'/><br/><br/>
					<input type='submit' name='se_fo_article' value='تایید'/>									
				</form>
				";
			}else{
				if($name['id']=='about'){
					$html.="
					<form method='post' action='' enctype='multipart/form-data'>
						ارسال پوستر : <input type='file' name='p-img'/>
						<input type='submit' name='poster' value='ارسال پوستر'/><br/>
						$err_upload
					</form>";
				}			
				$html .="<br/><table>
				<form action=''  method='post'>
					<input type='hidden' name='id' value='$name[id]'/>
					<tr>
						<td>ویرایش متن&nbsp;&nbsp;&nbsp;</td>
						<td>
							<textarea name='text' cols='50' rows='30' >$name[content]</textarea>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<p style='text-align:center;'>
								<input type='submit' value='ارسال' name='home_con'/>
							</p>
						</td>
					</tr>        	
				</form>
			</table>";
				}
			
		}
	}else if($page=='internal'){
		global $attache_err1 ;
		if($menu=='add'){
			$html .="
			<div class='add'>
        	<p class='ttl'>افزودن مطلب جدید به صفحه داخلی سایت</p><br/>
        	<form action='' method='post' enctype='multipart/form-data' onsubmit='return chkValidate(this)' >
            	<table>
                	<tr>
                    	<td>نام منو</td>
                        <td>
                        	<input type='text' name='menu_name' onblur='return validate(this,\"notEmpty\",\"برای منو نامی با حداکثر طول 30 کاراکتر تعیین کنید.\",\"3\",\"30\")' class='name'/>
                        </td>
						<td>
							<span class='name_img correct'></span>
						</td>
                    </tr>
                    <tr>
                    	<td colspan='3'>
							<span class='name_msg'></span>
						</td>
                    </tr>
                    <tr>
                    	<td>عنوان مطلب</td>
                        <td>
                        	<input type='text' name='title' />
                        </td>
						<td > در صورت خالی گذاشتن این فیلد، عنوان مطلب ارسالی همان نام منو خواهد بود.</td>
                    </tr>
                    <tr>
						<td colspan='4'></td>
					</tr>
                    <tr>
                    	<td>مطلب</td>
                        <td colspan='2'>
                        	<textarea name='text' cols='80' rows='15' id='editor1' class='fontha' style='border-radius:0.25em;'  onblur='return validate(this,\"notEmpty\",\"تعیین محتوا برای مطلب الزامی است.\",\"8\")' ></textarea>
                        </td>
						<td>
							<span class='fontha_img correct'></span>
						</td>
                    </tr>
                    <tr>
                    	<td colspan='3'>
							<span class='fontha_msg'></span>
						</td>
                    </tr>
					<tr>
                    	<td colspan='4'>اگر مایلید بازدید کننده سایت بتواند فایلی را در این قسمت دانلود کند میتوانید آن را از قسمت زیر آپلود کنید.</td>
                    </tr>
					<tr>
                    	<td style='white-space:nowrap;'>بخش اول فایل</td>
                        <td >
                        	<input type='file' name='part1_file'/>
                        </td>
                    </tr>
					<tr>
                    	<td colspan='2'>$attache_err1</td>
                    </tr>
					<tr>
                    	<td style='white-space:nowrap;'>بخش دوم فایل</td>
                        <td>
                        	<input type='file' name='part2_file'/>
                        </td>
                    </tr>
					<tr>
                    	<td colspan='2'>$attache_err2</td>
                    </tr>
					<tr>
                    	<td style='white-space:nowrap;'>بخش سوم فایل</td>
                        <td>
                        	<input type='file' name='part3_file'/>
                        </td>
                    </tr>
					<tr>
                    	<td colspan='2'>$attache_err3</td>
                    </tr>
                    <tr>
                    	<td colspan='2'>
                        	<p style='text-align:center'>
                            	<input type='submit' name='add_menu' value='ارسال'/>
                            </p>	
                        </td>                        
                    </tr>
                </table>
            </form>
        </div>" ;
		}elseif($menu=='list'){
			$html .=/*<div class='list'>*height (yadet nare bebandish)...ask3*/"
			<p class='ttl'>لیست  مطالب موجود در صفحه داخلی </p><br/>
			<div class='tr-first'>
            	<div class='td'>نام منو</div>
                <div class='td'>عنوان مطلب</div>
                <div class='td'>عملیات</div>
            </div>";
			$list_text=db_get_rows('internal_page');
			if($list_text){
				foreach($list_text as $list){
				$html .="
				<div class='tr'>
					<div class='td'>$list[menu_name]</div>
					<div class='td'>$list[title]</div>
					<div class='td'>
						<a href='/hamayesh/internal/$list[id].html' target='_new'>مشاهده</a>&nbsp;&nbsp;
						<a href='/hamayesh/content/edit-$list[id].html'>ویرایش</a>&nbsp;&nbsp;
						<a href='/hamayesh/content/delete-$list[id].html'>حذف</a>
					</div>
				</div>";
				}
			}else{
				$html .="<br/><br/><p class='ttl'>صفحه داخلی سایت شامل منو و مطلبی نمیباشد</p>";
			}
            
        $html.="<div class='clear'></div>";
		}
	}elseif($page=='edit'){
		$edit_text=db_get_rows('internal_page'," id='$menu' ");
		foreach($edit_text as $list){
			$html .="
			<div class='add'>
				<p class='ttl'>ویرایش مطلب انتخابی</p><br/>
				<form action='' method='post' enctype='multipart/form-data' onsubmit='return chkValidate(this)'>
					<table>
						<tr>
							<td>نام منو</td>
							<td>
								<input type='text' name='menu_name' value='$list[menu_name]' onblur='return validate(this,\"notEmpty\",\"برای منو نامی با حداکثر طول 30 کاراکتر تعیین کنید.\",\"3\",\"30\")' class='name'/>
								<input type='hidden' name='id' value='$list[id]'/>
							</td>
							<td>
								<span class='name_img correct'></span>
							</td>
						</tr>
						<tr>
							<td colspan='3'>
								<span class='name_msg'></span>
							</td>
						</tr>
						<tr>
							<td>عنوان مطلب</td>
							<td>
								<input type='text' name='title'value='$list[title]'/>
							</td>
							<td>در صورت خالی گذاشتن این فیلد، عنوان مطلب ارسالی همان نام منو خواهد بود.</td>
						</tr>
						<tr>
							<td colspan='4'></td>
						</tr>
						<tr>
							<td>مطلب</td>
							<td colspan='2'>
								<textarea name='text' cols='80' rows='15' id='editor1' class='fontha' style='border-radius:0.25em;' onblur='return validate(this,\"notEmpty\",\"تعیین محتوا برای مطلب الزامی است.\",\"8\")'>$list[text]</textarea>
							</td>
							<td>
								<span class='fontha_img correct'></span>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<span class='fontha_msg'></span>
							</td>
						</tr>";
						if($list['url_part1']){
							$html .="
							<tr>
								<td colspan='2'>
									<a href='$list[url_part1]'>بخش اول فایل برای دانلود</a>
									<input type='hidden' name='part1_url' value='$list[url_part1]'/>
									<input type='hidden' name='part1_name' value='$list[name_part1]'/>
								</td>
							</tr>" ;
						}else{
							$html .="
							<tr>
                    			<td style='white-space:nowrap;'>بخش اول فایل</td>
                        		<td >
                        			<input type='file' name='part1_file'/>
                        		</td>
                    		</tr>
							<tr>
                    			<td colspan='2'>$attache_err1</td>
                    		</tr>";
						}
						if($list['url_part2']){
							$html .="
							<tr>
								<td colspan='2'>
									<a href='$list[url_part2]'>بخش دوم فایل برای دانلود</a>
									<input type='hidden' name='part2_url' value='$list[url_part2]'/>
									<input type='hidden' name='part2_name' value='$list[name_part2]'/>
								</td>
							</tr>" ;
						}else{
							$html .="
							<tr>
                    			<td style='white-space:nowrap;'>بخش دوم فایل</td>
                        		<td >
                        			<input type='file' name='part2_file'/>
                        		</td>
                    		</tr>
							<tr>
                    			<td colspan='2'>$attache_err2</td>
                    		</tr>";
						}
						if($list['url_part3']){
							$html .="
							<tr>
								<td colspan='3'>
									<a href='$list[url_part3]'>بخش سوم فایل برای دانلود</a>
									<input type='hidden' name='part3_url' value='$list[url_part3]'/>
									<input type='hidden' name='part3_name' value='$list[name_part3]'/>
								</td>
							</tr>" ;
						}else{
							$html .="
							<tr>
                    			<td style='white-space:nowrap;'>بخش سوم فایل</td>
                        		<td >
                        			<input type='file' name='part3_file'/>
                        		</td>
                    		</tr>
							<tr>
                    			<td colspan='3'>$attache_err3</td>
                    		</tr>";
						}
						$html .="<tr>
							<td colspan='3'>
								<p style='text-align:center'>
									 <input type='submit' name='edit_menu' value='ارسال'/>
								</p>	
							</td>                        
						</tr>
					</table>
				</form>
			</div>" ;
		}
		
	}elseif($page=='news'){
		if($menu=='add_news'){
			$html.="<p class='ttl'>اضافه کردن خبر</p><br/>";
			$html.="
			<form action='./list_news.html' method='post' onsubmit='return chkValidate(this)'>
				<table>
					<tr>
						<td>عنوان خبر</td>
						<td>
							<input type='text' name='ttl_news' id='ttl_news' onblur='return validate(this,\"notEmpty\",\"عنوان خبر را تعیین کنید.\",\"3\")' class='nsttl' />
						</td>
						<td style='min-width:100px;'>
							<span class='nsttl_img correct' ></span>
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<span class='nsttl_msg'></span>
						</td>
					</tr>
					<tr>
						<td>پاراگراف اول</td>
						<td colspan='2'>
							<textarea name='summary' onblur='return validate(this,\"notEmpty\",\"مختصری از خبر را در این قسمت ذکر کنید.\",\"3\")' class='fontha'></textarea>
						</td>
						<td>
							<span class='fontha_img correct'></span>
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<span class='fontha_msg'></span>
						</td>
					</tr>
					<tr>
						<td>ادامه خبر</td>
						<td colspan='2'>
							<textarea name='full_text'></textarea>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<p style='text-align:center'>
								<input type='submit' name='send_news'  value='ارسال'/>
							</p>
						</td>
						
					</tr>
				</table>
			</form>";
		}elseif($menu=='list_news'){
			$news_list=db_get_rows('news');
			if($news_list){
				$html.="<p class='ttl'>لیست اخبار</p><br/>
				<div class='tr-first'>
					<div class='td news_ttl'>عنوان خبر</div>
					<div class='td news_act'>عملیات</div>
				</div>";
				foreach($news_list as $list){
					$html.="<div class='tr'>
					<div class='td news_ttl'>$list[title]</div>
					<div class='td news_act'>
						<a target='_new' href='/hamayesh/internal/news/$list[id]/$list[title].html' >مشاهده</a>
						<a href='./news_edit_$list[id].html' >ویرایش</a>
						<a href='./news_delete_$list[id].html' >حذف</a>
					</div>
				</div>";
				}
				$html.="<div class='clear'></div>";
			}else{
				$html.="هیچ خبری ثبت نشده است";
			}
		}
	}elseif($page=='news_edit'){
		$html.="<p class='ttl'>ویرایش خبر</p><br/>";
		$edit_news=db_get_rows('news'," id='$menu' ");
		foreach($edit_news as $list){
			$html.="
			<form action='./list_news.html' method='post' onsubmit='return chkValidate(this)'>
				<table>
					<tr>
						<td>عنوان خبر</td>
						<td>
							<input type='text' name='ttl_news' id='ttl_news' value='$list[title]' onblur='return validate(this,\"notEmpty\",\"عنوان خبر را تعیین کنید.\",\"3\")' class='nsttl' />
						</td>
						<td>
							<span class='nsttl_img correct'></span>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<span class='nsttl_msg'></span>
						</td>
					</tr>
					<tr>
						<td>پاراگراف اول</td>
						<td colspan='2'>
							<textarea name='summary' onblur='return validate(this,\"notEmpty\",\"مختصری از خبر را در این قسمت ذکر کنید.\",\"8\")' class='fontha'>$list[summary]</textarea>
						</td>
						<td>
							<span class='fontha_img correct'></span>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<span class='fontha_msg'></span>
						</td>
					</tr>
					<tr>
						<td>ادامه خبر</td>
						<td colspan='2'>
							<textarea name='full_text'>$list[full_text]</textarea>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<p style='text-align:center'>
								<input type='hidden' name='id_news' value='$menu'/>
								<input type='submit' name='edit_news'  value='ارسال'/>
							</p>
						</td>
					</tr>
				</table>
			</form>";
		}
	}
	return $html;
}
//main page:article form
function gen_article_form($se_fo){
	if($se_fo=='send_article'){
		$html .="
		<div class='send_art'>
			<span class='title'>فرم ارسال مقاله</span><br/>
			<span class='title' >توجه  : &nbsp;&nbsp;</span>
			<span>مقالاتی که بعد از تاریخ تعیین شده ارسال گردند مورد بررسی قرار نخواهند گرفت.</span><br/>
			<form action='' method='post' enctype='multipart/form-data' >
				<table>
				   <tr>
					   <td>عنوان</td>
					   <td><input type='text' name='title_fa'/></td>
					   <td></td>
				   </tr>
				   <tr>
					   <td>title</td>
					   <td><input type='text' name='title_en'/></td>
					   <td></td>
					</tr>
					<tr>
						<td>ارایه کننده</td>
						<td><input type='text' name='presenter'/></td>
						<td></td>
					</tr>
					<tr>
						<td>کد ملی ارایه کننده</td>
						<td><input type='text' name='meli'/></td>
						<td></td>
					</tr>
					<tr>
						<td>
							<span class='title'>&nbsp;&nbsp;توجه : &nbsp;&nbsp;&nbsp;&nbsp;</span>
						</td>
						<td colspan='2'>
							<span>کد ملی ثبت شده در این قسمت برای پیگیری وضعیت مقاله استفاده خواهد شد.</span>
						</td>
					</tr>
					<tr>
						<td>سایر نویسندگان</td>
						<td><textarea name='authors'></textarea></td>
						<td></td>
					</tr>
					<tr>
						<td>شماره تماس</td>
						<td><input type='text' name='tell'/></td>
						<td></td>
					</tr>
					<tr>
						<td>پست الکترونیک</td>
						<td><input type='text' name='email'/></td>
						<td></td>
					</tr>
					<tr>
						<td>خلاصه مقاله</td>
						<td><input type='file' name='abs_fa'/></td>
						<td></td>
					</tr>
					<tr>
						<td>abstract</td>
						<td><input type='file' name='abs_en'/></td>
						<td></td>
					</tr>
					<tr>
						<td colspan='3'>
							<input type='submit' value='ارسال' name='article' />
						</td>
					</tr>
				 </table>
			</form>                     
		</div>";
	}else if($se_fo=='follow_article'){
		$html.="
		<div class='follow_art'>
			<span class='title'>فرم پيگيری مقالات ارسال شده</span><br/>
			<span>از این قسمت میتوانید نتیجه بررسی داوران روی مقاله خودتان را مشاهده کنید.</span>
			<br/>
			<form action='' method='post'>
				کد ملی :<input type='text' name='follow_Cod'/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='submit' name='follow' value='ارسال'/>
			</form>
		</div>";
	}
	return $html;
}
//generate menu page internal
function gen_menu_internal($menu){
	foreach($menu as $list){//ask5 in foreach mire soraghe tak tak satr haye table
		$html.="
		<a title='Menu' href='/hamayesh/internal/$list[id].html'>$list[menu_name]</a>
        <div class='triangle'></div>";
	}
	return $html;	
}

//content of internal page
function gen_content_internal($menu){
	if($menu=='about'){
		$about=db_get_rows('home_content',"id='about'");
		foreach($about as $list){
			$html .="
			<div class='mttl'>درباره همایش</div>
       		<div class='content'>$list[content]</div>";			
		}
	}else{
		foreach($menu as $list){//ask5 in for each mire soraghe har field yek satr
			$html.="
			<div class='mttl'>$list[title]</div>
			<div class='content'>$list[text]" ;
			if($list['url_part2']){
				if($list['url_part1']){
					$html.="
					<span class='download'>
						<a href='$list[url_part1]'>دانلود بخش اول</a>
					</span>";
				}
			$html.="
				<span class='download'>
					<a href='$list[url_part2]'>دانلود بخش دوم</a>
				</span>";
			}
			else{
				if($list['url_part1']){
					$html.="
					<span class='download'>
						<a href='$list[url_part1]'>دانلود کنید</a>
					</span>";
				}
			}
			if($list['url_part3']){
				$html.="
					<span class='download'>
						<a href='$list[url_part3]'>دانلود بخش سوم</a>
					</span>";
			}
		
			$html .="</div>";
		}
	}
	return $html;
}
//generate news in internal page:
function gen_internal_news($id_news,$ttl_news){
	if($id_news==0){
		$html="<div class='mttl'>اخبار همایش</div>
       		<div class='content'>";
		$news_num=db_get_num_rows('news');
		if($news_num>6){
		}
		$news_list=db_get_rows('news');
		$a=count($news_list);
		foreach($news_list as $list){
			$title=str_replace(' ','_',$list['title']);
			$html.="<div>
				<span class='ttl_news'>$list[title]</span>
				<p>$list[summary]</p>
				<a href='../$list[id]/$title.html' >
					<div class='continue'>ادامه خبر</div>
				</a>				
			</div><div class='clear'></div><hr/>"	;
		}
		$html .="</div>";
	}else{
		$news =db_get_rows('news'," id='$id_news' ");
		foreach($news as $list){
			$html="<div class='mttl'>$list[title]$a</div>
				<div class='content'>
					<p>$list[summary]</p>
					<p>$list[full_text]</p><br/>
					<a href='/hamayesh/internal/news/0/list.html'>
						<div class='continue return'>بازگشت به لیست اخبار</div>
					</a>
				</div>";
		}
	}
	return $html;
}
