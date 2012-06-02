<link rel="stylesheet" href="/hamayesh/layout-internal.css" />
</head>
<body>
<div class="main">
    <div class="menu">
        <div class="sc_menu_wrapper">
            <div class="sc_menu">
                <a href="/hamayesh/home.html">صفحه اول</a>
                <a href="/hamayesh/internal/news/0/list.html">اخبار همایش</a>
                <div class="triangle"></div>
                <?php echo $menu_content?>
            </div>               
        </div>
    </div>
    <div class="main-con">
        <?php echo $content ? $content :'www'; ?>
    </div>
</div>
<script type="text/javascript" src='/hamayesh/menu.js'></script>