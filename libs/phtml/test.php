<link rel="stylesheet"  type="text/css" href="layout-content.css" />

</head>
<body>

<?php echo $con_admin ; ?>
<div class="main">
	<div class="menu">
    	<p onClick="toggle_menu('.con_home')">تعیین محتویات صفحه اصلی</p>
    	<div class="con_home">
        	<a href="admin/content/about.html"> درباره همایش</a>
            <a href="admin/content/regcon.html"> شرایط ثبت نام </a>
            <a href="admin/content/time.html"> زمانبندی همایش</a>
            <a href="admin/content/contact.html">تماس با ما</a>
        </div>
        <p onClick="toggle_menu('.con_internal')">تعیین محتویات صفحه داخلی </p>
        <div class="con_internal">
        	<a href="admin/content/intcon.html"> تعیین منو ها و محتویات</a>
        </div>
        <p onClick="toggle_menu('.us_ps')">تنظیمات ورود به این بخش</p>
        <div class="us_ps">
        	<a href="admin/content/chg.html">تغییر نام کاربری و رمز عبور</a>
            <a href="admin/content/add.html">اضافه کردن کاربر جدید</a>
        </div>
    </div>
    <div class="content"></div>
</div>