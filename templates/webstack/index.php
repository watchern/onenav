<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="viggo" />
    <title><?php echo $site['title']; ?> - <?php echo $site['subtitle']; ?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>" />
	<meta name="description" content="<?php echo $site['description']; ?>" />
    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic"> -->
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="static/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/xenon-core.css">
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/xenon-components.css">
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/xenon-skins.css">
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/assets/css/nav.css?v=<?php echo $info->version; ?>">
    <script src="static/js/jquery.min.js"></script>
    <script src = "static/js/holmes.js"></script>
    <?php echo $site['custom_header']; ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- / FB Open Graph -->
</head>

<?php
    //获取图标显示方式
    $font_icon = $theme_config->link_icon;
?>

<body class="page-body">
    <!-- 返回顶部按钮 -->
	<div id="top"></div>
	<div class="top mdui-shadow-10">
		<a href="javascript:;" title="返回顶部" onclick="gotop()"><i class="fa fa-arrow-up"></i></a>
	</div>
	<!-- 返回顶部END -->
    <!-- skin-white -->
    <div class="page-container">
        <div class="sidebar-menu toggle-others fixed">
            <!-- 遮罩 -->
			<?php if( isset( $_GET['cid'] ) ) {?>
			<div class="overlay"></div>
			<?php } ?>
			<!-- 遮罩END -->
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="./" class="logo-expanded" title = "<?php echo $site['title']; ?> - <?php echo $site['subtitle']; ?>">
                            <h1><?php echo $site['title']; ?></h1>
                        </a>
                        <!-- <a href="./" class="logo-collapsed">
                            <img src="templates/<?php echo $template; ?>/assets/images/logo-collapsed@2x.png" width="40" alt="" />
                        </a> -->
                    </div>
                    <div class="mobile-menu-toggle visible-xs">
                        
                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa-bars"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
                    <!-- 搜索框 -->
                    <div class = "search">
                        <input type="text" class="form-control" name="search" id="search" placeholder="输入书签关键词" />
                        <i class="fa fa-search"></i>
                    </div>
                    <!-- 搜索框END -->
                    <!-- 遍历分类目录 -->
                    <?php foreach ($category_parent as $key => $category) {
                        
                    ?>
                    <li>
                        <a href = "#category-<?php echo $category['id']; ?>" onclick = "SmoothScrollTo('#<?php echo 'category-'.$category['id']; ?>',200)">
                            <i class='<?php echo $category['font_icon']; ?>'></i>
                            <span class="title"><?php echo $category['name']; ?></span>
                        </a>
                        <!-- 子分类 -->
                        <ul>
                            <?php foreach ( get_category_sub( $category['id'] ) AS $category_sub ) {
                                
                            ?>
                            <li>
                                <a href="#category-<?php echo $category_sub['id']; ?>" class="smooth">
                                    <i class='<?php echo $category_sub['font_icon']; ?>'></i>
                                    <span class="title"><?php echo $category_sub['name']; ?></span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <!-- 子分类END -->
                    </li>
                    <?php } ?>
                    <!-- 遍历分类目录END -->
                    
                </ul>
            </div>
        </div>
        <div class="main-content">
            <nav class="navbar user-info-navbar" role="navigation">
                <!-- User Info, Notifications and Menu Bar -->
                <!-- Left links for user info navbar -->
                <ul class="user-info-menu left-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="#" data-toggle="sidebar">
                            <i class="fa-bars"></i>
                        </a>
                    </li>
                    
                </ul>
                <ul class="user-info-menu right-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="./index.php?c=admin" title = "OneNav后台管理" target="_blank">
                            <i class="fa-dashboard"></i>  后台管理
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- 常用推荐 -->

            <!-- 遍历分类 -->
            <?php foreach ($categorys as $category) {
                $fid = $category['id'];
                $links = $get_links($fid);
                //如果分类是私有的
                if( $category['property'] == 1 ) {
                    $property = '<i class="fa fa-expeditedssl" style = "color:#5FB878"></i>';
                }
                else {
                    $property = '';
                }
            ?>
            <h4 class="text-gray" id = "category-<?php echo $fid; ?>">
                <i class='<?php echo $category['font_icon']; ?>'></i> 
                <?php echo $category['name']; ?>
                <?php
                    if( !isset($_GET['cid']) && get_links_number($fid) > $link_num  ) {
                ?>
                <span class="more-link">
                    <a href="./index.php?cid=<?php echo $category['id']; ?>" title = "点此查看此分类下的全部链接">>></a>
                </span>
                <?php } ?>
                <!-- 关闭并返回 -->
                <?php if( isset($_GET['cid']) ) { ?>
                    <a href="./" title = "返回首页"><<</a>
                <?php } ?>
                <!-- 关闭并返回END -->
                <?php echo $property; ?>
            </h4>
            <div class="row" style = "margin-bottom:2em;">
                <!-- 获取列数 -->
                <?php
                    $column = ($theme_config->column == 6) ? 2 : 3;
                    
                ?>
                <!-- 获取列数END -->
                <!-- 遍历链接 -->
                <?php foreach ($links as $link) {
                    
                    //如果是文字图标
                    switch ($font_icon) {
                        case 'text':
                            $font_icon_url = "./index.php?c=ico&text=".$link['title'];
                            break;
                        case 'custom':
                            $font_icon_url = $link['font_icon'];
                            if( empty($font_icon_url) ) {
                                $font_icon_url = 'static/images/default.png';
                            }
                            break;
                        default:
                            $font_icon_url = "./index.php?c=ico&text=".$link['title'];
                            break;
                    }
                ?>
                <div class="col-sm-<?php echo $column; ?> link">
                    <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('./index.php?c=click&id=<?php echo $link['id']; ?>', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $link['url']; ?>">
                        <!-- 如果是私有链接则显示角标 -->
                        <?php if($link['property'] == 1) { ?>
                        <div class="subscript"></div>
                        <?php } ?>
                        <!-- 角标END -->
                        <div class="xe-comment-entry">
                            <a class="xe-user-img">
                                <!-- 判断文字 -->
                                <img data-src="<?php echo $font_icon_url; ?>" class="lozad img-circle" width="40">
                            </a>
                            <!-- 隐藏链接，用于搜索 -->
                            <span style = "display:none;"><?php echo $link['url']; ?></span>
                            <!-- 隐藏链接END -->
                            <div class="xe-comment">
                                <a href="#" class="xe-user-name overflowClip_1">
                                    <strong><?php echo $link['title']; ?></strong>
                                </a>
                                <p class="overflowClip_2"><?php echo $link['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- 遍历链接END -->
            </div>
            <?php } ?>
            
            <br />
            <!-- 遍历分类END -->
            <!-- END 常用推荐 -->
            
            
            <!-- Main Footer -->
            <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
            <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
            <!-- Or class "fixed" to  always fix the footer to the end of page -->
            <footer class="main-footer sticky footer-type-1">
                <div class="footer-inner">
                    <!-- Add your copyright text here -->
                    <div class="footer-text">
                        <?php if( empty($site['custom_footer']) ) { ?>
                        &copy; 2023 Powered by <a target="_blank" href="https://www.onenav.top/" title="简约导航/书签管理器" rel="nofollow">OneNav</a>.
                        design by <a href="https://www.viggoz.com" target="_blank"><strong>Viggo</strong></a>
                        <?php }else{
                            echo $site['custom_footer'];
                        }
                        ?>
                    </div>
                    <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                    
                </div>
            </footer>
        </div>
    </div>
    <!-- 锚点平滑移动 -->
    <script type="text/javascript">
    function SmoothScrollTo(id_or_Name, timelength){
        var timelength = timelength || 1000;
        $('html, body').animate({
            scrollTop: $(id_or_Name).offset().top-70
        }, timelength, function(){
            window.location.hash = id_or_Name;
        });
    }
    $(document).ready(function() {
         //img lazy loaded
         const observer = lozad();
         observer.observe();

        $(document).on('click', '.has-sub', function(){
            var _this = $(this)
            if(!$(this).hasClass('expanded')) {
               setTimeout(function(){
                    _this.find('ul').attr("style","")
               }, 300);
              
            } else {
                $('.has-sub ul').each(function(id,ele){
                    var _that = $(this)
                    
                    if(_this.find('ul')[0] != ele) {
                        setTimeout(function(){
                            _that.attr("style","")
                        }, 300);
                    }
                })
            }
        })
        $('.user-info-menu .hidden-sm').click(function(){
            if($('.sidebar-menu').hasClass('collapsed')) {
                $('.has-sub.expanded > ul').attr("style","")
            } else {
                $('.has-sub.expanded > ul').show()
            }
        })
        $("#main-menu li ul li").click(function() {
            $(this).siblings('li').removeClass('active'); // 删除其他兄弟元素的样式
            $(this).addClass('active'); // 添加当前元素的样式
        });
        $("a.smooth").click(function(ev) {
            ev.preventDefault();

            public_vars.$mainMenu.add(public_vars.$sidebarProfile).toggleClass('mobile-is-visible');
            ps_destroy();
            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top - 30
            }, {
                duration: 500,
                easing: "swing"
            });
        });
        return false;
    });

    var href = "";
    var pos = 0;
    $("a.smooth").click(function(e) {
        $("#main-menu li").each(function() {
            $(this).removeClass("active");
        });
        $(this).parent("li").addClass("active");
        e.preventDefault();
        href = $(this).attr("href");
        pos = $(href).position().top - 30;
    });
    function gotop(){
        $("html,body").animate({scrollTop: '0px'}, 600);
    }
    // 搜索框
    var h = holmes({
        input: '.search input',
        find: '.link',
        hiddenAttr: true
    });
    //搜索框END
    </script>
    <!-- Bottom Scripts -->
    <script src="templates/<?php echo $template; ?>/assets/js/bootstrap.min.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/TweenMax.min.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/resizeable.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/joinable.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/xenon-api.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/xenon-toggles.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="templates/<?php echo $template; ?>/assets/js/xenon-custom.js"></script>
    <script src="templates/<?php echo $template; ?>/assets/js/lozad.js"></script>
</body>

</html>
