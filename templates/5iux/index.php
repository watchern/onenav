<?php
    //获取图标显示方式
	$link_icon = $theme_config->link_icon;

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $site['title']; ?> - <?php echo $site['subtitle']; ?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>" />
	<meta name="description" content="<?php echo $site['description']; ?>" />
    <link rel="apple-touch-icon-precomposed" href="280.png" />
    <meta name="msapplication-TileImage" content="280.png" />
    <?php
    if( empty( $theme_config->shortcut_icon ) ) {
    ?>
    <link rel="shortcut icon" href="templates/<?php echo $template; ?>/32.png?v=1.0.1"/>
    <?php }else{ ?>
    <link rel="shortcut icon" href="<?php echo $theme_config->shortcut_icon; ?>"/>
    <?php } ?>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="full-screen" content="yes">
    <!--UC强制全屏-->
    <meta name="browsermode" content="application">
    <!--UC应用模式-->
    <meta name="x5-fullscreen" content="true">
    <!--QQ强制全屏-->
    <meta name="x5-page-mode" content="app">
    <!--QQ应用模式-->
    <link rel="stylesheet" href="static/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" id="font-awesome-css" href="static/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all">
    <script src="static/js/jquery.min.js"></script>
    <script src = "static/js/holmes.js"></script>
    <script src="templates/<?php echo $template; ?>/sou.js"></script>
    <link rel='stylesheet' href='templates/<?php echo $template; ?>/style.css?v=<?php echo $info->version; ?>'>
    <?php echo $site['custom_header']; ?>
</head>

<body>
    <!-- 返回顶部按钮 -->
	<div id="top"></div>
	<div class="top">
		<a href="javascript:;" title="返回顶部" onclick="gotop()"><i class="fa fa-arrow-up"></i></a>
	</div>
	<!-- 返回顶部END -->

    <!--视频头部背景-->
    <div style="clear: both"></div>
    <div class="banner-video" id = "banner_bg">
        <!--注释掉图片可换成视频版本-->
        <img src="" alt="">
        <div class="bottom-cover" style="background-image: linear-gradient(rgba(255, 255, 255, 0) 0%, rgb(244 248 251 / 0.6) 50%, rgb(244 248 251) 100%);"></div>
    </div>
    <script>
    
    $.get("index.php?c=bing",function(data,status){
      //console.log(data.images[0].url);
      var bg_img = 'https://cn.bing.com' + data.images[0].url;
      $("#banner_bg img").attr("src",bg_img);
    //   bg_html = "<style> body{background:url('" + bg_img + "') no-repeat center/cover;}</style>";
    //   $("body").append(bg_html);
    });
    </script> 
    <!--topbar开始-->
    <style>
        .navbar-toggler svg{ width: 24px; height: 24px; }
        .navbar-toggler .bi-list-nested{display: none;}
        .navbar-toggler.collapsed .bi-list-nested{display: block;}
        .navbar-toggler.collapsed .bi-x{display: none;}
        .navbar-toggler .bi-x{display: block;}
    </style>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="position: absolute; z-index: 10000;">
        <a class="navbar-brand logo" href="./" title = "<?php echo $site['subtitle']; ?>">
            <h1><?php echo $site['title']; ?></h1>
            <!-- <img src="https://cdn.jsdelivr.net/gh/5iux/uploads/pic/20200424logo4.svg" height="35" style=" margin-left: -40px;" alt=""> -->
        </a>
        <button class="navbar-toggler collapsed" style="border: none; outline: none;" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="bi bi-list-nested" fill="currentColor" id="list-nested">
                <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 015 11h10a.5.5 0 010 1H5a.5.5 0 01-.5-.5zm-2-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm-2-4A.5.5 0 011 3h10a.5.5 0 010 1H1a.5.5 0 01-.5-.5z"></path>
            </svg><span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" id="x">
                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z"></path>
                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z"></path>
            </svg></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav mr-auto menu">
                <!-- 遍历父级分类 -->
                <?php foreach ($category_parent as $key => $category) {
                    # code...
                ?>
                <li class="nav-item active nav-cat">
                    <i class='<?php echo $category['font_icon']; ?>'></i>
                    <a class="nav-link" title = "<?php echo $category['description']; ?>" href="./index.php?cid=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                </li>
                <?php } ?>
                <!-- 遍历父级分类END -->
                <!-- 管理员按钮 -->
                <li class="nav-item active nav-cat">
                    <i class='fa fa-dashboard'></i>
                    <a class="nav-link" href="./index.php?c=admin" title = "OneNav后台管理" target="_blank">后台管理</a>
                </li>
                <!-- 管理员按钮END -->
            </ul>
            <style>
                #he-plugin-simple{ z-index: 1000; }
            </style>
            <!-- 天气插件 -->
            <!-- <div id="he-plugin-simple"></div>
            <script>WIDGET = {CONFIG:{"modules":"01234","background":5,"tmpColor":"4A4A4A","tmpSize":14,"cityColor":"4A4A4A","citySize":14,"aqiSize":14,"weatherIconSize":22,"alertIconSize":16,"padding":"8px 8px 8px 8px","shadow":"1","language":"auto","borderRadius":5,"fixed":"false","vertical":"middle","horizontal":"center","key":"f60588bd99d94495b907562a23e05666"}}</script>
            <script src="https://widget.heweather.net/simple/static/js/he-simple-common.js?v=1.1"></script> -->
            <!-- 天气插件END -->
        </div>
    </nav>
    <!--topbar结束-->
    <div class="container" style="margin-top: 100px; position: relative; z-index: 100;">
        <!-- 返回按钮 -->
        <?php if( isset($_GET['cid']) ) { ?>
            <div class="close">
                <a href="./" title="点此返回首页"><< 返回</a>
            </div>
        <?php } ?>
        <!-- 返回按钮END -->

        <!--搜索结束-->
        <!-- 遍历分类目录 -->
        <?php foreach ($categorys as $key => $category) {
            $fid = $category['id'];
            $links = $get_links($fid);
        ?>
        <ul class="mylist row">
            <!------>
            <li class="title" id = "category-<?php echo $category['id']; ?>">
                <i class='<?php echo $category['font_icon']; ?>'></i> 
                <?php echo $category['name']; ?>
            </li>
            <!-- 遍历链接 -->
            <?php foreach ($links as $key => $link) {
                //根据用户的设置显示链接图标显示方式
                if( $link_icon == "custom" ) {
                    $font_icon_url = $link['font_icon'];

                    //如果用户选择了自定义图标，但是却没有设置图标，则用默认图标
                    if( empty($font_icon_url) ) {
                        $font_icon_url = 'static/images/default.png';
                    }
                }
                else{
                    $font_icon_url = "./index.php?c=ico&text=".$link['title'];
                }

                //判断是否是直连模式
                if( $site['link_model'] === 'direct' ) {
                    $url = $link['url'];
                }
                else{
                    $url = '/index.php?c=click&id='.$link['id'];
                }
            ?>
            <li class="col-3 col-sm-3 col-md-3 col-lg-1 link">
                <a rel="nofollow" href="<?php echo $url; ?>" title = "<?php echo $link['description']; ?>" target="_blank">
                    <img src="<?php echo $font_icon_url; ?>" alt="" />
                    <span><?php echo $link['title']; ?></span>
                </a>
            </li>
            <?php } ?>
            <!-- 遍历链接END -->

            <!-- 更多链接 -->
            <?php
                if( !isset($_GET['cid']) && get_links_number($fid) > $link_num  ) {
            ?>
            <li class="col-3 col-sm-3 col-md-3 col-lg-1 link">
                <a rel="nofollow" href="./index.php?cid=<?php echo $category['id']; ?>" title = "点此可查看该分类下的所有链接！">
                    <img src="./index.php?c=ico&text=M" alt="" />
                    <span>查看更多</span>
                </a>
            </li>
            <?php } ?>
            <!-- 更多链接END -->
        </ul>
        <?php } ?>
    <!-- 遍历分类目录END -->
    </div>
    <!--版权信息开始-->
    <p class="mt-5 mb-3 text-muted text-center">
        <?php if( empty( $site['custom_footer'] ) ) { ?>
        ©2023 Powered by <a target="_blank" href="https://www.onenav.top/" title="简约导航/书签管理器" rel="nofollow">OneNav</a>.The theme author is <a href="https://g.5iux.cn/" rel = "nofollow" target = "_blank">5iux</a>.
        <?php }else{
            echo $site['custom_footer'];
        } ?>
    </p>
    <!--
