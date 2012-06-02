<link rel="stylesheet" type="text/css" href="/hamayesh/layout-content.css" />
<!--<script src="/hamayesh/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<script type="text/javascript" src='/hamayesh/content_menu.js'></script>        
<script type="text/javascript" src="/hamayesh/libs/js/tiny_mce/tiny_mce.js"></script>
<script type='text/javascript'>
//var editor =CKEDITOR.replace( 'editor1' );
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,table,save,advhr,advimage,emotions,iespell,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,advlist,autosave",
                
        // Theme options - button# indicated the row# only
       theme_advanced_buttons1 : "save,newdocument,|,undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,",
	   theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,ltr,rtl,",
		theme_advanced_buttons3 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,link,unlink,image,iespell,media,charmap,emotions,advhr,|,hr,removeformat,visualaid,|,sub,sup,",
		theme_advanced_buttons4 : "tablecontrols,|,help,code,|,insertdate,inserttime,|,preview,print,fullscreen,",
		
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "/hamayesh/libs/css/tiny.css",

		// Drop lists for link/image/media/template dialogs
		external_image_list_url : "../tinymce/examples/lists/image_list.js",
		external_link_list_url : "../tinymce/examples/lists/link_list.js",
		
		
		// Style formats
		style_formats : [
			{title : 'عناوین صفحه اول', inline : 'span' ,
			 styles : {
				color:'#fff',
				padding:'3px 5px',
				minWidth:'200px',
				fontFamily:'Tahoma' ,
				fontSize:'15px',
				backgroundColor:'#bc3325',
				webkitBrderRdius:'5px',
				mozBorderRadius:'5px',
				oBorderRadius:'5px',
				msBorderRadius:'5px',
				borderRadius:'5px'
				}
			},
			{title : 'متن قرمز در صفحه اول', inline : 'span' ,
			 styles : {
				color: '#BC3325'
				}
			},
			{title : 'متن قهوه ای', inline : 'span' ,
			 styles : {
				color: '#291B1B'
				}
			},
			{title : 'فرمت متن در صفحه اول و دوم', inline : 'span' ,
			 styles : {
				backgroundColor: '#F9ECD9',
				color: '#291B1B',
				}
			},
			{title : 'فرمت متن در صفحه اول', inline : 'span', 
			styles : {
				color: 'white',
				backgroundColor: '#291B1B',	
				}
			},
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
</head>
<body>
<div class="main">
	<div class="right">
        <div class="logout">
                <a href="./logout.html"> خروج از بخش مدیریت محتوا</a>
        </div>
        <div class="menu">
            <p onClick="toggle_menu('.con_home')">تعیین محتویات صفحه اصلی</p>
            <div class="con_home">
                <a href="/hamayesh/content/about.html"> درباره همایش</a>
                <a href="/hamayesh/content/register.html"> شرایط ثبت نام </a>
                <a href="/hamayesh/content/time.html"> زمانبندی همایش</a>
                <a href="/hamayesh/content/article.html">مقالات</a>
                <a href="/hamayesh/content/contact.html">تماس با ما</a>
            </div>
            <p onClick="toggle_menu('.con_internal')">تعیین محتویات صفحه داخلی </p>
            <div class="con_internal">
                <a href="/hamayesh/content/list.html"> مشاهده لیست مطالب</a>
                <a href="/hamayesh/content/add.html"> اضافه کردن مطلب جدید</a>
            </div>
            <p onClick="toggle_menu('.news')">اخبار</p>
            <div class="news">
                <a href="/hamayesh/content/list_news.html"> لیست اخبار ثبت شده</a>
                <a href="/hamayesh/content/add_news.html"> اضافه کردن خبر جدید</a>
            </div>
            <p onClick="toggle_menu('.upload')">آپلود فایل</p>
            <div class="upload">
                <a href="/hamayesh/content/uplist.html">لیست فایل های آپلود شده</a>
                <a href="/hamayesh/content/upnew.html">آپلود فایل جدید</a>
            </div>
            <p onClick="toggle_menu('.msg')">مدیریت پیام ها</p>
            <div class="msg">
                <a href="/hamayesh/content/remsg.html">پیام های دریافت شده</a>
                <a href="/hamayesh/content/semsg.html">پیام فرستاده شده</a>
                <a href="/hamayesh/content/newmsg.html">ارسال پیام جدید</a>
            </div>
            <p onClick="toggle_menu('.us_ps')">تنظیمات ورود به این بخش</p>
            <div class="us_ps">
                <a href="/hamayesh/content/chgus.html">تغییر نام کاربری و رمز عبور</a>
                <a href="/hamayesh/content/addus.html">اضافه کردن کاربر جدید</a>
            </div>            
        </div>
    </div>
    <div class="content">
    	<?php  echo $admin_content ? $admin_content :'شما در این بخش قادرید....' ;?>
    </div>
    
    
</div>


