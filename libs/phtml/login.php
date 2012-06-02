<link rel="stylesheet" type="text/css" href="layout-login.css" />

</head>
<body>

<div class="slids">
    <div class="support">
        <div class="ttl">
            <img src="./img/support-tab.png" />
        </div>
        <div class="form">
            <form action="" method="post" onSubmit="return chkValidate(this)">
                <table>
                    <tr>
                        <td>نام کاربری &nbsp;&nbsp;</td>
                        <td>
                            <input type="text" name="us" onblur="return validate(this,'notEmpty','نام کاربری را وارد کنید.','1')" class='usS'/>
                        </td>
                        <td>
                        	<span class="usS_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="usS_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>رمز عبور &nbsp;&nbsp;</td>
                        <td>
                            <input type="password" name="ps" onblur="return validate(this,'notEmpty','رمز عبور را وارد کنید.','1')" class='psS'/>
                        </td>
                        <td>
                        	<span class="psS_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="psS_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="hidden" name="type" value="support" />
                            <input type="submit" name="login" value="ارسال" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="ttl">
            <img src="./img/content-tab.png" />
        </div>
        <div class="form">
            <form action="" method="post" onSubmit="return chkValidate(this)">
                <table>
                    <tr>
                        <td>نام کاربری &nbsp;&nbsp;</td>
                        <td>
                            <input type="text" name="us" onblur="return validate(this,'notEmpty','نام کاربری را وارد کنید.','1')" class='usC'/>
                        </td>
                        <td>
                        	<span class="usC_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="usC_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>رمز عبور &nbsp;&nbsp;</td>
                        <td>
                            <input type="password" name="ps" onblur="return validate(this,'notEmpty','رمز عبور را وارد کنید.','1')" class='psC'/>
                        </td>
                        <td>
                        	<span class="psC_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="psC_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="hidden" name="type" value="content" />
                            <input type="submit" name="login" value="ارسال" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="refree">
        <div class="ttl">
            <img src="./img/refree-tab.png" />       	
        </div>
        <div class="form">
           <form action="" method="post" onSubmit="return chkValidate(this)">
                <table>
                    <tr>
                        <td>نام کاربری &nbsp;&nbsp;</td>
                        <td>
                            <input type="text" name="us" onblur="return validate(this,'notEmpty','نام کاربری را وارد کنید.','1')" class='usR'/>
                        </td>
                        <td>
                        	<span class="usR_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="usR_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>رمز عبور &nbsp;&nbsp;</td>
                        <td>
                            <input type="password" name="ps" onblur="return validate(this,'notEmpty','رمز عبور را وارد کنید.','1')" class='psR'/>
                        </td>
                        <td>
                        	<span class="psR_img correct"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span class="psR_msg"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="hidden" name="type" value="refree" />
                            <input type="submit" name="login"  value="ارسال"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>	
    </div>
    <div class="clear"></div>
</div>
<div class="msg_login">
    <?php echo $msg_login ;?>
    قسمت مدیریت شامل سه بخش است:<br/>بخش مدیریت محتوا:<br/>شما در این بخش قادرید<br/><br/><br/><br/>بخش مدیریت سایت<br/>شما در این بخش قادرید<br/><br/><br/><br/>بخش داوری مقالات<br/>شما در این بخش قادرید<br/><br/><br/><br/>
</div>
<script type="text/javascript" src='/hamayesh/login.js'></script>