作者:D.Young
主页：https://blog.5iux.cn/
github：https://github.com/5iux/5iux.github.io
日期：2020-09-24
版权所有，请勿删除
-->
    <!--版权信息结束-->
    <script>
    eval(function(e, t, a, c, i, n) {
        if (i = function(e) { return (e < t ? "" : i(parseInt(e / t))) + (35 < (e %= t) ? String.fromCharCode(e + 29) : e.toString(36)) }, !"".replace(/^/, String)) {
            for (; a--;) n[i(a)] = c[a] || i(a);
            c = [function(e) { return n[e] }], i = function() { return "\\w+" }, a = 1
        }
        for (; a--;) c[a] && (e = e.replace(new RegExp("\\b" + i(a) + "\\b", "g"), c[a]));
        return e
    }('!2(){2 g(){h(),i(),j(),k()}2 h(){d.9=s()}2 i(){z a=4.8(\'A[B="7"][5="\'+p()+\'"]\');a&&(a.9=!0,l(a))}2 j(){v(u())}2 k(){w(t())}2 l(a){P(z b=0;b<e.O;b++)e[b].I.1c("s-M");a.F.F.F.I.V("s-M")}2 m(a,b){E.H.S("L"+a,b)}2 n(a){6 E.H.Y("L"+a)}2 o(a){f=a.3,v(u()),w(a.3.5),m("7",a.3.5),c.K(),l(a.3)}2 p(){z b=n("7");6 b||a[0].5}2 q(a){m("J",a.3.9?1:-1),x(a.3.9)}2 r(a){6 a.11(),""==c.5?(c.K(),!1):(w(t()+c.5),x(s()),s()?E.U(b.G,+T X):13.Z=b.G,10 0)}2 s(){z a=n("J");6 a?1==a:!0}2 t(){6 4.8(\'A[B="7"]:9\').5}2 u(){6 4.8(\'A[B="7"]:9\').W("14-N")}2 v(a){c.1e("N",a)}2 w(a){b.G=a}2 x(a){a?b.3="1a":b.16("3")}z y,a=4.R(\'A[B="7"]\'),b=4.8("#18-C-19"),c=4.8("#C-12"),d=4.8("#17-C-15"),e=4.R(".C-1b"),f=a[0];P(g(),y=0;y<a.O;y++)a[y].D("Q",o);d.D("Q",q),b.D("1d",r)}();', 62, 77, "||function|target|document|value|return|type|querySelector|checked||||||||||||||||||||||||||var|input|name|search|addEventListener|window|parentNode|action|localStorage|classList|newWindow|focus|superSearch|current|placeholder|length|for|change|querySelectorAll|setItem|new|open|add|getAttribute|Date|getItem|href|void|preventDefault|text|location|data|blank|removeAttribute|set|super|fm|_blank|group|remove|submit|setAttribute".split("|"), 0, {}));
    </script>
    
    <script src="static/bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>