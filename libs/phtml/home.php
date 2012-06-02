<link rel="stylesheet" href="/hamayesh/layout-home.css" />
</head>
<body>
<div class="main">
	<div class="admin">
		<a href="login.html">
        	<img src="/hamayesh/img/manager2.png"/>
        </a>
	</div>
    <div class="organiser">
        <div class="logo">
            <div>برگزار کننده</div>
            <div><img src="/hamayesh/img/radkan.png"/></div>
            <!--<div><img src="/hamayesh/img/radkan.png"/></div>-->
        </div>
        <div class="org">این همایش زیر نظر کانون تبلیغاتی و خبری رادکان برگزار میشود.
        	
        </div>
    </div>
	<div class="menu" id="menu">
    	<ul>
        	<li id='first_li'><a href='javascript:void(0)' onClick="goToByScroll('about')" >درباره همایش</a></li>
            <li><a href='javascript:void(0)' onClick="goToByScroll('register')">ثبت نام</a></li>
            <li><a href='javascript:void(0)' onClick="goToByScroll('date')">زمانبندی </a></li>
            <li><a href='javascript:void(0)' onClick="goToByScroll('article')">مقالات</a></li>
            <li><a href='javascript:void(0)' onClick="goToByScroll('contact')">تماس با ما</a></li>
        </ul>
        <!--<ul>
        	<li id='first_li'><a href="#about" class="anchorLink" >درباره همایش</a></li>
            <li><a href="#register" class="anchorLink">ثبت نام</a></li>
            <li><a href="#date" class="anchorLink">زمانبندی</a></li>
            <li><a href="#article" class="anchorLink">مقالات</a></li>
            <li><a href="#contact" class="anchorLink">تماس با ما</a></li>
        </ul>-->
    </div>
    <div class="content">
    	<div id="about" class="section" >
            <a name="about" id='about'></a>
            <div class="h_name"> اپيدميولوژي HIV/AIDS در زنان و كودكان</div>
            <div class='img'>
            	<img src="/hamayesh/img/poster.jpg"/>
            </div>
            <div class='txt'><?php echo $about ?></div>          
            
            <a href="internal/home.html">برای کسب اطلاعات بیشتر درباره این همایش اینجا کلیک کنید.</a>
         
		</div>
        <div class="border_white"></div>
        <div id="register" class="section">
           	<a name="register" id='register'></a>
            <div class="reg_condition" >
            	<span class="title">شرایط ثبت نام در همایش</span><br/>
            <?php echo $register ?>
            </div>
            <br/>
            <div class="reg_form">
            	<span class="title">فرم ثبت نام در همایش</span><br/>
           		<form action="" method="post">
                    <table>
                        <tr>
                            <td>نام</td>
                            <td>
                                <input type="text" name='fname' />                    	
                            </td>
                        </tr>
                        <tr>
                            <td>نام خانوادگی</td>
                            <td>
                                <input type="text" name='lname' />
                            </td>
                        </tr>
                        <tr>
                            <td>کد ملی</td>
                            <td>
                                <input type="text" name='num' />
                            </td>
                        </tr>
                        <tr>
                            <td>شهر</td>
                            <td>
                                <input type="text" name='city' />
                            </td>
                        </tr>
                        <tr>
                            <td>سازمان محل کار</td>
                            <td>
                                <input type="text" name='job' />
                            </td>
                        </tr>
                        <tr>
                            <td>وضعیت اشتغال</td>
                            <td>
                                بازنشسته&nbsp;<input type="radio" name='emstatus' value="retired" />&nbsp;&nbsp;&nbsp;&nbsp;
                                شاغل &nbsp;<input type="radio" name='emstatus' value="employed" />                  	
                            </td>
                        </tr>
                        <tr>
                            <td>مدرک تحصیلی</td>
                            <td>
                                <input type="text" name='degree' />       	                  	
                            </td>
                        </tr>
                        <tr>
                            <td>پست الکترونیک</td>
                            <td>
                                <input type="text" name='email' />                  	
                            </td>
                        </tr>
                        <tr>
                            <td>تلفن تماس</td>
                            <td>
                                <input type="text" name='tel' />                   	
                            </td>
                        </tr>
                        <tr>
                            <td>مبلغ واریزی به ریال </td>
                            <td>
                                <input type="text" name='money' />                    	
                            </td>
                        </tr>
                        <tr>
                            <td>شماره فیش بانکی</td>
                            <td>
                                <input type="text" name='num_bank' />                    	
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="ارسال" name='register' />
                            </td>
                        </tr>
                    </table>
            	</form>
        	</div>
		</div>
        <div class="border_brown"></div>
		<div id="date" class="section">
        	<a name="date" id='date'></a>
             <span class="title">زمانبندی همایش :</span><br/>
             <img src="/hamayesh/img/time2.jpg" />
        	<?php echo $time ?>
		</div>
        <div class="border_white"></div>
        <div id="article" class="section">
            <a name="article" id='article'></a>
            <?php echo $article ;?>
        </div>
            
        <div class="border_brown"></div>	
		<div id='contact' class="section">
        	<a name="contact" id='contact'></a>
             <?php echo $contact ?>
    	</div>
    </div><!--content div-->
</div><!--main div-->
<script type="text/javascript" src='/hamayesh/jquery.anchor.js'></script>
<script type="text/javascript" src='/hamayesh/scroll.js'></script>
